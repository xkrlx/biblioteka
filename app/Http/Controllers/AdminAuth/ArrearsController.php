<?php

namespace App\Http\Controllers\AdminAuth;

use App\Arrear;
use App\ArrearSetting;
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

    public function show_arrears_set()
    {
        $arrearSettings = ArrearSetting::paginate(10);
        return view('admin.auth.librarian.arrears_set',compact('arrearSettings'));
    }

    public function edit(ArrearSetting $arrearSetting)
    {
        dd($arrearSetting);
        return view('admin.auth.librarian.edit_arrears_set',compact('arrearSetting'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request,[
            'cost_per_day' => 'required|numeric',
        ],[
            'cost_per_day.required' => 'Pole nie może być puste',
            'cost_per_day.digit' => 'Tylko liczba',

        ]);
        $arrearSetting=ArrearSetting::where('days',$request->days)->first();
        $arrearSetting->update([
            'cost_per_day'=>$request->cost_per_day,
        ]);


        //$arrearSettings = ArrearSetting::paginate(10);
        return redirect()->route('admin.index.library')->with('success','Wysokość kary została zaaktualizowana');
    }
}
