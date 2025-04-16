<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function createCharge(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            'amount' => 100 * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Binaryboxtuts Payment Test',
        ]);

        return redirect('stripe')->with('success', 'Payment Successful!');
    }

    // public function store(Request $request)
    // {
    //     // تحقق من صحة المدخلات
    //     $request->validate([
    //         'room_id' => 'required|exists:rooms,id',
    //         'customer_name' => 'required|string|max:255',
    //         'phone' => 'required|string|max:15',
    //         'email' => 'required|email|max:255',
    //         'check_in' => 'required|date|after_or_equal:today',
    //         'check_out' => 'required|date|after:check_in',
    //         'people' => 'required|integer|min:1',
    //     ]);

    //     // تحقق مما إذا كانت الغرفة محجوزة في نفس التواريخ
    //     $roomId = $request->room_id;
    //     $checkIn = Carbon::parse($request->check_in);
    //     $checkOut = Carbon::parse($request->check_out);
    //     $totalNights = $checkIn->diffInDays($checkOut);
    //     $totalPrice = $room->price * $totalNights * 100; // تأكد من ضرب السعر في 100 لتحويله إلى سنتات

    //     $isBooked = Reservation::where('room_id', $roomId)
    //         ->where(function ($query) use ($checkIn, $checkOut) {
    //             $query
    //                 ->whereBetween('check_in', [$checkIn, $checkOut])
    //                 ->orWhereBetween('check_out', [$checkIn, $checkOut])
    //                 ->orWhere(function ($query) use ($checkIn, $checkOut) {
    //                     $query->where('check_in', '<', $checkIn)->where('check_out', '>', $checkOut);
    //                 });
    //         })
    //         ->exists();

    //     if ($isBooked) {
    //         return redirect()
    //             ->back()
    //             ->withErrors(['error' => 'Room is already booked for the selected dates.']);
    //     }

    //     // إعداد Stripe
    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    //     try {
    //         // معالجة الدفع
    //         $charge = \Stripe\Charge::create([
    //             'amount' => $request->total_price, // تأكد من إضافة حقل total_price في النموذج
    //             'currency' => 'usd',
    //             'source' => $request->stripeToken,
    //             'description' => 'Booking for ' . $request->customer_name,
    //         ]);

    //         // إنشاء الحجز
    //         $reservation = Reservation::create($request->all());

    //         // تحديث حالة الغرفة
    //         $room = Room::find($reservation->room_id);
    //         $room->status = 1; // تغيير حالة الغرفة إلى محجوزة
    //         $room->save();

    //         return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()
    //             ->back()
    //             ->withErrors(['error' => 'Payment failed: ' . $e->getMessage()]);
    //     }
    // }

    public function store(Request $request)
    {
        // تحقق من صحة المدخلات
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'people' => 'required|integer|min:1',
        ]);

        // جلب بيانات الغرفة
        $room = Room::findOrFail($request->room_id);

        // تحقق مما إذا كانت الغرفة محجوزة في نفس التواريخ
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $totalNights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price * $totalNights * 100; // تحويل السعر إلى سنتات

        $isBooked = Reservation::where('room_id', $room->id)
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

        // إعداد Stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // معالجة الدفع
            $charge = \Stripe\Charge::create([
                'amount' => $totalPrice, // تأكد من حساب totalPrice هنا
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Booking for ' . $request->customer_name,
            ]);

            // إنشاء الحجز مع تضمين قيمة total_price
            $reservationData = $request->except('stripeToken');
            $reservationData['total_price'] = $totalPrice;
            $reservation = Reservation::create($reservationData);

            // تحديث حالة الغرفة
            $room->status = 1; // تغيير حالة الغرفة إلى محجوزة
            $room->save();

            return redirect()->back()->with('success', 'Reservation created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Payment failed: ' . $e->getMessage()]);
        }
    }
}
