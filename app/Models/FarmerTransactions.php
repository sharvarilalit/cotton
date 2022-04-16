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
        'weight',
        'price',
        'total_amount',
        'paid_amount',
        'pending_amount',
        'payment_status',
        'payment_mode',
        'mapadi_name',
        'through_person_name',
<<<<<<< HEAD

=======
        'trans_date',
        'product',
        'trip',
>>>>>>> d5dcf15... new changes
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
