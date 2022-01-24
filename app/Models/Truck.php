<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TruckCharges;
use App\Models\Market;


class Truck extends Model
{
    use HasFactory;
    protected $table ='truck';

    protected $fillable = [
        'truck_no',
        'additional_details', 
    ];

    public function truck_charges(){
        return $this->hasMany(TruckCharges::class, 'truck_id');
    }

    public function markets(){
        return $this->hasMany(Market::class, 'truck_id');
    }

}
