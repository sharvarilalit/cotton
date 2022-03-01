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
        'opid',
        'name',
        'date',
        'amount',
        'date',
        'transaction_number',
        'payment_status',
        'payment_mode',
        'payment_date',
    ];

     public function users()
    {
        return $this->belongsTo(User::class,'uid','id');
    }
    // public function farmers()
    // {
    //     return $this->belongsTo(Farmer::class,'farmer_id','id');
    // }


}
