<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
    {
         $this->middleware('permission:image-list|image-create|image-edit|image-delete', ['only' => ['index','show']]);
         $this->middleware('permission:image-create', ['only' => ['create','store']]);
         $this->middleware('permission:image-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:image-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::paginate(4);
        return view('Gallery.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Image::create($input);
        return redirect()->route('Gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $images = Image::findOrFail($id);
        return view('Gallery.edit', compact('images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        $request->validate([
            'image' => 'required|image',
        ]);
        $input = $request->all();

        if ($photo = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . '.' . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        $image->update($input);
        return redirect()->route('Gallery.index')->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Image::find($id)->delete();
        return redirect()->route('Gallery.index')->with('success', 'Image deleted successfully.');
    }

}
