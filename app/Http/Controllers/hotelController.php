<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\House;
use App\Models\Image;
use App\Models\Feed;
use App\Models\History;
use App\Models\Leadership;
use App\Models\Reservation;
use App\Models\Event;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class hotelController extends Controller
{
    public function availableRooms()
    {
        return view('rooms.available', ['rooms' => Room::all()->where('status', '=', '0')]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        Excel::import(new UsersImport(), $request->file('file'));

        return back()->with('success', 'Users imported successfully.');
    }

    public function index()
    {
        $house = House::all();
        $room = Room::all();
        $image = Image::all();
        $feed = Feed::all();
        $event = Event::all();
        return view('welcome', compact('house', 'room', 'image', 'feed', 'event'));
    }

    public function rooms()
    {
        $room = Room::all();
        return view('the-rooms', compact('room'));
    }

    public function about()
    {
        $house = House::all();
        $image = Image::all();
        $history = History::all();
        $leadership = Leadership::all();

        return view('about', compact('house', 'image', 'history', 'leadership'));
    }

    public function events()
    {
        $event = Event::all();
        return view('the-events', compact('event'));
    }

    public function contact()
    {
        $feed = Feed::all();
        return view('contact', compact('feed'));
    }

    public function reservation($id)
    {
        $room = Room::findOrFail($id);
        return view('the-reservation', compact('room'));
    }

    public function show($id)
    {
        $room = Room::findOrFail($id); // ابحث عن الغرفة باستخدام المعرف
        return view('details', compact('room'));
    }

    public function showevents($id)
    {
        $event = Event::findOrFail($id); // ابحث عن الغرفة باستخدام المعرف
        return view('event-details', compact('event'));
    }

    public function checkAvailability(Request $request)
    {
        // تحقق من صحة البيانات
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:checkin_date',
            'people' => 'required|integer|min:1|max:5',
        ]);

        // الحصول على التواريخ المدخلة
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        // البحث عن الغرف المتاحة
        $availableRooms = Room::where('status', '=', '0') // إضافة شرط الحالة
            ->whereDoesntHave('reservations', function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($query) use ($checkIn, $checkOut) {
                    $query->where('check_in', '<', $checkOut)->where('check_out', '>', $checkIn);
                });
            })
            ->get();

        // التحقق مما إذا كانت هناك غرف متاحة
        if ($availableRooms->isEmpty()) {
            return redirect()->back()->with('error', 'No rooms available for the selected dates.');
        }

        // إذا كانت الغرف متاحة، يمكنك عرضها
        return view('available_rooms', compact('availableRooms', 'checkIn', 'checkOut'));
    }

    public function showAvailabilityForm()
    {
        return view('available_rooms');
    }

    public function store(Request $request)
    {
        // تحقق من صحة البيانات
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'people' => 'required|integer|min:1',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvc' => 'required|string',
        ]);

        // تحقق من توافر الغرفة
        $roomId = $request->room_id;
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        $isBooked = Reservation::where('room_id', $roomId)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query
                    ->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($query) use ($checkIn, $checkOut) {
                        $query->where('check_in', '<', $checkIn)->where('check_out', '>', $checkOut);
                    });
            })
            ->exists();

        if ($isBooked) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Room is already booked for the selected dates.']);
        }

        // الحصول على سعر الغرفة
        $room = Room::find($roomId);
        $pricePerNight = $room->price;

        // حساب المدة (عدد الليالي)
        $checkInDate = \Carbon\Carbon::parse($checkIn);
        $checkOutDate = \Carbon\Carbon::parse($checkOut);
        $numberOfNights = $checkInDate->diffInDays($checkOutDate);

        // حساب السعر الإجمالي
        $totalAmount = $pricePerNight * $numberOfNights * 100; // تحويل إلى سنت (Stripe يتطلب المبلغ بالسنت)

        // إعداد Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // معالجة الدفع
        try {
            $charge = Charge::create([
                'amount' => $totalAmount,
                'currency' => 'usd',
                'source' => $request->card_number, // استخدم توكن البطاقة
                'description' => 'Reservation payment for ' . $request->customer_name,
            ]);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Payment failed: ' . $e->getMessage()]);
        }

        // إنشاء الحجز
        $reservation = Reservation::create($request->only(['room_id', 'customer_name', 'phone', 'email', 'check_in', 'check_out', 'people']));

        $room->status = 1; // تغيير حالة الغرفة إلى محجوزة
        $room->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }
}
