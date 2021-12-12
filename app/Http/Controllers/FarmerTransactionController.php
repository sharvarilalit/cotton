<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Farmer;
use App\Models\FarmerTransactions;


class FarmerTransactionController extends Controller
{

    public function index()
    {
        $allcolors = FarmerTransactions::with('trucks','farmers')->orderBy('id', 'DESC')->get();
        return view('farmerTransactions.list', compact('allcolors'));
    }
    public function add($id = null)
    {

        $truck = Truck::all();
        $farmer = Farmer::all();

        if (is_null($id)) {
            return view('farmerTransactions.add',compact('truck','farmer'));
        } else {
            $getfarmerbyId = FarmerTransactions::find($id);
            return view('farmerTransactions.add', compact('getfarmerbyId','truck','farmer'));
        }
    }
    public function save(Request $request)
    {
        $request->validate([
            'cotton_weight' => 'required',
            'truck_id' =>'required',
            'farmer_id' =>'required',
            'price' => 'required',
            'total_amount' => 'required',
            'payment_status' => 'required',
            'payment_mode' => 'required',
            'quantity' => 'required',
            'date' => 'required'
        ]);
        $input_array = array(
            'date' => $request->date,
            'cotton_weight' => $request->cotton_weight,
            'truck_id' => $request->truck_id,
            'farmer_id' => $request->farmer_id,
            'price' => $request->price,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'pending_amount' => $request->pending_amount,
            'payment_status' => $request->payment_status,
            'payment_mode' => $request->payment_mode,
            'quantity' => $request->quantity,
        );

        if ($request->id == 0) {
            Farmer::create($input_array);
            return redirect('farmer-transaction/')->with('success', 'Farmer Transaction Details has been created successfully');
        } else {
            $farmer = FarmerTransactions::findOrFail($request->id);
            if ($farmer) {
                $farmer->date = $request->date;
                $farmer->cotton_weight  = $request->cotton_weight;
                $farmer->truck_id  = $request->truck_id;
                $farmer->price  = $request->price;
                $farmer->total_amount  = $request->total_amount;
                $farmer->paid_amount  = $request->paid_amount;
                $farmer->pending_amount  = $request->pending_amount;
                $farmer->payment_status  = $request->payment_status;
                $farmer->quantity  = $request->quantity;
                $farmer->payment_mode  = $request->payment_mode;
                $farmer->farmer_id  = $request->farmer_id;
                $farmer->save();
                return redirect('farmer-transaction/')->with('success', 'Farmer Transaction Details has been updated successfully');
            } else {
                return redirect('farmer-transaction/')->with('error', 'Farmer Transaction Details Not Found');
            }
        }
    }
    public function delete($id)
    {
        FarmerTransactions::find($id)->delete();
        return redirect('farmer-transaction/')->with('success', 'Farmer Transaction Details has been deleted successfully');
    }
}
