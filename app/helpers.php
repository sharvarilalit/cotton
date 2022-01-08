<?php

use Illuminate\Support\Facades\Auth;
use App\Models\FarmerLog;


    function log_generate($data){
        FarmerLog::create($data);
    }


?>