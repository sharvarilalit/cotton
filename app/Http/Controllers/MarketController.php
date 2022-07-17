<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Market;
use App\Models\TruckCharges;

use Illuminate\Validation\Rule;

class MarketController extends Controller
{

    public function index(Request $request)
    {
        $truck = Truck::all();
        $allcolors = Market::with('trucks');

       
        if ($request->truck_id) {
            $allcolors =  $allcolors->where('truck_id', $request->truck_id);
        }

        if ($request->to_date) {
            $allcolors =  $allcolors->where('date','<=', $request->to_date);
        }

        if ($request->from_date) {
            $allcolors =  $allcolors->where('date','>=', $request->from_date);
        }
       
        $allcolors =  $allcolors->orderBy('id', 'DESC')->get();

        return view('market.list', compact('allcolors','truck'));
    }
    public function add($id = null)
    {

        $truck = Truck::all();

        if (is_null($id)) {
            return view('market.add',compact('truck'));
        } else {
            $getmarketbyId = Market::find($id);
            return view('market.add', compact('getmarketbyId','truck'));
        }
    }
    public function save(Request $request)
    {
        $request->validate([
            'market_name' => 'required|unique:farmer,name,' . $request->id,
            'market_location' => 'required',
            'truck_weight_qi' => 'required',
            'truck_id' =>'required',
            'market_price' => 'required',
            'total_amount' => 'required',
            // 'date' => 'required',
            'date' => Rule::unique('market')->ignore($request->id)->where(function ($query) use ($request) {
                return $query->where('truck_id', $request->truck_id)->where('date',$request->date);
            }),
            'truck_code'=>'required'
        ]);

        $kg_weight = (!empty($request->truck_weight_kg)) ? $request->truck_weight_kg : 00;
        $cotton_weight = $request->truck_weight_qi . "." . $kg_weight;

        $input_array = array(
            'date' => $request->date,
            'market_location' => $request->market_location,
            'market_name' => $request->market_name,
            // 'truck_weight_qi' => $request->truck_weight_qi,
            // 'truck_weight_kg' => $request->truck_weight_kg,
            'quantity' => $cotton_weight,
            'truck_id' => $request->truck_id,
            'market_price' => $request->market_price,
            'total_amount' => (int)str_replace(',', '', $request->total_amount),
            'trip' => $request->trip,
            'product' => $request->product_type,
            'truck_code' => $request->truck_code
        );

        if ($request->id == 0) {
            Market::create($input_array);
            return redirect('market/')->with('success', 'Market Details has been created successfully');
        } else {
            $farmer = Market::findOrFail($request->id);
            if ($farmer) {


                $farmer->date = $request->date;
                $farmer->market_location =  $request->market_location;
                $farmer->market_name  = $request->market_name;
                // $farmer->truck_weight_qi  = $request->truck_weight_qi;
                // $farmer->truck_weight_kg  = $request->truck_weight_kg/10;
                $farmer->truck_id  = $request->truck_id;
                $farmer->market_price  = $request->market_price;
                $farmer->trip  = $request->trip;
                $farmer->product  = $request->product_type;
                $farmer->total_amount  = (int)str_replace(',', '', $request->total_amount);
                $farmer->save();
                return redirect('market/')->with('success', 'Market Details has been updated successfully');
            } else {
                return redirect('market/')->with('error', 'Market Details Not Found');
            }
        }
    }
    public function delete($id)
    {
        Market::find($id)->delete();
        return redirect('market/')->with('success', 'Market Details has been deleted successfully');
    }

    public function getTruckCode(Request $request)
    {
        $truckCode = TruckCharges::where('truck_id',$request->truck_no)->get()->toArray();
        $data=[];
        if(count($truckCode) == 0) {
            $data=[];
        }
        else{
            $data = $truckCode;

        }
       
        return response()->json(array('data'=> $data), 200);
    }

    public function gettruckChargesdetails(Request $request)
    {
        $details = TruckCharges::where('truck_unique_code',$request->truck_charges_id)->get();
        return response()->json(array('data'=> $details), 200);
    }
}
