<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OutsidePayment;
use App\Models\User;

class OutsideLog extends Model
{
    use HasFactory;
    protected $table ='outside_log';

    protected $fillable = [
        'opid', 
        'name',
        'uid',
        'paid_amount',
        'payment_status',
        'payment_mode',
        'created_at',
    ];


    public function outsideP()
    {
        return $this->belongsTo(OutsidePayment::class,'opid','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'uid','id');
    }

}
