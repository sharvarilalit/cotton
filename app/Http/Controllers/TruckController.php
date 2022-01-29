<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use DB;

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
            'truck_no' => 'required|unique:truck,truck_no,' . $request->id
        ]);
        $input_array = array(
            'truck_no' => $request->truck_no,
            'additional_details' => $request->additional_details,
        );

        if ($request->id == 0) {
            Truck::create($input_array);
            return redirect('truck/')->with('success', 'Truck Details has been created successfully');
        } else {

            $truck = Truck::findOrFail($request->id);
            if ($truck) {
                $truck->additional_details = $request->additional_details;
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
        // DB::table('truck')->where('id', $id)->delete();
         // DB::table('truck')
         //        ->where('id', $id)
         //        ->update(['truck_status' => 0]);
        return redirect('truck/')->with('success', 'Truck Details has been deleted successfully');
    }
}
