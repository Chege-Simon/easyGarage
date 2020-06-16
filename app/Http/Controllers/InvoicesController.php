<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Service;

class InvoicesController extends Controller
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
        return view('invoice', compact('vehicles','user'));
    }
    public function pay(Request $request, $service)   
    {
        if (Auth::check())
        {   
            $service = Service::find($service);
            $service->is_paid = true;
            $service->save();
            return redirect('/invoice');
        }else {
            return redirect('/');
        }
    }
}
