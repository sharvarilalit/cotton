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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

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

            if ($getfarmerbyId && $getfarmerbyId->pending_amount !=0) {
                return view('farmerTransactions.add', compact('getfarmerbyId', 'truck', 'farmer'));
            }
            else{
                return Redirect::to('/farmer-transaction');
            }
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
         
            'date' => Rule::unique('farmer_transactions')->ignore($request->id)->where(function ($query) use ($request) {
                 return $query->where('truck_id', $request->truck_id)->where('farmer_id', $request->farmer_id)->where('date',$request->date);
             }),
        ]);

        $kg_weight = (!empty($request->cotton_weight_kg)) ? $request->cotton_weight_kg : 00;

        $cotton_weight = $request->cotton_weight_qi . "." . $kg_weight;

        $pending_amt = (!empty($request->paid_amount)) ? (int)str_replace(',', '', $request->pending_amount) : (int)str_replace(',', '', $request->total_amount);
        $paid_amt = (!empty($request->paid_amount)) ? $request->paid_amount : 0;


        $input_array = array(
            'date' => $request->date,
            'weight' => $cotton_weight,
            'truck_id' => $request->truck_id,
            'farmer_id' => $request->farmer_id,
            'price' => $request->price,
            'total_amount' => (int)str_replace(',', '', $request->total_amount),
            'paid_amount' => $paid_amt,
            'pending_amount' => $pending_amt,
            'mapadi_name' => $request->mapadi_name,
            'through_person_name' => $request->through_person_name,
        );

       
        if ($request->id == 0) {
            $id = FarmerTransactions::create($input_array)->id;
            $farmer = Farmer::findOrFail($request->farmer_id);
            $ft = FarmerTransactions::findOrFail($id);

            if($ft){
                $data['fid'] = $request->farmer_id;
                $data['transaction_id'] = $id;
                
                $data['uid'] = Auth::user()->id;
                $data['fname'] = $farmer->name;
                $data['transaction_number'] = $ft->transaction_number;
                $data['paid_amount'] = $request->paid_amount;
                
                $data['payment_status'] = "Paid";
                $data['payment_mode'] = $request->payment_mode;
                $data['created_at'] = $request->date;

                if(!empty($request->paid_amount)){
                    log_generate($data);
                }     
            }
          

            return redirect('farmer-transaction/')->with('success', 'Farmer Transaction Details has been created successfully');
        } else {
            $farmer = FarmerTransactions::findOrFail($request->id);
            $paid_status = FarmerLog::where('transaction_id', $request->id)->get();
            $total_amount = 0;
            foreach ($paid_status as $key => $value) {
                $total_amount += $value->paid_amount;
            }
            $total_amount += $request->paid_amount;

            if ($farmer) {
                $farmer->date = $request->date;
               
                $farmer->paid_amount  = $total_amount;
                $farmer->pending_amount  = (int)str_replace(',', '', $request->pending_amount);
<<<<<<< HEAD
                // $farmer->payment_status  = $request->payment_status;
                // $farmer->payment_mode  = $request->payment_mode;
                // $farmer->farmer_id  = $request->farmer_id;
                // $farmer->mapadi_name  = $request->mapadi_name;
                // $farmer->through_person_name  = $request->through_person_name;
=======
               
             
>>>>>>> 4046d18... New extra payment changes
                $result =  $farmer->save();

                $fa = Farmer::findOrFail($request->farmer_id);
                $ft = FarmerTransactions::findOrFail($request->id);

                if($ft){

                  
                    $data['fid'] = $request->farmer_id;
                    $data['transaction_id'] = $request->id;
                    
                    $data['uid'] = Auth::user()->id;
                    $data['fname'] = $fa->name;
                    $data['transaction_number'] = $ft->transaction_number;
                    $data['paid_amount'] = $request->paid_amount;
                    
                    $data['payment_status'] = "Paid";
                    $data['payment_mode'] = $request->payment_mode;
                    $data['created_at'] = $request->trans_date;

                    if(!empty($request->paid_amount)){
                        log_generate($data);
                    }     
                }

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
            
            $data['uid'] = Auth::user()->id;
            $data['fname'] = $fa->name;
            $data['transaction_number'] = $ft->transaction_number;

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
        if ($request->filter_date) {
            $farmer =  $farmer->where('created_at', $request->filter_date);
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
