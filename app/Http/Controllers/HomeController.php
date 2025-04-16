<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    // public function index()
    // {

    //     return view('home');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        $users = User::select(DB::raw('COUNT(*) as count'))->whereYear('created_at', date('Y'))->groupBy(DB::raw('Month(created_at)'))->pluck('count');

        return view('home', compact('users'));
    }
}
