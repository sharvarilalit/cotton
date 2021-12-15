<?php

namespace App\Exports;

use App\Models\FarmerTransactions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class FarmerTransactionExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct($data)
    {
       $this->data = $data;
    }

    public function headings():array{
        return[
            'Name',
            'Location',
            'Truck Number',
            'Date',
            'Cotton Weight',
            'Cotton Quantity' ,
            'Cotton Price' ,
            'Total Amount' ,
            'Paid Amount' ,
            'Pending Amount',
            'Payment Status' ,
            'Payment Mode' 
        ];
    } 

    public function collection()
    {

       // $allcolors = FarmerTransactions::select('*')->with('trucks', 'farmers');

        $allcolors = DB::table('farmer_transactions')
            ->join('farmer', 'farmer_transactions.farmer_id', '=', 'farmer.id')
            ->join('truck', 'farmer_transactions.truck_id', '=', 'truck.id')
            ->select('farmer.name', 'farmer.location', 'truck.truck_no','farmer_transactions.date','farmer_transactions.cotton_weight','farmer_transactions.quantity','farmer_transactions.price','farmer_transactions.total_amount','farmer_transactions.paid_amount','farmer_transactions.paid_amount','farmer_transactions.pending_amount','farmer_transactions.payment_status','farmer_transactions.payment_mode');
           

        if ($this->data->farmer_id) {
            $allcolors =  $allcolors->where('farmer_transactions.farmer_id', $this->data->farmer_id);
        }
        if ($this->data->truck_id) {
            $allcolors =  $allcolors->where('farmer_transactions.truck_id', $this->data->truck_id);
        }

        $allcolors =  $allcolors->orderBy('farmer_transactions.id', 'DESC')->get();

        return $allcolors;
    }
}