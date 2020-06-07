<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect;
use App\Vehicle;

class ServicesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function numOfServices()
    {            
    foreach($vehicles as $vehicle){
        if(count($vehicle->services)>0){
            return $num+=1; 
        }
    }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $vehicles = Auth::user()->vehicles;
        return view('services', compact('vehicles','user'));
    }
    public function add()
    {
        return view('addService');
    }
}

