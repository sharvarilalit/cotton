<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Truck;
use App\Models\Farmer;
use App\Models\FarmerLog;
use App\Models\FarmerTransactions;
use Illuminate\Support\Facades\DB;

class FarmerPDFController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id = null)
    {
	   	$farmer =  DB::table('farmer');
		$farmer = $farmer->where('id',$id)->get();

		$farmer_product = FarmerTransactions::with('trucks');
		$farmer_product = $farmer_product->where('farmer_id',$id)->get();

		$far_payment =  DB::table('outside_payment');
        $far_payment = $far_payment->where('transaction_type',3);
        $far_payment = $far_payment->where('farmer_id',$id);
        $far_payment =  $far_payment->orderBy('id', 'DESC')->get();
	  

        $farmer_pay_log = FarmerLog::with('users')
                 ->orderBy('transaction_id', 'ASC')
                 ->where('fid',$id)
                 ->get();

       

       $history = view('farmer/farmer-pdf', compact('farmer','farmer_product','far_payment','farmer_pay_log'))->render();

		 // return PDF::loadView('farmer/farmer-pdf', compact('farmer','farmer_product','far_payment','farmer_pay_log'))
		return PDF::loadHTML($history)
		  ->setOptions(['dpi' => 300, 'orientation' => 'landscape'])
		  ->setPaper('a4', 'landscape')
		  ->stream($farmer[0]->name.'-Report-' . date('Y-m-d') . '.pdf');
    }
}