<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truck;

class Market extends Model
{
    use HasFactory;
    protected $table ='market';

    protected $fillable = [
        'market_name',
        'market_location', 
        'date',
        'truck_weight_qi',
        'truck_weight_kg',
        'truck_id',
        'market_price',
        'total_amount',
        'quantity',
        'trip',
        'product',
        'truck_code'
    ];

    public function trucks()
    {
        return $this->belongsTo(Truck::class,'truck_id','id');
    }

    // public function truck_charges()
    // {
    //     return $this->belongsTo(TruckCharges::class,'truck_id','id');
    // }

}
