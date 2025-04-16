<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class reservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('room')->get();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::where('status', '=', '0')->get();
        return view('reservations.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'room_id' => 'required|exists:rooms,id',
    //         'customer_name' => 'required|string|max:255',
    //         'phone' => 'required|string|max:15',
    //         'email' => 'required|email|max:255',
    //         'check_in' => 'required|date|after_or_equal:today',
    //         'check_out' => 'required|date|after:check_in',
    //         'people' => 'required|integer|min:1',
    //     ]);
    //     $reservation = Reservation::create($request->all());
    //     $room = Room::find($reservation->room_id);
    //     $room->status = 1;
    //     $room->save();

    //     return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'people' => 'required|integer|min:1',
        ]);

        // تحقق مما إذا كانت الغرفة محجوزة في نفس التواريخ
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

        // إنشاء الحجز
        $reservation = Reservation::create($request->all());
        $room = Room::find($reservation->room_id);
        $room->status = 1; // تغيير حالة الغرفة إلى محجوزة
        $room->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        return view('reservations.edit', compact('reservation', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // $request->validate([
        //     'room_id' => 'required|exists:rooms,id',
        //     'customer_name' => 'required|string|max:255',
        //     'phone' => 'required|string|max:15',
        //     'email' => 'required|email|max:255',
        //     'check_in' => 'required|date|after_or_equal:today',
        //     'check_out' => 'required|date|after:check_in',
        //     'people' => 'required|integer|min:1',
        // ]);

        // $reservation->update($request->all());

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'people' => 'required|integer|min:1',
        ]);

        if ($reservation->room_id !== $request->room_id) {
            $oldRoom = Room::find($reservation->room_id);
            $oldRoom->status = 0;
            $oldRoom->save();
            $newRoom = Room::find($request->room_id);
            $newRoom->status = 1;
            $newRoom->save();
        }
        $reservation->update($request->all());
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        // تحديث حالة الغرفة إلى "متاحة"
        $room = Room::find($reservation->room_id);
        $room->status = 0; // أو الحالة التي تعني "متاحة"
        $room->save();
        // حذف الحجز
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
