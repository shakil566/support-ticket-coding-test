<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $openTicketsCount = Issue::where('status', 'Open');

        if (auth()->user()->user_group == 2) {
            $openTicketsCount = $openTicketsCount->where('created_by', auth()->user()->id);
        }

        $openTicketsCount = $openTicketsCount->count();

        $closedTicketsCount = Issue::where('status', 'Closed');

        if (auth()->user()->user_group == 2) {
            $closedTicketsCount = $closedTicketsCount->where('created_by', auth()->user()->id);
        }

        $closedTicketsCount = $closedTicketsCount->count();


        return view('home', compact('openTicketsCount', 'closedTicketsCount'));
    }
}