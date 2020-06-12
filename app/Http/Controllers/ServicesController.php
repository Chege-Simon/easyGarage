<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect, Response;
use App\Vehicle;
use App\Employee;
use App\Service;

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
        $user = Auth::user();
        $vehicles = Auth::user()->vehicles;
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
        $id = Auth::user()->id;
        // dd($request->time_start);
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'service_area' => ['required', 'string', 'max:255'],
            'date_set' => 'date_format:Y-m-d',
            'time_start' => 'date_format:H:i',
            'employee_id' => ['required','integer'],
            'vehicle_id' => ['required','integer']
        ]);
        switch ($request->type) {
            case 'repair':
                $timestamp = strtotime($request->time_start)+ 60*60;
                $time_end = date('h:i', $timestamp);
                break;
            case 'paint-work':
                $timestamp = strtotime($request->time_start)+ 60*60 + 60*60 + 60*60;
                $time_end = date('h:i', $timestamp);
                break;
            case 'normal-maintainace':
                $timestamp = strtotime($request->time_start)+ 60*60;
                $time_end = date('h:i', $timestamp);
                break;
            default:
                $timestamp = strtotime($request->time_start) + 60*60;
                $time_end = date('h:i', $timestamp);
                break;
        }
        // dd($request->time_start, $time_end);
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
        $service->save();
        return Redirect::to('service')->with('success','Great! service Registered successfully');
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
            $service->type = $request->type;
            $service->description = $request->description;
            $service->service_area = $request->service_area;
            $service->date_set = $request->date_set;
            $service->time_start = $request->time_start;
            $service->time_end = $time_end;
            $service->employee_id = $request->employee_id;
            $service->vehicle_id = $request->vehicle_id;
            $service->save();
            return Redirect::to('service')->with('success','Great! Service Details changed successfully');
    	}    	
    }
    public function ajax()
    {
            
    }
    public function crud_ajax(Request $request)
    {
        $data = Employee::where('speciality', $request->service_area)->take(10)->get();
        return response()->json(['result'=>$data]);
    }
}

