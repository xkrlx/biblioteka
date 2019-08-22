<?php

namespace App\Http\Controllers\AdminAuth;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BooksController extends Controller
{
    public function create()
    {
        $_categories = Category::where('active',true)->get();

        $categories = [];
        foreach ($_categories as $category) {
            $categories += [$category->id=>$category->name];
        }
        return view('admin.auth.librarian.add',compact('categories'));
    }

    public function store(Request $request)
    {
            $this->validate($request, [
                'book_id' => 'required|integer|unique:books',
                'title' => 'required|max:100',
                'year' => 'required|integer|digits:4|min:1900|max:2019',
                'author' => 'required',
                'category_id' =>'required',
                'publisher' => 'required',
                'pages' => 'required|numeric',
                'description' => 'required|max:250',
                'photo' => 'nullable|image|mimes:jpeg,png,gif|max:4096',
            ], [
                'book_id.required' => 'Podaj numer książki',
                'book_id.unique' => 'Książka o numerze '.$request->book_id.' już znajduje się w bazie!',
                'title.required' => 'Tytuł jest wymagany',
                'title.max' => 'Tytuł jest za długi',
                'year.required' => 'Podaj rok wydania książki',
                'year.digits' => 'Rok to 4 cyfry',
                'year.min' => 'Podaj prawidłowy rok',
                'year.max' => 'Podaj prawidłowy rok2',
                'author.required' => 'Podaj imie i nazwisko autora',
                'category_id' => 'Wybierz kategorie',
                'publisher.required' => 'Podaj nazwe wydawacy',
                'pages.required' => 'Podaj ilość stron',
                'pages.numeric' => 'Ilość stron to tylko cyfry',
                'description.required' => 'Podaj opis',
                'description.max' => 'Opis jest za długi',
                'photo.mimes' => 'Nieprawidłowe rozszerzenie',
            ]);
            $new_name = null;
            $image = $request->file('photo');
            if ($image) {
                $new_name = rand() . '.' . $image->getClientOriginalName();

                $image->move(public_path('images/covers'), $new_name);
            }


            Book::create([
                'book_id' => $request->book_id,
                'title' => $request->title,
                'year' => $request->year,
                'author' => $request->author,
                'category_id' => $request->category_id,
                'publisher' => $request->publisher,
                'pages' => $request->pages,
                'description' => $request->description,
                'photo' => $new_name,
            ]);
            return redirect()->route('admin.add.book')->with('success','Książka o numerze '.$request->book_id.' została dodana!');

    }

    public function index()
    {
        $books = Book::orderBy('book_id', 'desc')->paginate(10);
        return view('admin.auth.librarian.index_list', compact('books'));
    }

    public function edit(Book $book)
    {
        $_categories = Category::where('active',true)->get();

        $categories = [];
        foreach ($_categories as $category) {
            $categories += [$category->id=>$category->name];
        }
        return view('admin.auth.librarian.edit',compact('book'),compact('categories'));
    }

    public function update(Request $request,Book $book)
    {
        if($book->book_id==$request->book_id or !Book::where('book_id',$request->book_id)->first())
        {
        $this->validate($request,[
            'book_id'=>'required|integer',
            'title'=>'required|max:100',
            'year'=>'required|integer|digits:4|min:1900|max:2019',
            'author'=>'required',
            'category_id' =>'required',
            'publisher'=>'required',
            'pages'=>'required|integer',
            'description' => 'required|max:250',
            'photo'=>'nullable|image|mimes:jpeg,png,gif|max:4096',
        ],[
            'book_id.required'=>'Podaj numer książki',
            'title.required'=>'Tytuł jest wymagany',
            'title.max'=>'Tytuł jest za długi',
            'year.required'=>'Podaj rok wydania książki',
            'year.digits'=>'Rok to 4 cyfry',
            'year.min'=>'Podaj prawidłowy rok',
            'year.max'=>'Podaj prawidłowy rok2',
            'author.required'=>'Wpisz hasło',
            'category_id' =>'Wybierz kategorie',
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
            'book_id'=>$request->book_id,
            'title' => $request->title,
            'year' => $request->year,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'publisher' => $request->publisher,
            'pages' => $request->pages,
            'description' => $request->description,
            'photo' => $new_name,
        ]);
        return redirect()->route('admin.list.book');
        }

        else{
            return back()->with('error', 'Książka o numerze '.$request->book_id.' już znajduje się w bazie!');
        }

    }
}
