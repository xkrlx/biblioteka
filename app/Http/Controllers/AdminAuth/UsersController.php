<?php

namespace App\Http\Controllers\AdminAuth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function create()
    {
        return view('admin.auth.librarian.adduser');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|confirmed',
            'pesel' =>'required|pesel|unique:users',
        ],[
            'name.required'=>'Wpisz imię',
            'password.required'=>'Wpisz hasło',
            'pesel.required' => 'Podaj numer pesel',
            'pesel.pesel' => 'Podaj prawidłowy pesel',
            'pesel.unique' => 'Podany pesel jest zajety',
        ]);

        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
            'pesel' => $request->pesel,
            'active' => true,
        ]);
        return redirect()->route('admin.index.library');
    }

    public function index()
    {
        $users=User::where('active', false)->paginate('10');

        return view('admin.auth.librarian.newusers',compact('users'));
    }

    public function index2()
    {
        $users=User::where('active', true)->paginate('10');

        return view('admin.auth.librarian.users',compact('users'));
    }

    public function accept(Request $request,User $user)
    {
        $user->update([
            'active' => true,
        ]);

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back();
    }

    public function edit(User $user)
    {
        return view('admin.auth.librarian.edit_user',compact('user'));
    }

    public function update(Request $request,User $user)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:admins',
            'pesel' =>'required|pesel',
        ],[
            'name.required'=>'Wpisz imię',
            'pesel.required' => 'Podaj numer pesel',
            'pesel.pesel' => 'Podaj prawidłowy pesel',
        ]);

        $user->update([
            'name' =>$request->name,
            'email' =>$request->email,
            'pesel' => $request->pesel,
        ]);
        return redirect()->route('admin.index2.user');
    }

}
