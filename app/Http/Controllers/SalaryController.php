<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutsidePayment;

class SalaryController extends Controller
{

    public function index()
    {
        $allcolors = OutsidePayment::where('transaction_type',2)->orderBy('id', 'DESC')->get();
        return view('salary.list', compact('allcolors'));
    }
    public function add($id = null)
    {


        if (is_null($id)) {
            return view('salary.add');
        } else {
            $getfarmerbyId = OutsidePayment::find($id);
            return view('salary.add', compact('getfarmerbyId'));
        }
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'payment_date' => 'required',
            'amount' => 'required',
            'payment_mode' =>'required'

        ]);
        $input_array = array(
            'name' => $request->name,
            'payment_date' => $request->payment_date,
            'transaction_type' => 2,
            'amount' => $request->amount,
            'trnsaction_number' =>$request->tansaction_number,
            'payment_mode' =>$request->payment_mode,
        );

        if ($request->id == 0) {
            OutsidePayment::create($input_array);
            return redirect('salary/')->with('success', 'Payment Details has been created successfully');
        } else {
            $farmer = OutsidePayment::findOrFail($request->id);
            if ($farmer) {
                $farmer->payment_date =  $request->payment_date;
                $farmer->name  = $request->name;
                $farmer->amount  = $request->amount;
                $farmer->trnsaction_number  = $request->tansaction_number;
                $farmer->payment_mode  = $request->payment_mode;
                $farmer->save();
                return redirect('salary/')->with('success', 'Payment Details has been updated successfully');
            } else {
                return redirect('salary/')->with('error', 'Payment Details Not Found');
            }
        }
    }
    public function delete($id)
    {

        $salary = OutsidePayment::findOrFail($id);

        if ($salary)
        {
            OutsidePayment::find($id)->delete();
            return redirect('salary/')->with('success', 'Paymet details has been deleted successfully');
        }

       
    }
}
