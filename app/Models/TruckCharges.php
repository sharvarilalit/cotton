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
        'driver_name',
        'truck_filler_name',
        'location_from_to',
        'vehicile_charges',
        'labour_charges',
        'village_commisions',
        'route_charges',
        'total_charges',
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
