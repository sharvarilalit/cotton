<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Farmer;

class FarmerController extends Controller
{

    public function index()
    {
        $allcolors = Farmer::with('trucks')->orderBy('id', 'DESC')->get();
        return view('farmer.list', compact('allcolors'));
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
            'cotton_weight' => 'required',
            'truck_id' =>'required',
            'price' => 'required',
            'total_amount' => 'required',
            'payment_status' => 'required',
            'payment_mode' => 'required',
            'quantity' => 'required',
            'date' => 'required'
        ]);
        $input_array = array(
            'date' => $request->date,
            'location' => $request->location,
            'name' => $request->name,
            'cotton_weight' => $request->cotton_weight,
            'truck_id' => $request->truck_id,
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
            return redirect('farmer/')->with('success', 'Farmer Details has been created successfully');
        } else {
            $farmer = Farmer::findOrFail($request->id);
            if ($farmer) {
                $farmer->date = $request->date;
                $farmer->location =  $request->location;
                $farmer->name  = $request->name;
                $farmer->cotton_weight  = $request->cotton_weight;
                $farmer->truck_id  = $request->truck_id;
                $farmer->price  = $request->price;
                $farmer->total_amount  = $request->total_amount;
                $farmer->paid_amount  = $request->paid_amount;
                $farmer->pending_amount  = $request->pending_amount;
                $farmer->payment_status  = $request->payment_status;
                $farmer->quantity  = $request->quantity;
                $farmer->payment_mode  = $request->payment_mode;
                $farmer->save();
                return redirect('farmer/')->with('success', 'Farmer Details has been updated successfully');
            } else {
                return redirect('farmer/')->with('error', 'Farmer Details Not Found');
            }
        }
    }
    public function delete($id)
    {
        Farmer::find($id)->delete();
        return redirect('farmer/')->with('success', 'Farmer Details has been deleted successfully');
    }
}
