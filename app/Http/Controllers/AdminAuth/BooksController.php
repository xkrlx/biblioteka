<?php

namespace App\Http\Controllers\AdminAuth;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
    public function create()
    {
        $book = Book::orderBy('created_at', 'desc')->first();
        return view('admin.auth.librarian.add',compact('book'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:100',
            'year'=>'required|integer|digits:4|min:1900|max:2019',
            'author'=>'required',
            'publisher'=>'required',
            'pages'=>'required|numeric',
            'description' => 'required|max:250',
            'photo'=>'nullable|image|mimes:jpeg,png,gif|max:4096',
        ],[
            'title.required'=>'Tytuł jest wymagany',
            'title.max'=>'Tytuł jest za długi',
            'year.required'=>'Podaj rok wydania książki',
            'year.digits'=>'Rok to 4 cyfry',
            'year.min'=>'Podaj prawidłowy rok',
            'year.max'=>'Podaj prawidłowy rok2',
            'author.required'=>'Wpisz hasło',
            'publisher.required'=>'Podaj nazwe wydawacy',
            'pages.required'=>'Podaj ilość stron',
            'pages.numeric'=>'Ilość stron to tylko cyfry',
            'description.required' => 'Podaj opis',
            'description.max' => 'Opis jest za długi',
            'photo.mimes' => 'Nieprawidłowe rozszerzenie',
        ]);
        $new_name=null;
        $image = $request->file('photo');
        if($image) {
            $new_name = rand() . '.' . $image->getClientOriginalName();

            $image->move(public_path('images/covers'), $new_name);
        }


        Book::create([
            'title' => $request->title,
            'year' => $request->year,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'pages' => $request->pages,
            'description' => $request->description,
            'photo' => $new_name,
        ]);

        return redirect()->route('admin.add.book');
    }

    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(10);
        return view('admin.auth.librarian.index_list', compact('books'));
    }

    public function edit(Book $book)
    {
        return view('admin.auth.librarian.edit',compact('book'));
    }

    public function update(Request $request,Book $book)
    {
        $this->validate($request,[
            'title'=>'required|max:100',
            'year'=>'required|integer|digits:4|min:1900|max:2019',
            'author'=>'required',
            'publisher'=>'required',
            'pages'=>'required|numeric',
            'description' => 'required|max:250',
            'photo'=>'nullable|image|mimes:jpeg,png,gif|max:4096',
        ],[
            'title.required'=>'Tytuł jest wymagany',
            'title.max'=>'Tytuł jest za długi',
            'year.required'=>'Podaj rok wydania książki',
            'year.digits'=>'Rok to 4 cyfry',
            'year.min'=>'Podaj prawidłowy rok',
            'year.max'=>'Podaj prawidłowy rok2',
            'author.required'=>'Wpisz hasło',
            'publisher.required'=>'Podaj nazwe wydawacy',
            'pages.required'=>'Podaj ilość stron',
            'pages.numeric'=>'Ilość stron to tylko cyfry',
            'description.required' => 'Podaj opis',
            'description.max' => 'Opis jest za długi',
            'photo.mimes' => 'Nieprawidłowe rozszerzenie',
        ]);

        $new_name=$book->photo;

        if($request->file('photo')){
            $file= $book->photo;
            $filename = public_path().'images/covers/'.$file;
            \File::delete($filename);

            $image = $request->file('photo');
            if($image) {
                $new_name = rand() . '.' . $image->getClientOriginalName();

                $image->move(public_path('images/covers'), $new_name);
            }
        }


        $book->update([
            'title' => $request->title,
            'year' => $request->year,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'pages' => $request->pages,
            'description' => $request->description,
            'photo' => $new_name,
        ]);
        return redirect()->route('admin.list.book');
    }
}
