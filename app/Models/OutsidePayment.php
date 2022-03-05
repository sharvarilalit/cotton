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
        'payment_status',
        'payment_mode',
        'payment_date',
        'transaction_type',
        'tansaction_number'
    ];

     public function users()
    {
        return $this->belongsTo(User::class,'uid','id');
    }

}
