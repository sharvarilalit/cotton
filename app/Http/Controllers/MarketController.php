<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Market;

class MarketController extends Controller
{

    public function index()
    {
        $allcolors = Market::with('trucks')->orderBy('id', 'DESC')->get();
        return view('market.list', compact('allcolors'));
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
            'date' => 'required',
        ]);
        $input_array = array(
            'date' => $request->date,
            'market_location' => $request->market_location,
            'market_name' => $request->market_name,
            'truck_weight_qi' => $request->truck_weight_qi,
            'truck_weight_kg' => $request->truck_weight_kg,
            'truck_id' => $request->truck_id,
            'market_price' => $request->market_price,
            'total_amount' => $request->total_amount,
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
                $farmer->truck_weight_qi  = $request->truck_weight_qi;
                $farmer->truck_weight_kg  = $request->truck_weight_kg/10;
                $farmer->truck_id  = $request->truck_id;
                $farmer->market_price  = $request->market_price;
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
}
