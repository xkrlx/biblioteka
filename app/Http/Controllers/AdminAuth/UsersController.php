<?php

namespace App\Http\Controllers\AdminAuth;

use App\Arrear;
use App\Booking;
use App\DeleteUser;
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
            'email'=>'required|email|unique:users',
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
        if(Booking::where('user_id',$user->id)->where('active',true)->first() or Arrear::where('user_id',$user->id)->where('paid_status','false')->first()){
            return redirect()->back()->with('error','Użytkownik ma aktywne wypożyczenia lub nieopłaconą kare');
        }
        else{
            $user->delete();

            return redirect()->back();
        }
    }

    public function edit(User $user)
    {
        return view('admin.auth.librarian.edit_user',compact('user'));
    }

    public function update(Request $request,User $user)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
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

    public function delete_accounts()
    {

        $deletes=DeleteUser::where('status',false)->paginate('10');

        return view('admin.auth.librarian.delete_accounts',compact('deletes'));
    }

    public function destroy_account($delete_id)
    {
        $delete=DeleteUser::where('id',$delete_id)->first();
        $user=User::where('id',$delete->user_id)->first();

        if(Booking::where('user_id',$user->id)->where('active',true)->first() or Arrear::where('user_id',$user->id)->where('paid_status','false')->first()){
            return redirect()->back()->with('error','Użytkownik ma aktywne wypożyczenia lub nieopłaconą kare');
        }
        else{
            $delete->update(['status' => true]);

            $user->delete();

            return redirect()->back()->with('success','Konto zostało usunięte');
        }
    }

}
