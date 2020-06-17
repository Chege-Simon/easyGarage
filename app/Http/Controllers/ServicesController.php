<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect, Response;
use App\Vehicle;
use App\Employee;
use App\Service;
use DateTime;


class ServicesController extends Controller
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
        date_default_timezone_set('Africa/Nairobi');
        $now = date("H:i:s");
        $today = date("Y-m-d");
        $user = Auth::user();
        $vehicles = Auth::user()->vehicles;
        foreach ($vehicles as $vehicle) {
            foreach ($vehicle->services as $service) {
                if ($service->time_start < $now && $service->time_end > $now && $service->date_set == $today) {
                    $service->is_in_progress = true;
                    $service->save();
                }else if($service->time_end < $now && $service->date_set == $today || $service->date_set < $today){
                    $service->is_cleared = true;
                    $service->save();
                }
            }
        }
        return view('services', compact('vehicles','user'));
    }
    public function add()
    {
        $vehicles = Auth::user()->vehicles;
        $employees = Employee::orderBy('rating', 'asc')->paginate(3);
        return view('addService',compact('employees', 'vehicles'));
    }
    public function request(Request $request)
    {   
        
        if(!$request->employee_id){
            return Redirect::to('service')->with('error','Please choose a mechanic !');
        }
        date_default_timezone_set('Africa/Nairobi');         
        $id = Auth::user()->id;
        // dd($request->time_start);
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'service_area' => ['required', 'string', 'max:255'],
            'date_set' => 'date_format:Y-m-d|after_or_equal:today',
            'time_start' => 'date_format:H:i',
            'employee_id' => ['required','integer'],
            'vehicle_id' => ['required','integer']
        ]);
        switch ($request->type) {
            case 'repair':
                $timestamp = strtotime($request->time_start)+ 60*60;
                $time_end = date('H:i', $timestamp);
                break;
            case 'paint-work':
                $timestamp = strtotime($request->time_start)+ 60*60 + 60*60 + 60*60;
                $time_end = date('H:i', $timestamp);
                break;
            case 'normal-maintainace':
                $timestamp = strtotime($request->time_start)+ 60*60;
                $time_end = date('H:i', $timestamp);
                break;
            default:
                $timestamp = strtotime($request->time_start) + 60*60;
                $time_end = date('H:i', $timestamp);
                break;
        }
        // dd($request->time_start, $time_end);
        if($service->date_set > $today){
            $service = new Service();
            $service->type = $request->type;
            $service->description = $request->description;
            $service->service_area = $request->service_area;
            $service->date_set = $request->date_set;
            $service->time_start = $request->time_start;
            $service->time_end = $time_end;
            $service->employee_id = $request->employee_id;
            $service->vehicle_id = $request->vehicle_id;
            $service->is_in_progress = false;
            $service->is_cleared = false;
            $service->is_paid = false;
            $service->save();
            return Redirect::to('service')->with('success','Great! service Registered successfully');
        }
        else if($service->date_set == $today && $service->time_start > $now){
            $service = new Service();
            $service->type = $request->type;
            $service->description = $request->description;
            $service->service_area = $request->service_area;
            $service->date_set = $request->date_set;
            $service->time_start = $request->time_start;
            $service->time_end = $time_end;
            $service->employee_id = $request->employee_id;
            $service->vehicle_id = $request->vehicle_id;
            $service->is_in_progress = false;
            $service->is_cleared = false;
            $service->is_paid = false;
            $service->save();
            return Redirect::to('service')->with('success','Great! service Registered successfully');
        }else if($service->date_set == $today && $service->time_start <= $now){
            return Redirect::to('service/add')->with('warning','Check you date and time. Can\'t set time of the past!');
        }
    }
    public function edit(Vehicle $vehicle, Request $request, $service)
    {
    	if (Auth::check())
        {   
            $service = Service::find($service);   
            $vehicles = Auth::user()->vehicles;
            $vehicle =Vehicle::find($service->vehicle_id); 
            $employees = Employee::orderBy('rating', 'asc')->paginate(3);
            // dd($vehicle->id);
            return view('editService', compact('service', 'vehicle', 'vehicles', 'employees'));
        }           
        else {
             return redirect('/');
         }
    }
    public function update(Request $request, Service $service)
    {
        
        date_default_timezone_set('Africa/Nairobi');
    	if(isset($_POST['delete'])) {
    		$service->delete();
            return Redirect::to('service')->with('warning','The Service has been deleted succesfully');
    	}
    	else
    	{   
        switch ($request->type) {
            case 'repair':
                $timestamp = strtotime($request->time_start)+ 60*60;
                $time_end = date('H:i', $timestamp);
                break;
            case 'paint-work':
                $timestamp = strtotime($request->time_start)+ 60*60 + 60*60 + 60*60;
                $time_end = date('H:i', $timestamp);
                break;
            case 'normal-maintainace':
                $timestamp = strtotime($request->time_start)+ 60*60;
                $time_end = date('H:i', $timestamp);
                break;
            default:
                $timestamp = strtotime($request->time_start) + 60*60;
                $time_end = date('H:i', $timestamp);
                break;
        }	$request->validate([
            'type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'service_area' => ['required', 'string', 'max:255'],
            'date_set' => 'date_format:Y-m-d',
            'time_start' => 'required',
            'employee_id' => ['required','integer'],
            'vehicle_id' => ['required','integer']
        ]);	
        if($service->date_set > $today){
            $service = new Service();
            $service->type = $request->type;
            $service->description = $request->description;
            $service->service_area = $request->service_area;
            $service->date_set = $request->date_set;
            $service->time_start = $request->time_start;
            $service->time_end = $time_end;
            $service->employee_id = $request->employee_id;
            $service->vehicle_id = $request->vehicle_id;
            $service->save();
            return Redirect::to('service')->with('success','Great! service details changed successfully');
        }
        else if($service->date_set == $today && $service->time_start > $now){
            $service = new Service();
            $service->type = $request->type;
            $service->description = $request->description;
            $service->service_area = $request->service_area;
            $service->date_set = $request->date_set;
            $service->time_start = $request->time_start;
            $service->time_end = $time_end;
            $service->employee_id = $request->employee_id;
            $service->vehicle_id = $request->vehicle_id;
            $service->save();
            return Redirect::to('service')->with('success','Great! service details changed successfully');
        }else if($service->date_set == $today && $service->time_start <= $now){
            return Redirect::to('service/add')->with('warning','Check you date and time. Can\'t set time of the past!');
        }
    	}    	
    }
    public function ajax()
    {
            
    }
    public function employee_list(Request $request)
    {
        $data = Employee::where('speciality','like','%'.$request->service_area.'%')->take(3)->orderBy('rating', 'desc')->get();
        return response()->json(['result'=>$data]);
    }
}

