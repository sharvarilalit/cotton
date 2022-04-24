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
        'name',
        'amount',
        'transaction_number',
        'payment_status',
        'payment_mode',
        'payment_date',
        'transaction_type',
        'pending_amount',
        'farmer_id',
    ];

     public function users()
    {
        return $this->belongsTo(User::class,'uid','id');
    }

}
