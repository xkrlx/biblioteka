<?php

namespace App\Http\Controllers\UserAuth;

use App\Arrear;
use App\Booking;
use App\DeleteUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $user=User::Find(Auth::user())->first();
        return view('user.auth.profile',compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.auth.edit',compact('user'));
    }

    public function update(Request $request,User $user)
    {
        $this->validate($request,[
            'name'=>'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'pesel' =>'required|pesel',
            'current' => 'required',
        ],[
            'name.required'=>'Wpisz imię',
            'pesel.required' => 'Podaj numer pesel',
            'pesel.pesel' => 'Podaj prawidłowy pesel',
            'current.required' => 'Podaj hasło',
            'email.required' => 'Podaj email',
            'email.unique' => 'Podany adres email jest już zajęty',
        ]);

        if (Hash::check( $request->input('current'), $user->password)){
            $user->update([
                'name' =>$request->name,
                'email' =>$request->email,
                'pesel' => $request->pesel,
            ]);

            return redirect()->route('user.profile')->with('success','Twoje dane zostały zaaktualizowane');
        }
        else{
            return redirect()->back()->with('error','Hasło jest nieprawidłowe');
        }
    }

    public function changepassword(User $user)
    {
        return view('user.auth.changepassword',compact('user'));
    }

    public function updatepassword(Request $request,User $user)
    {
        $this->validate($request,[
            'current' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ],[
            'current.required' => 'Pole nie może być puste',
            'password.required' => 'Pole nie może być puste',
            'password_confirmation.required' => 'Pole nie może być puste',
            'password.confirmed' => 'Podane hasła się różnią',
        ]);

        if (Hash::check( $request->input('current'), $user->password)) {
            $user->password = Hash::make($request->input('password'));
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success',"Hasło zostało zmienione");
        }
        else{
            return redirect()->back();
        }
    }

    public function delete(User $user)
    {
        if(Booking::where('user_id',$user->id)->where('active',true)->first() or Arrear::where('user_id',$user->id)->where('paid_status','false')->first()){
            return redirect()->back()->with('error','Użytkownik ma aktywne wypożyczenia lub nieopłaconą kare');
        }
        else{
            if(DeleteUser::where('user_id',$user->id)->first()){
                return redirect()->back()->with('error','Już zgłosiłeś prośbę o usunięcie konta');
            }
            else{
                return view('user.auth.delete',compact('user'));
            }

        }
    }

    public function confirmdelete(Request $request,User $user)
    {
        $this->validate($request,[
            'current' => 'required',
            'reason' => 'required|max:250'
        ],[
            'current.required' => 'Podaj hasło',
            'reason.required' => 'Podaj powód usunięcia konta',
            'reason.max' => 'Max 250 znaków',
        ]);
        if (Hash::check( $request->input('current'), $user->password)){
        DeleteUser::create([
            'user_id'=>$user->id,
            'reason'=>$request->reason,
            'status'=>false,
        ]);

        return redirect()->route('user.profile')->with('success','Twoje konto zostało zgłoszone do usunięcia');
        }
        else{
            return redirect()->back();
        }
    }
}
