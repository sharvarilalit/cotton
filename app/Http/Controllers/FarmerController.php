<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Farmer;
use App\Models\OutsidePayment;
use App\Models\FarmerTransactions;
use Illuminate\Support\Facades\DB;

class FarmerController extends Controller
{

    public function index(Request $request)
    {

        $farmer = Farmer::all();

        $allcolors =  DB::table('farmer');

        if ($request->farmer_id) {
            $allcolors =  $allcolors->where('id', $request->farmer_id);
        }
       

        $allcolors =  $allcolors->orderBy('id', 'DESC')->get();
        return view('farmer.list', compact('allcolors','farmer'));
    }
    public function add($id = null)
    {

        $truck = Truck::all();

        if (is_null($id)) {
            return view('farmer.add',compact('truck'));
        } else {
            $getfarmerbyId = Farmer::find($id);
            return view('farmer.add', compact('getfarmerbyId','truck'));
        }
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:farmer,name,' . $request->id,
            'location' => 'required',
            'contact' => 'required'
        ]);
        $input_array = array(
            'location' => $request->location,
            'name' => $request->name,
            'contact' => $request->contact,
            'alternate_contact' => $request->alternate_contact
        );

        if ($request->id == 0) {
            Farmer::create($input_array);
            return redirect('farmer/')->with('success', 'Farmer Details has been created successfully');
        } else {
            $farmer = Farmer::findOrFail($request->id);
            if ($farmer) {
                $farmer->location =  $request->location;
                $farmer->name  = $request->name;
                $farmer->contact  = $request->contact;
                $farmer->alternate_contact  = $request->alternate_contact;
                $farmer->save();
                return redirect('farmer/')->with('success', 'Farmer Details has been updated successfully');
            } else {
                return redirect('farmer/')->with('error', 'Farmer Details Not Found');
            }
        }
    }
    public function delete($id)
    {

        $farmer = Farmer::findOrFail($id);

        if ($farmer->ftransactions()->exists())
        {
            return redirect('farmer/')->with('error', 'Farmer cannot be deleted due to existence of related resources.');
        }

        Farmer::find($id)->delete();
        return redirect('farmer/')->with('success', 'Farmer Details has been deleted successfully');
    }

    public function extraPayment($id = null) 
    {
         // $truck = Truck::all();
        if (is_null($id)) {
            return redirect('farmer/')->with('error', 'Something went wrong.Please try again !!!');
        } else {
            $getfarmerbyId =Farmer::find($id);;
            // var_dump( $getfarmerbyId);
            return view('farmer.extra-payment-add', compact('getfarmerbyId'));
        }
         
    }

    public function extraSave(Request $request) {
        $request->validate([
            'name' => 'required',
            'payment_date' => 'required',
            'amount' => 'required',
            'payment_mode' =>'required'

        ]);
        // var_dump($request->id);exit;
        $input_array = array(
            'name' => $request->name,
            'farmer_id' => (int)$request->id,
            'payment_date' => $request->payment_date,
            'transaction_type' => 3,
            'amount' => $request->amount,
            // 'trnsaction_number' =>$request->tansaction_number,
            'payment_mode' =>$request->payment_mode,
        );

        if ($request->id == 0) {
           return redirect('farmer/')->with('error', 'Payment Details Not Found');
        } else {
           
             OutsidePayment::create($input_array);
            return redirect('farmer/')->with('success', 'Payment Details has been created successfully');
            
        }
    }

    public function extraList($id = null) {

         if (is_null($id)) {
            return redirect('farmer/')->with('error', 'Something went wrong.Please try again !!!');
        } else {
            $far_payment =  DB::table('outside_payment');
       
            $far_payment = $far_payment->where('transaction_type',3);
            $far_payment = $far_payment->where('farmer_id',$id);
            $far_payment =  $far_payment->orderBy('id', 'DESC')->get();
            return view('farmer.extra-payment-list', compact('far_payment'));
        }
         
    }

     public function extraDelete($id = null)
    {    

        if (is_null($id)) {
            return redirect('farmer/')->with('error', 'Something went wrong.Please try again !!!');
        } else {
            $far_payment =  DB::table('outside_payment');
       
            $far_payment = $far_payment->where('transaction_type',3);
            $far_payment = $far_payment->where('id',$id)->delete();
        }

        return redirect('farmer/')->with('success', 'Payment Details has been deleted successfully');
    }
}
