<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truck;

class Farmer extends Model
{
    use HasFactory;
    protected $table ='farmer';

    protected $fillable = [
        'name',
        'location', 
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

}
