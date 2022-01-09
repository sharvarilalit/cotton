<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\TruckCharges;
use Illuminate\Validation\Rule;

class TruckChargesController extends Controller
{

    public function index(Request $request)
    {
        $truck = Truck::all();
       
        $allcolors = TruckCharges::with('trucks');
        
        if ($request->truck_id) {
            $allcolors =  $allcolors->where('truck_id', $request->truck_id);
        }
        if ($request->date) {
            $allcolors =  $allcolors->where('date', $request->date);
        }

        $allcolors =  $allcolors->orderBy('id', 'DESC')->get();
        return view('truckCharges.list', compact('allcolors', 'truck'));


        // $allcolors = TruckCharges::all();
        // return view('truckCharges.list', compact('allcolors'));
    }
    public function add($id = null)
    {
        $truck = Truck::all();
        
        if (is_null($id)) {        
            return view('truckCharges.add', compact('truck'));
        } else {
            $getTruckbyId = TruckCharges::find($id);
            return view('truckCharges.add', compact('getTruckbyId','truck'));
        }
    }
    public function save(Request $request)
    {

        $request->validate([          
            'truck_id' => 'required',
            'date' => Rule::unique('truck_charges')->ignore($request->id)->where(function ($query) use ($request) {
                return $query->where('truck_id', $request->truck_id)->where('date',$request->date);
            }),
            'village_charges' => 'required',
            'vehicle_charges' => 'required',
            'labor_charges' => 'required',
            'village_commision' => 'required',
            'route_charges' => 'required', 
            'vehicle_filling_out_charges' => 'required',
            'angadi_return_person_charges' => 'required',
            'total_charges_amount' => 'required',
            'jingping_amount' => 'required',
        ]);

       
        $input_array = array(
            'truck_id' => $request->truck_id,
            'date' => $request->date,
            'village_charges' => $request->village_charges,
            'vehicle_charges' => $request->vehicle_charges,
            'labor_charges' => $request->labor_charges,
            'village_commision' => $request->village_commision,
            'route_charges' => $request->route_charges, 
            'vehicle_filling_out_charges' => $request->vehicle_filling_out_charges,
            'angadi_return_person_charges' => $request->angadi_return_person_charges,
            'total_charges_amount' => $request->total_charges_amount,
            'jingping_amount' => $request->jingping_amount,
        );

        if ($request->id == 0) {
            TruckCharges::create($input_array);
            return redirect('truck-charges/')->with('success', 'Truck Charges has been created successfully');
        } else {

            $truck = TruckCharges::findOrFail($request->id);
            if ($truck) {
                $truck->truck_id  = $request->truck_id;
                $truck->date = $request->date;
                $truck->village_charges =  $request->village_charges;
                $truck->vehicle_charges =  $request->vehicle_charges;
                $truck->labor_charges =  $request->labor_charges;
                $truck->village_commision =  $request->village_commision;
                $truck->route_charges =  $request->route_charges;
                $truck->vehicle_filling_out_charges =  $request->vehicle_filling_out_charges;
                $truck->angadi_return_person_charges =  $request->angadi_return_person_charges;
                $truck->total_charges_amount =  $request->total_charges_amount;
                $truck->jingping_amount =  $request->jingping_amount;
                $truck->save();
                return redirect('truck-charges/')->with('success', 'Truck Charges has been updated successfully');
            } else {
                return redirect('truck-charges/')->with('error', 'Truck Charges Not Found');
            }
        }
    }
    public function delete($id)
    {
        TruckCharges::find($id)->delete();
        return redirect('truck-charges/')->with('success', 'Truck Charges has been deleted successfully');
    }
}
