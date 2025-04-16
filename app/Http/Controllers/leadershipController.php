<?php

namespace App\Http\Controllers;

use App\Models\Leadership;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class leadershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leadership = Leadership::paginate(4);
        return view('leadership.index', compact('leadership'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leadership.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'job' => 'required',
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

        Leadership::create($input);
        return redirect()->route('leadership.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leadership $leadership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leaderships = Leadership::findOrFail($id);
        return view('leadership.edit', compact('leaderships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leadership $leadership)
    {
        $request->validate([
            'name' => 'required',
            'job' => 'required',
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

        $leadership->update($input);
        return redirect()->route('leadership.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leadership $leadership)
    {
        $leadership->delete();
        return redirect()->route('leadership.index');
    }
}
