<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
use App\Models\Market;
use App\Models\Truck;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $farmer =   Farmer::count();    
        $market =   Market::count();    
        $truck =   Truck::count();    


        return view('home',compact('farmer','market','truck'));
    }

    public function profile(){
        return view('auth.edit');
    }

    public function update(Request $request)
    { 

        
       
        $request->validate([
            'name' => 'required|unique:users,name,' . auth()->user()->id,
            'email' => 'required|email|unique:users,email,'. auth()->user()->id,
            'phone' => 'required'
        ]);
        $user = User::find(auth()->user()->id);
     
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = auth()->user()->password;
        $user->save();

        return redirect('profile')->with('success', 'Profile Updated successfully');
    } 
}
