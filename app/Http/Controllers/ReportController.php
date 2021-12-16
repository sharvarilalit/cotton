<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Market;
use App\Models\TruckCharges;

class ReportController extends Controller
{

    public function index()
    {
        $allcolors = Truck::all();
        return view('truck.list', compact('allcolors'));
    }
   
}
