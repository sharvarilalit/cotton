<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FarmerTransactions;

class Farmer extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $table ='farmer';

    protected $fillable = [
        'name', 
        'location',
        'contact',
        'alternate_contact'
    ];

    public function ftransactions(){
        return $this->hasMany(FarmerTransactions::class, 'farmer_id');
    }

}
