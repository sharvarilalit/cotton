<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Farmer;
use App\Models\FarmerLog;
use App\Models\OutsidePayment;
use App\Models\OutsideLog;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FarmerTransactionExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class OutsidePaymentController extends Controller
{

    public function index(Request $request)
    {
        $outside_payment = OutsidePayment::all();
        // $farmer = Farmer::all();

        // $allcolors = FarmerTransactions::with('trucks', 'farmers');

        // if ($request->farmer_id) {
        //     $allcolors =  $allcolors->where('farmer_id', $request->farmer_id);
        // }
        // if ($request->truck_id) {
        //     $allcolors =  $allcolors->where('truck_id', $request->truck_id);
        // }
        // if ($request->date) {
        //     $allcolors =  $allcolors->where('date', $request->date);
        // }

        // $allcolors =  $allcolors->orderBy('id', 'DESC')->get();
        return view('OutsidePayment.list', compact('outside_payment'));
    }
    public function add($id = null)
    {

        $outside_payment = OutsidePayment::all();

        if (is_null($id)) {
            return view('OutsidePayment.add', compact('outside_payment'));
        } else {
            $getOutbyId = OutsidePayment::find($id);

            if ($getOutbyId && $getOutbyId->pending_amount !=0) {
                return view('OutsidePayment.add', compact('getOutbyId', 'outside_payment'));
            }
            else{
                return Redirect::to('/outside-payment');
            }
        }
    }
    public function save(Request $request)
    {

        
        $request->validate([
            'agent_name' => 'required',
            // 'truck_id' => 'required',
            // 'mapadi_name' => 'required',
            // 'through_person_name' => 'required',
            // 'farmer_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            // 'total_amount' => 'required',
            // 'payment_status' => 'required',
            // 'payment_mode' => 'required',
            // 'date' => 'required|unique:farmer_transactions,date,' . $request->id . '|unique:farmer_transactions,truck_id,' . $request->id . '|unique:farmer_transactions,farmer_id,' . $request->id
             // 'date' =>'required|unique:farmer_transactions,date|unique:farmer_transactions,truck_id|unique:farmer_transactions,farmer_id,' . $request->id
            // 'date' => Rule::unique('farmer_transactions')->ignore($request->id)->where(function ($query) use ($request) {
            //      return $query->where('truck_id', $request->truck_id)->where('farmer_id', $request->farmer_id)->where('date',$request->date);
            //  }),
        ]);

        // $kg_weight = (!empty($request->cotton_weight_kg)) ? $request->cotton_weight_kg : 00;

        // $cotton_weight = $request->cotton_weight_qi . "." . $kg_weight;

        // $pending_amt = (!empty($request->paid_amount)) ? (int)str_replace(',', '', $request->pending_amount) : (int)str_replace(',', '', $request->total_amount);
        // $paid_amt = (!empty($request->paid_amount)) ? $request->paid_amount : 0;


        $input_array = array(
            'date' => $request->date,
            
            'amount' => $request->amount,
            // 'total_amount' => (int)str_replace(',', '', $request->total_amount),
            'paid_amount' => 0,
            'pending_amount' => $request->amount,
            // 'transaction_number' => 'OPT'.rand(),
            'name' => $request->agent_name,
        );

        // var_dump($input_array);die();

       
        if ($request->id == 0) {
            $id = OutsidePayment::create($input_array)->id;
            // $farmer = Farmer::findOrFail($request->farmer_id);
            // $ft = FarmerTransactions::findOrFail($id);

            // if($ft){
            //     $data['fid'] = $request->farmer_id;
            //     $data['transaction_id'] = $id;
            //     $data['operation'] = "Created Entry";
            //     $data['uid'] = Auth::user()->id;
            //     $data['fname'] = $farmer->name;
            //     $data['transaction_number'] = $ft->transaction_number;
            //     $data['paid_amount'] = $request->paid_amount;
            //     $data['payment_status'] = $request->payment_status;
            //     $data['payment_mode'] = $request->payment_mode;
            //     $data['created_at'] = $request->date;

            //     if(!empty($request->paid_amount)){
            //         log_generate($data);
            //     }     
            // }
          

            return redirect('outside-payment/')->with('success', 'Outside Transaction Details has been created successfully');
        } else {
            $out_payment = OutsidePayment::findOrFail($request->id);
            // $paid_status = FarmerLog::where('transaction_id', $request->id)->get();
            // $total_amount = 0;
            // foreach ($paid_status as $key => $value) {
            //     $total_amount += $value->paid_amount;
            // }
            // $total_amount += $request->paid_amount;

            if ($out_payment) {
                // $out_payment->date = $request->date;
                // $out_payment->name  = $request->agent_name;
                // $farmer->cotton_weight_kg  = $request->cotton_weight_kg/10;
                // $farmer->weight = $cotton_weight;
                // $farmer->truck_id  = $request->truck_id;
                // $farmer->price  = $request->price;
                // $farmer->total_amount  = $request->total_amount;
                $out_payment->paid_amount  = $request->paid_amount;
                $out_payment->pending_amount  = (int)str_replace(',', '', $request->pending_amount);
                // $farmer->payment_status  = $request->payment_status;
                // $farmer->payment_mode  = $request->payment_mode;
                // $farmer->farmer_id  = $request->farmer_id;
                // $farmer->mapadi_name  = $request->mapadi_name;
                // $farmer->through_person_name  = $request->through_person_name;
                // if( $request->pending_amount==0){
                //     $out_payment->payment_status  = $request->payment_status;
                // }
                $result =  $out_payment->save();

                // $fa = Farmer::findOrFail($request->farmer_id);
                $ft = OutsidePayment::findOrFail($request->id);

                if($ft){
                  
                    $data['opid'] = $ft->id;
                    // $data['transaction_id'] = $request->id;
                    // $data['operation'] = "Updated Entry";
                    $data['uid'] = Auth::user()->id;
                    $data['name'] = $ft->name;
                    // $data['transaction_number'] = $ft->transaction_number;
                    $data['paid_amount'] = $request->paid_amount;
                    $data['payment_status'] = $request->payment_status;
                    $data['payment_mode'] = $request->payment_mode;
                    $data['created_at'] = $request->trans_date;

                    if(!empty($request->paid_amount)){
                        log_generate_out($data);
                    }     
                }

                return redirect('outside-payment/')->with('success', 'Outside Transaction Details has been updated successfully');
            } else {
                return redirect('outside-payment/')->with('error', 'Farmer Transaction Details Not Found');
            }
        }
    }
    public function delete($id)
    {
        $ft = OutsidePayment::findOrFail($id);
        
        if($ft){
            // $fa = Farmer::findOrFail($ft->farmer_id);
            // $data['fid'] = $ft->farmer_id;
            // $data['transaction_id'] = $ft->id;
            // $data['operation'] = "Deleted Entry";
            // $data['uid'] = Auth::user()->id;
            // $data['fname'] = $fa->name;
            // $data['transaction_number'] = $ft->transaction_number;

            // log_generate_out($data);
            $ft->delete();
    
            return redirect('outside-payment/')->with('success', 'Outside Transaction Details has been deleted successfully');
        }
        else{
            return redirect('outside-payment/')->with('error', 'Data not Found');

        }

       
    }

    public function export(Request $request)
    {
        return Excel::download(new FarmerTransactionExport($request), 'farmers.xlsx');
    }


    //Farmer Log List
    public function flog(Request $request)
    {
        $all_log = OutsideLog::with('users');
        // $flist = Farmer::all();

        // if ($request->farmer_id) {
        //     $farmer =  $farmer->where('fid', $request->farmer_id);
        // }
        if ($request->filter_date) {
            $all_log =  $all_log->where('created_at', $request->filter_date);
        }
        
        $all_log =  $all_log->orderBy('id', 'DESC')->get();


        return view('OutsidePayment.loglist', compact('all_log'));
    }

    //view farmer transaction histroy
    public function viewHistroy(Request $request)
    {
        $outsidelog = OutsideLog::with('users');
        if ($request->id) {
            $outsidelog =  $outsidelog->where('opid', $request->id);
        }
        $outsidelog =  $outsidelog->orderBy('id', 'DESC')->get();
        return view('OutsidePayment.view', compact('outsidelog'));
    }
}
