<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $current_rate = Rate::all()->last();
        $allCount = Transaction::all()->count();
        $todayCount = Transaction::whereDate('created_at', Carbon::today())->count();

        return view('welcome',compact(["current_rate", "allCount", "todayCount"]));
    }
}
