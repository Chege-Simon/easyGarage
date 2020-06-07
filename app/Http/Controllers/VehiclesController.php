<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect;
use App\Vehicle;

class VehiclesController extends Controller
{

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
        $user = Auth::user();
        return view('myVehicles', compact('user'));
    }
    public function add()
    {
        return view('addVehicle');
    }
    public function register(Request $request)
    {
        if(Vehicle::where('number_plate', $request->number_plate)->first()){          
            return Redirect::to('vehicle')->with('warning','Duplicate vehicle details!');
        }else{            
            $id = Auth::user()->id;
            $request->validate([
                'number_plate' => ['required', 'string', 'max:255'],
                'brand' => ['required', 'string', 'max:255'],
                'model' => ['required', 'string','max:255'],
                'color' => ['required']
            ]);
            $plate = strtolower(str_replace(' ','',$request->number_plate));
            $vehicle = new Vehicle();
            $vehicle->number_plate = $plate;
            $vehicle->brand = $request->brand;
            $vehicle->model = $request->model;
            $vehicle->color = $request->color;
            $vehicle->user_id = $id;
            $vehicle->save();
            return Redirect::to('vehicle')->with('success','Great! Vehicle Registered successfully');
        }
    }
    public function edit(Vehicle $vehicle)
    {

    	if (Auth::check() && Auth::user()->id == $vehicle->user_id)
        {        
            $user = Auth::user();    
            return view('editVehicle', compact('vehicle'));
        }           
        else {
             return redirect('/');
         }
    }
    public function update(Request $request, Vehicle $vehicle)
    {
    	if(isset($_POST['delete'])) {
    		$vehicle->delete();
            return Redirect::to('vehicle')->with('warning','The Vehicle has been deleted succesfully');
    	}
    	else
    	{   		
            $vehicle->number_plate = $request->number_plate;
            $vehicle->brand = $request->brand;
            $vehicle->model = $request->model;
            $vehicle->color = $request->color;
            $vehicle->save();
            return Redirect::to('vehicle')->with('success','Great! Vehicle Details changed successfully');
    	}    	
    }
}
