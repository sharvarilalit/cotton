<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\TruckCharges;

class TruckChargesController extends Controller
{

    public function index()
    {
        $allcolors = TruckCharges::all();
        return view('truckCharges.list', compact('allcolors'));
    }
    public function add($id = null)
    {
        if (is_null($id)) {
            return view('truckCharges.add');
        } else {
            $getTruckbyId = TruckCharges::find($id);
            return view('truckCharges.add', compact('getTruckbyId'));
        }
    }
    public function save(Request $request)
    {

        $request->validate([
            'truck_mapadi_name' => 'required',
            'truck_person_name' => 'required',
            'truck_no' => 'required', 'required|unique:truck,truck_no,' . $request->truck_no
        ]);
        $input_array = array(
            'truck_no' => $request->truck_no,
            'truck_mapadi_name' => $request->truck_mapadi_name,
            'truck_person_name' => $request->truck_person_name
        );

        if ($request->id == 0) {
            TruckCharges::create($input_array);
            return redirect('truck/')->with('success', 'Truck Charges has been created successfully');
        } else {

            $truck = Truck::findOrFail($request->id);
            if ($truck) {
                $truck->truck_mapadi_name = $request->truck_mapadi_name;
                $truck->truck_person_name =  $request->truck_person_name;
                $truck->truck_no  = $request->truck_no;
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
