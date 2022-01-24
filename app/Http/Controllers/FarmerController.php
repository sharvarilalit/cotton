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
        $allcolors = Farmer::orderBy('id', 'DESC')->get();
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

        $farmer = Truck::findOrFail($id);

        if ($farmer->ftransactions()->exists())
        {
            return redirect('farmer/')->with('error', 'Farmer cannot be deleted due to existence of related resources.');
        }

        Farmer::find($id)->delete();
        return redirect('farmer/')->with('success', 'Farmer Details has been deleted successfully');
    }
}
