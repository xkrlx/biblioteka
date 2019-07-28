<?php

namespace App\Http\Controllers\AdminAuth;

use App\Arrear;
use App\ArrearSetting;
use App\Book;
use App\Booking;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnController extends Controller
{
    public function index()
    {
        $books=Book::where('status',false)->paginate('10');
        return view('admin.auth.librarian.return.return_list',compact('books'));
    }

    public function available()
    {
        $books=Book::where('status',true)->paginate('10');
        return view('admin.auth.librarian.return.available_list',compact('books'));
    }

    public function bookings()
    {
        $bookings=Booking::where('active',true)->paginate('10');
        return view('admin.auth.librarian.return.bookings',compact('bookings'));
    }

    public function index2()
    {
        return view('admin.auth.librarian.return.return');
    }

    public function index_books(Request $request)
    {
        $bookings=Booking::all()->where('user_id',$request->user_id)->where('active',true);

        if(empty(Booking::where('user_id',$request->user_id)->where('active',true)->first())){
            return back()->with('error', 'Użytkownik nie ma wypożyczonych żadnych książek');
        }
        else{
            return view('admin.auth.librarian.return.user',compact('bookings'),compact('book'));
        }


    }

    public function confirm(Booking $booking)
    {
        $date1=$booking->date_to;
        $date2=date("Y-m-d");
        function dateDiff($date1, $date2)
        {
            $date1_ts = strtotime($date1);
            $date2_ts = strtotime($date2);
            $diff = $date2_ts - $date1_ts;
            return round($diff / 86400);
        }
        $dateDiff= dateDiff($date1, $date2);
        $penalty=0;


        if($dateDiff<=0){
            $penalty=0;
        }
        else if($dateDiff<=14){
            $ArrearSetting=ArrearSetting::where('days',14)->first();
            $cost_per_day=$ArrearSetting->cost_per_day;
            $penalty=$dateDiff*$cost_per_day;
        }
        else if($dateDiff<=30){
            $ArrearSetting=ArrearSetting::where('days',30)->first();
            $cost_per_day=$ArrearSetting->cost_per_day;
            $penalty=$dateDiff*$cost_per_day;
        }
        else{
            $ArrearSetting=ArrearSetting::where('days',90)->first();
            $cost_per_day=$ArrearSetting->cost_per_day;
            $penalty=$dateDiff*$cost_per_day;
        }


        $days=$dateDiff;

        return view('admin.auth.librarian.return.confirmation',compact('booking'),compact('penalty','days'));
    }

    public function return(Request $request,Booking $booking)
    {
        if(Booking::where('id',$booking->id)->where('active',false)->first()){
            return redirect('/admin/library')->with('error', 'Książka została już zwrócona');
        }
        else {

        $booking->update(['active' => false]);
        $booking->update(['date_end'=>date("Y-m-d")]);
        Book::where('book_id', $booking->book->book_id)->update(['status' => true]);
        $penalty=$request->penalty;


            if ($penalty != 0) {
                Arrear::create([
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id,
                    'cost' => $request->penalty,
                    'days' => $request->days,
                    'paid_status'=>false,
                ]);
            }

            return redirect('/admin/library')->with('success', 'Książka została zwrócona');
        }
    }



}
