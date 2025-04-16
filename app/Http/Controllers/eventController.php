<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class eventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:image-list|image-create|image-edit|image-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:image-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:image-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:image-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::paginate(4);
        return view('event.index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'Description' => 'required',
            'image' => 'required|image',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Event::create($input);
        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'Description' => 'required',
            'image' => 'required|image',
        ]);

        $input = $request->all();

        if ($photo = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . '.' . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        $event->update($input);
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('event.index');
    }
}
