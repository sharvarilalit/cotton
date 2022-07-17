<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truck;
use App\Models\Farmer;

class TruckCharges extends Model
{
    use HasFactory;
    protected $table ='truck_charges';

    protected $fillable = [
        'truck_id',
        'date',
        'village_charges',
        'vehicle_charges',
        'labor_charges',
        'village_commision',
        'route_charges', 
        'vehicle_filling_out_charges',
        'angadi_return_person_charges',
        'total_charges_amount',
        'jingping_amount',
        'truck_total_amount',
        'product',
        'trip',
        'truck_unique_code',
        'total_quantity'
    ];

    public function trucks()
    {
        return $this->belongsTo(Truck::class,'truck_id','id');
    }

    // public function farmers()
    // {
    //     return $this->belongsTo(Farmer::class,'farmer_id','id');
    // }


}
