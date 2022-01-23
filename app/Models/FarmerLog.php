<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Farmer;
use App\Models\User;

class FarmerLog extends Model
{
    use HasFactory;
    protected $table ='farmer_log';

    protected $fillable = [
        'fid', 
        'operation',
        'fname',
        'uid',
        'transaction_id',
        'transaction_number',
        'paid_amount',
        'payment_status',
        'payment_mode',
        'created_at'
    ];


    public function farmers()
    {
        return $this->belongsTo(Farmer::class,'fid','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'uid','id');
    }

}
