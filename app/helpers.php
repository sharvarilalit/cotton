<?php

use Illuminate\Support\Facades\Auth;
use App\Models\FarmerLog;
use App\Models\OutsideLog;


    function log_generate($data){
        FarmerLog::create($data);
    }

    function log_generate_out($data){
        OutsideLog::create($data);
    }

    


?>