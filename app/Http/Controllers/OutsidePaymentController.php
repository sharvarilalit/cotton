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
use Illuminate\Support\Facades\DB;

class OutsidePaymentController extends Controller
{

    public function index(Request $request)
    {
        // $outside_payment = OutsidePayment::all();

        // if ($request->date) {
        //     $outside_payment =  $outside_payment->where('date', $request->date);
        // }
        
        // $outside_payment =  OutsidePayment::orderBy('id', 'DESC')->get();
       
        $outside_payment =  DB::table('outside_payment');
        if ($request->date) {
            $outside_payment =  $outside_payment->where('payment_date', $request->date);
        }
        $outside_payment = $outside_payment->where('transaction_type',1);
        $outside_payment =  $outside_payment->orderBy('id', 'DESC')->get();
       
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
          
            'amount' => 'required',
            'date' => 'required',
           
        ]);

        $input_array = array(
            'payment_date' => $request->date,        
            'amount' => $request->amount,
            'paid_amount' => 0,
            'pending_amount' => $request->amount,
            'name' => $request->agent_name,
            'transaction_type' => 1,
        );

        if ($request->id == 0) {
            $id = OutsidePayment::create($input_array)->id;
          
            return redirect('outside-payment/')->with('success', 'Outside Transaction Details has been created successfully');
        } else {
            $out_payment = OutsidePayment::findOrFail($request->id);
       
            if ($out_payment) {
            
                $out_payment->paid_amount  = $request->paid_amount;
                $out_payment->pending_amount  = (int)str_replace(',', '', $request->pending_amount);
              
                $result =  $out_payment->save();

               
                $ft = OutsidePayment::findOrFail($request->id);

                if($ft){
                  
                    $data['opid'] = $ft->id;
                
                    $data['uid'] = Auth::user()->id;
                    $data['name'] = $ft->name;
                   
                    $data['paid_amount'] = $request->paid_amount;
                    $data['payment_status'] = 'Paid';
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
