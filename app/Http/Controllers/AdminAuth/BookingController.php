<?php

namespace App\Http\Controllers\AdminAuth;

use App\Book;
use App\Booking;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        return view('admin.auth.librarian.booking');
    }

    public function confirm(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required|integer|exists:users,id',
            'book_id'=>'required|integer|exists:books,book_id',

        ],[
            'user_id.required'=>'Podaj identyfikator użytkownika',
            'user_id.exists'=>'Brak użytkownika o podanym lub konto jest nieaktywne',
            'book_id.required'=>'Podaj numer książki',
            'book_id.exists'=>'Brak książki o podanym numerze',

        ]);

        $user=User::where('id',$request->user_id)->first();

        $book=Book::where('book_id',$request->book_id)->first();

        if($book->status==false){
            return redirect()->route('admin.index.library')->with('error','Wybrana książka nie jest dostępna');
        }
        else if($user->active==false){
            return redirect()->route('admin.index.library')->with('error','Konto jest nieaktywne');
        }
        else {
            $request->session()->flash('info', 'Sprawdź poprawność danych');
            return view('admin.auth.librarian.confirmation', compact('user'), compact('book'));
        }
    }

    public function book(Request $request)
    {


        Book::where('book_id', $request->book_id)->update(['status' => false]);

        $book=Book::where('book_id',$request->book_id)->first();

        Booking::create([
           'user_id'=>$request->user_id,
           'book_id'=>$book->id,
           'date_from'=>date("Y-m-d"),
           'date_to'=>date('Y-m-d',strtotime('+30 days')),
           'active'=>true,
        ]);
        return redirect()->route('admin.index.library')->with('success','Książka została wypozyczona!');
    }
}
