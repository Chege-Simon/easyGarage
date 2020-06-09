<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect, Response;
use App\Vehicle;
use App\Employee;

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
        $employees = Employee::all();
        return view('addService',compact('employees'));
    }
    public function employeelist()
    {

        return Response::json($employees);
    }
}

