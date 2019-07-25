<?php

namespace App\Http\Controllers\AdminAuth;

use App\Arrear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrearsController extends Controller
{
    public function unpaid()
    {
        $penalties=Arrear::where('paid_status',false)->paginate('10');
        return view('admin.auth.librarian.unpaid_penalties',compact('penalties'));
    }

    public function paid()
    {
        $penalties=Arrear::where('paid_status',true)->paginate('10');
        return view('admin.auth.librarian.paid_penalties',compact('penalties'));
    }

    public function pay(Arrear $penalty)
    {
        $arrear=Arrear::where('id',$penalty->id)->first();

        $arrear->update([
           'paid_status'=>true,
        ]);

        return redirect()->back()->with('success','Opłata potwierdzona');
    }
}
