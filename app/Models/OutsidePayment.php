<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Truck;
use App\Models\User;
class OutsidePayment extends Model
{
    use HasFactory;
    protected $table ='outside_payment';

    protected $fillable = [
<<<<<<< HEAD
        'opid',
=======

>>>>>>> 4046d18... New extra payment changes
        'name',
        'amount',
        'transaction_number',
        'payment_status',
        'payment_mode',
        'payment_date',
<<<<<<< HEAD
=======
        'transaction_type',
        'pending_amount',
        'farmer_id',
>>>>>>> 4046d18... New extra payment changes
    ];

     public function users()
    {
        return $this->belongsTo(User::class,'uid','id');
    }
<<<<<<< HEAD
=======

>>>>>>> 4046d18... New extra payment changes
    // public function farmers()
    // {
    //     return $this->belongsTo(Farmer::class,'farmer_id','id');
    // }


}
