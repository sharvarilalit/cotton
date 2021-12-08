<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;

class TruckController extends Controller
{

    public function index()
    {
        $allcolors = Truck::all();
        return view('truck.list', compact('allcolors'));
    }
    public function add($id = null)
    {
        if (is_null($id)) {
            return view('truck.add');
        } else {
            $getTruckbyId = Truck::find($id);
            return view('truck.add', compact('getTruckbyId'));
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
            Truck::create($input_array);
            return redirect('truck/')->with('success', 'Truck Details has been created successfully');
        } else {

            $truck = Truck::findOrFail($request->id);
            if ($truck) {
                $truck->truck_mapadi_name = $request->truck_mapadi_name;
                $truck->truck_person_name =  $request->truck_person_name;
                $truck->truck_no  = $request->truck_no;
                $truck->save();
                return redirect('truck/')->with('success', 'Truck Details has been updated successfully');
            } else {
                return redirect('truck/')->with('error', 'Truck Details Not Found');
            }
        }
    }
    public function delete($id)
    {
        Truck::find($id)->delete();
        return redirect('truck/')->with('success', 'Truck Details has been deleted successfully');
    }
}
