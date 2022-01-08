<?php

use Illuminate\Support\Facades\Auth;
use App\Models\FarmerLog;

if(!function_exists('log_generate')){

    function log_generate($data){
        FarmerLog::create($data);
    }

}



?>