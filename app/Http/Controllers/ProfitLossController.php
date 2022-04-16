<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\TruckCharges;
use App\Models\Market;
use DB;

class ProfitLossController extends Controller
{
    public function index(Request $request)
    {
        // $truck = Truck::all();

    //     $res = DB::table('products as t1')->
    // select('t2.title')->
    // join('products AS t2', 't2.color_id', '=', 't1.color_id')->
    // where('t1.id', 1)->
    // where('td2.id', '<>', 't1.id')->
    // get();

        $market = DB::table('market')
                    ->join('truck', 'market.truck_id', '=', 'truck.id')
                    // ->join('truck_charges', 'market.truck_id', '=', 'truck_charges.truck_id')
                    // ->where('market.date', '=', 'truck_charges.date')
                    ->select('market.*','truck.truck_no')
                    ->orderBy('id', 'DESC')
                    ->get();

        $profit_data = array();
<<<<<<< HEAD
        foreach ($market as $key => $value) {
            
            $market = DB::table('truck_charges')
                    ->where('truck_charges.date', '=', $value->date)
                    ->where('truck_charges.truck_id', '=', $value->truck_id)
                    ->select('truck_charges.*')
                    ->get();

            $pl_date = ($market[0]->date == $value->date) ? $value->date : '';
=======
        $records = Truck::join('truck_charges', 'truck.id', '=', 'truck_charges.truck_id')
        ->join('market', 'truck.id', '=', 'market.truck_id')
        ->select('truck.*','market.market_price as market_price','market.total_amount as total_amount','market.date as market_date','truck_charges.truck_total_amount as truck_total_amount','truck_charges.date as truck_charges_date','truck_charges.product as truck_charges_product','market.product as market_product','truck_charges.trip as truck_charges_trip','market.trip as market_trip')
        ->orderBy('truck.id', 'DESC')
        ->get();

        if($records && !empty($records)){
            foreach ($records as $key => $value) {
                // $pl_date = ($value->truck_charges_date == $value->market_date) ? $value->market_date : '';

               // $pl_date =   (($value->truck_charges_date == $value->market_date) && ($value->truck_charges_product == $value->market_product) && ($value->truck_charges_trip == $value->market_trip)) ? $value->market_date : '';

               $pl_date = '';
               $pl_product = '';
               $pl_trip = '';

               if(($value->truck_charges_date == $value->market_date) && ($value->truck_charges_product == $value->market_product) && ($value->truck_charges_trip == $value->market_trip)) 
               {
                    $pl_date = $value->market_date;
                    $pl_product = $value->market_product;
                    $pl_trip = $value->market_trip;
               }

    
                $profit_loss = $value->total_amount - $value->truck_total_amount;
    
                $result_pl = ($profit_loss > 0) ? "profit" : "loss" ;
    
                $profit_data[] = [
                    'truck_no' => $value->truck_no,
                    'truck_total_amount' => $value->truck_total_amount,
                    'market_total_amount' => $value->total_amount,
                    // 'market_weight' => $value->quantity,
                    // 'market_rate' => $value->market_price,
                    'date' => $pl_date,
                    'profit_loss' => $profit_loss,
                    'result_pl' => $result_pl,
                    'product' => $pl_product,
                    'trip' => $pl_trip
                ];
            
            }
           
            }
>>>>>>> d5dcf15... new changes


            // $profit_loss = $value->total_amount - $market[0]->truck_total_amount;

            // $result_pl = ($profit_loss > 0) ? "Profit" : "Loss" ;

            // $profit_data[] = [
            //     'truck_no' => $value->truck_no,
            //     'truck_total_amount' => $market[0]->truck_total_amount,
            //     'market_total_amount' => $value->total_amount,
            //     // 'market_weight' => $value->quantity,
            //     // 'market_rate' => $value->market_price,
            //     'date' => $pl_date,
            //     'profit_loss' => $profit_loss,
            //     'result_pl' => $result_pl,
            // ];

            // $profit_data[$value->truck_id]['truck_no'] = $value->truck_no;
            
        }
        // foreach($profit_data as $key=>$item) {
        //     var_dump($item['truck_no']);
        // }
        // // echo "<pre/>";
        // // var_dump($profit_data);
        // exit;
                    // var_dump($records);

    // return view('monthlyReport')
    //        ->with(['records' => $records , 'site_name' => $site_name ]);
        // $allcolors = Market::with('trucks','truck_charges');
        //  $allcolors =  $allcolors->orderBy('id', 'DESC')->get();

        // var_dump($allcolors);
       
        // if ($request->truck_id) {
        //     $allcolors =  $allcolors->where('truck_id', $request->truck_id);
        // }

        // if ($request->to_date) {
        //     $allcolors =  $allcolors->where('date','<=', $request->to_date);
        // }

        // if ($request->from_date) {
        //     $allcolors =  $allcolors->where('date','>=', $request->from_date);
        // }
       
        // $allcolors =  $allcolors->orderBy('id', 'DESC')->get();

        return view('profitLoss.list', compact('profit_data'));
        // return view('profitLoss.list', compact('truck'));
    }
}
