<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;

class roomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::paginate(4);
        return view('rooms.index', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'people' => 'required|integer|min:1',
            'image' => 'nullable|image',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Room::create($input);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'people' => 'required|integer|min:1',
            'image' => 'nullable|image',
        ]);

        $input = $request->all();

        if ($photo = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . '.' . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        $room->update($input);
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();
            return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('rooms.index')
                ->with('error', 'Error deleting room: ' . $e->getMessage());
        }
    }
}
