<?php

namespace App\Http\Controllers\UserAuth;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    public function show(Request $request)
    {
        $book=Book::find($request->book_id);
        return view('user.auth.show',compact('book'));
    }
}
