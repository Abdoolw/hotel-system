<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class historyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $history = History::paginate(4);
        return view('history.index', compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('history.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'Description' => 'required',
        ]);

        $input = $request->all();

        History::create($input);
        return redirect()->route('history.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $history = History::findOrFail($id);
        return view('history.edit', compact('history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'Description' => 'required',
        ]);

        $input = $request->all();

        $history->update($input);
        return redirect()->route('history.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        $history->delete();
        return redirect()->route('history.index');
    }
}
