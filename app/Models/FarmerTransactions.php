<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truck;
use App\Models\Farmer;

class FarmerTransactions extends Model
{
    use HasFactory;
    protected $table ='farmer_transactions';

    protected $fillable = [
        'farmer_id',
        'truck_id',
        'date',
        'cotton_weight_qi',
        'cotton_weight_kg',
        'price',
        'total_amount',
        'paid_amount',
        'pending_amount',
        'payment_status',
        'payment_mode'
    ];

    public function trucks()
    {
        return $this->belongsTo(Truck::class,'truck_id','id');
    }

    public function farmers()
    {
        return $this->belongsTo(Farmer::class,'farmer_id','id');
    }


}
