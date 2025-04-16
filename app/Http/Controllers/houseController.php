<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class houseController extends Controller
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
        // $this->authorizeResource('house');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', House::class);
        $house = House::paginate(4);
        return view('house.index', compact('house'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', House::class);
        return view('house.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', House::class);
        $request->validate([
            'title' => 'required',
            'Description' => 'required',
            'image1' => 'required|image',
            'image2' => 'required|image',
        ]);

        $input = $request->all();

        if ($image1 = $request->file('image1')) {
            $destinationPath = 'images/';
            $profileImage1 = date('YmdHis') . '_1.' . $image1->getClientOriginalExtension();
            $image1->move($destinationPath, $profileImage1);
            $input['image1'] = $profileImage1;
        }

        if ($image2 = $request->file('image2')) {
            $profileImage2 = date('YmdHis') . '_2.' . $image2->getClientOriginalExtension();
            $image2->move($destinationPath, $profileImage2);
            $input['image2'] = $profileImage2;
        }

        House::create($input);
        return redirect()->route('house.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $this->authorize('update', $house);
        $house = House::findOrFail($id);
        return view('event.edit', compact('house'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {
        $request->validate([
            'title' => 'required',
            'Description' => 'required',
            'image1' => 'required|image',
            'image2' => 'required|image',
        ]);

        $input = $request->all();

        if ($image1 = $request->file('image1')) {
            $destinationPath = 'images/';
            $profileImage1 = date('YmdHis') . '_1.' . $image1->getClientOriginalExtension();
            $image1->move($destinationPath, $profileImage1);
            $input['image1'] = $profileImage1;
        }

        if ($image2 = $request->file('image2')) {
            $profileImage2 = date('YmdHis') . '_2.' . $image2->getClientOriginalExtension();
            $image2->move($destinationPath, $profileImage2);
            $input['image2'] = $profileImage2;
        }

        $house->update($input);
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        $this->authorize('delete', $house);
        $house->delete();
        return redirect()->route('house.index');
    }
}
