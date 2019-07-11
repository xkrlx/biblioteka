<?php

namespace App\Http\Controllers\AdminAuth;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::paginate(10);
        return view('admin.auth.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $_roles = Role::get();

        $roles = [];
        foreach ($_roles as $role) {
            $roles += [$role->id=>$role->name];
        }
        return view('admin.auth.admins.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'role_id'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|confirmed',
        ],[
            'name.required'=>'Wpisz imię',
            'role_id.required'=>'Wybierz rolę',
            'password.required'=>'Wpisz hasło'
        ]);

        Admin::create([
           'name' =>$request->name,
           'email' =>$request->email,
           'role_id' =>$request->role_id,
           'password' =>bcrypt($request->password),
        ]);
        return redirect()->route('admin.index.admin');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $_roles = Role::get();

        $roles = [];
        foreach ($_roles as $role) {
            $roles += [$role->id=>$role->name];
        }
        return view('admin.auth.admins.edit',compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Admin $admin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Admin $admin)
    {
        $this->validate($request,[
            'name'=>'required',
            'role_id'=>'required',
            'email'=>[
                'required',
                'email',
                Rule::unique('admins')->ignore($admin->id),
            ],
        ],[
            'name.required'=>'Wpisz imię',
            'role_id.required'=>'Wybierz rolę',
        ]);
        $admin->update([
            'name'=>$request->name,
            'role_id'=>$request->role_id,
            'email'=>$request->email,
        ]);
        return redirect()->route('admin.index.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index.admin');
    }
}
