<?php

namespace App\Http\Controllers\UserAuth;

use App\Arrear;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Bookings extends Controller
{
    public function index()
    {
        $bookings=Booking::where('active',true)->where('user_id',Auth::user()->id)->paginate('10');
        //dd($bookings);
        return view('user.auth.bookings',compact('bookings'));
    }

    public function oldbookings()
    {
        $bookings=Booking::where('active',false)->where('user_id',Auth::user()->id)->paginate('10');
        return view('user.auth.oldbookings',compact('bookings'));
    }

    public function penalties()
    {
        $penalties=Arrear::where('user_id',Auth::user()->id)->paginate('10');
        return view('user.auth.penalties',compact('penalties'));
    }
}
