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
        'date',
        'cotton_weight',
        'truck_id',
        'price',
        'total_amount',
        'paid_amount',
        'pending_amount',
        'payment_status',
        'payment_mode',
        'quantity'
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
