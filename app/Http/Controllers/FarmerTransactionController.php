<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Farmer;
use App\Models\FarmerLog;
use App\Models\FarmerTransactions;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FarmerTransactionExport;
use Illuminate\Support\Facades\Auth;

class FarmerTransactionController extends Controller
{

    public function index(Request $request)
    {
        $truck = Truck::all();
        $farmer = Farmer::all();

        $allcolors = FarmerTransactions::with('trucks', 'farmers');

        if ($request->farmer_id) {
            $allcolors =  $allcolors->where('farmer_id', $request->farmer_id);
        }
        if ($request->truck_id) {
            $allcolors =  $allcolors->where('truck_id', $request->truck_id);
        }
        if ($request->date) {
            $allcolors =  $allcolors->where('date', $request->date);
        }

        $allcolors =  $allcolors->orderBy('id', 'DESC')->get();
        return view('farmerTransactions.list', compact('allcolors', 'truck', 'farmer'));
    }
    public function add($id = null)
    {

        $truck = Truck::all();
        $farmer = Farmer::all();

        if (is_null($id)) {
            return view('farmerTransactions.add', compact('truck', 'farmer'));
        } else {
            $getfarmerbyId = FarmerTransactions::find($id);
            return view('farmerTransactions.add', compact('getfarmerbyId', 'truck', 'farmer'));
        }
    }
    public function save(Request $request)
    {
        $request->validate([
            'cotton_weight_qi' => 'required',
            'truck_id' => 'required',
            'mapadi_name' => 'required',
            'through_person_name' => 'required',
            'farmer_id' => 'required',
            'price' => 'required',
            'total_amount' => 'required',
            'payment_status' => 'required',
            'payment_mode' => 'required',
            'date' => 'required|unique:farmer_transactions,date,' . $request->id . '|unique:farmer_transactions,truck_id,' . $request->id . '|unique:farmer_transactions,farmer_id,' . $request->id
        ]);

        $kg_weight = (!empty($request->cotton_weight_kg)) ? $request->cotton_weight_kg : 00;

        $cotton_weight = $request->cotton_weight_qi . "." . $kg_weight;


        // var_dump($request->cotton_weight_kg);
        // exit();

        $input_array = array(
            'date' => $request->date,
            // 'cotton_weight_qi' => $request->cotton_weight_qi,
            // 'cotton_weight_kg' => $request->kg,
            'weight' => $cotton_weight,
            'truck_id' => $request->truck_id,
            'farmer_id' => $request->farmer_id,
            'price' => $request->price,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'pending_amount' => $request->pending_amount,
            'payment_status' => $request->payment_status,
            'payment_mode' => $request->payment_mode,
            'mapadi_name' => $request->mapadi_name,
            'through_person_name' => $request->through_person_name,
        );

        // var_dump($input_array);exit();

        if ($request->id == 0) {
            $id = FarmerTransactions::create($input_array)->id;
            $farmer = Farmer::findOrFail($request->farmer_id);

            $data['fid'] = $request->farmer_id;
            $data['transaction_id'] = $id;
            $data['operation'] = "Created Entry";
            $data['uid'] = Auth::user()->id;
            $data['fname'] = $farmer->name;

            log_generate($data);

            return redirect('farmer-transaction/')->with('success', 'Farmer Transaction Details has been created successfully');
        } else {
            $farmer = FarmerTransactions::findOrFail($request->id);
            if ($farmer) {
                $farmer->date = $request->date;
                // $farmer->cotton_weight_qi  = $request->cotton_weight_qi;
                // $farmer->cotton_weight_kg  = $request->cotton_weight_kg/10;
                $farmer->weight = $cotton_weight;
                $farmer->truck_id  = $request->truck_id;
                $farmer->price  = $request->price;
                $farmer->total_amount  = $request->total_amount;
                $farmer->paid_amount  = $request->paid_amount;
                $farmer->pending_amount  = $request->pending_amount;
                $farmer->payment_status  = $request->payment_status;
                $farmer->payment_mode  = $request->payment_mode;
                $farmer->farmer_id  = $request->farmer_id;
                $farmer->mapadi_name  = $request->mapadi_name;
                $farmer->through_person_name  = $request->through_person_name;
                $farmer->save();

                $fa = Farmer::findOrFail($request->farmer_id);
                $data['fid'] = $request->farmer_id;
                $data['transaction_id'] = $request->id;
                $data['operation'] = "Updated Entry";
                $data['uid'] = Auth::user()->id;
                $data['fname'] = $fa->name;

                log_generate($data);

                return redirect('farmer-transaction/')->with('success', 'Farmer Transaction Details has been updated successfully');
            } else {
                return redirect('farmer-transaction/')->with('error', 'Farmer Transaction Details Not Found');
            }
        }
    }
    public function delete($id)
    {
        $ft = FarmerTransactions::findOrFail($id);
        
        if($ft){
            $fa = Farmer::findOrFail($ft->farmer_id);
            $data['fid'] = $ft->farmer_id;
            $data['transaction_id'] = $ft->id;
            $data['operation'] = "Deleted Entry";
            $data['uid'] = Auth::user()->id;
            $data['fname'] = $fa->name;
    
            log_generate($data);
            $ft->delete();
    
            return redirect('farmer-transaction/')->with('success', 'Farmer Transaction Details has been deleted successfully');
        }
        else{
            return redirect('farmer-transaction/')->with('error', 'Data not Found');

        }

       
    }

    public function export(Request $request)
    {
        return Excel::download(new FarmerTransactionExport($request), 'farmers.xlsx');
    }


    //Farmer Log List
    public function flog(Request $request)
    {
        $farmer = FarmerLog::with('farmers', 'users');
        $flist = Farmer::all();

        if ($request->farmer_id) {
            $farmer =  $farmer->where('fid', $request->farmer_id);
        }
        $farmer =  $farmer->orderBy('id', 'DESC')->get();


        return view('farmerTransactions.loglist', compact('farmer', 'flist'));
    }

    //view farmer transaction histroy
    public function viewHistroy(Request $request)
    {
        $farmer = FarmerLog::with('farmers', 'users');
        if ($request->id) {
            $farmer =  $farmer->where('transaction_id', $request->id);
        }
        $farmer =  $farmer->orderBy('id', 'DESC')->get();
        return view('farmerTransactions.view', compact('farmer'));
    }
}
