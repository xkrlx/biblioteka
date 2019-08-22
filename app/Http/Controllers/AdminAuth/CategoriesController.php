<?php

namespace App\Http\Controllers\AdminAuth;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.auth.librarian.category_management',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:3'
        ],[
            'name.required'=>'Podaj nazwe kategorii'
        ]);

        Category::create([
           'name'=> $request->name,
            'active' =>true,
        ]);

        return back();
    }

    public function change(Category $category)
    {
        if($category->active==true){
            $category->update([
                'active' =>false,
            ]);
        }
        else{
            $category->update([
                'active' =>true,
            ]);
        }
        return back();
    }
}
