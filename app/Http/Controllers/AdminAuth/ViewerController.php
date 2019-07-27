<?php

namespace App\Http\Controllers\AdminAuth;

use App\Arrear;
use App\Book;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewerController extends Controller
{
    public function index()
    {
        return view('admin.auth.viewer.index');
    }

    public function book_list()
    {
        $books = Book::orderBy('book_id', 'desc')->paginate(10);
        return view('admin.auth.viewer.book_list',compact('books'));
    }
    public function available()
    {
        $books=Book::where('status',true)->paginate('10');
        return view('admin.auth.viewer.available',compact('books'));
    }

    public function return_list()
    {
        $books=Book::where('status',false)->paginate('10');
        return view('admin.auth.viewer.return_list',compact('books'));
    }

    public function bookings()
    {
        $bookings=Booking::where('active',true)->paginate('10');
        return view('admin.auth.viewer.bookings',compact('bookings'));
    }

    public function unpaid()
    {
        $penalties=Arrear::where('paid_status',false)->paginate('10');
        return view('admin.auth.viewer.unpaid_penalties',compact('penalties'));
    }

    public function paid()
    {
        $penalties=Arrear::where('paid_status',true)->paginate('10');
        return view('admin.auth.viewer.paid_penalties',compact('penalties'));
    }
}
