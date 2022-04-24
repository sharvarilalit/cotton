<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\TruckCharges;
use App\Models\FarmerTransactions;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class TruckChargesController extends Controller
{

    public function index(Request $request)
    {
        $truck = Truck::all();
       
        $allcolors = TruckCharges::with('trucks');
        
        if ($request->truck_id) {
            $allcolors =  $allcolors->where('truck_id', $request->truck_id);
        }
        if ($request->filter_date) {
            $allcolors =  $allcolors->where('date', $request->filter_date);
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
        // var_dump("expression");die();

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
            // 'total_charges_amount' => 'required',
            // 'jingping_amount' => 'required',
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
            // 'total_charges_amount' => $request->total_charges_amount,
            // 'jingping_amount' => $request->jingping_amount,
            'truck_total_amount' => (int)str_replace(',', '', $request->total_amount),
            'product' => $request->product_type,
            'trip' => $request->trip,
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
                // $truck->total_charges_amount =  $request->total_charges_amount;
                // $truck->jingping_amount =  $request->jingping_amount;
                $truck->truck_total_amount = (int)str_replace(',', '', $request->total_amount);
                $truck->product =  $request->product_type;
                $truck->trip = $request->trip;
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

    public function getVillagecost(Request $request)
    {
        
        $get_village =  DB::table('farmer_transactions');
        $get_village =  $get_village->where('product', (int)$request->product_type);
        $get_village = $get_village->where('trip',(int)$request->truck_trip);
        $get_village = $get_village->where('truck_id',(int)$request->truck_no);
        $get_village =  $get_village->orderBy('id', 'DESC')->get();

        $total_amount = 0;
        $total_cotton = 0;
        $total_village_cost = 0;
        $msg ="";
        
        if(count($get_village) == 0) {
            $msg = "Data not exist. Please select proper product ,trip,truck no.";
        }
        else{
             foreach ($get_village as $key => $value) {
                $total_qty = $value->weight * $value->price;
                $total_cotton += $total_qty;
                $total_amount += (int)$value->total_amount;          
            }

            if($total_amount == (int)$total_cotton)
            {
                $total_village_cost = $total_amount;
            }

        }
       
        return response()->json(array('total_village_cost'=> $total_village_cost,'msg' => $msg), 200);
    }
}
