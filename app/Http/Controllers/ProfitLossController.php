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
    public function index(Request $request){
        $profit_data = array();
        $records = Truck::join('truck_charges', 'truck.id', '=', 'truck_charges.truck_id')
        ->join('market', 'truck.id', '=', 'market.truck_id')
        ->select('truck.*','market.market_price as market_price','market.total_amount as total_amount','market.date as market_date','truck_charges.truck_total_amount as truck_total_amount','truck_charges.date as truck_charges_date')
        ->orderBy('truck.id', 'DESC')
        ->get();

        if($records && !empty($records)){
            foreach ($records as $key => $value) {
                $pl_date = ($value->truck_charges_date == $value->market_date) ? $value->market_date : '';
    
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
                ];
            }
           
            }

        return view('profitLoss.list', compact('profit_data'));

            $profit_loss = $value->total_amount - $market[0]->truck_total_amount;

            $result_pl = ($profit_loss > 0) ? "Profit" : "Loss" ;

            $profit_data[] = [
                'truck_no' => $value->truck_no,
                'truck_total_amount' => $market[0]->truck_total_amount,
                'market_total_amount' => $value->total_amount,
                // 'market_weight' => $value->quantity,
                // 'market_rate' => $value->market_price,
                'date' => $pl_date,
                'profit_loss' => $profit_loss,
                'result_pl' => $result_pl,
            ];

            // $profit_data[$value->truck_id]['truck_no'] = $value->truck_no;
            
        }
       
}
