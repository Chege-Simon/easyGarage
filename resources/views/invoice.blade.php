@extends('layouts.app')
@section('title', 'Invoices')

@section('content')
<div class="container">
@if (Auth::check())
<div class="row">
    <div class="p-4 col-sm-3 py-20" style="border-right: 2px solid #b1d1ea">
        <div class="h3 P-20">Services settings</div>
        <br>
        <br>
        <br>
        <nav class="nav nav-tabs flex-column">
            <a href="/service" class="nav-item nav-link active">
                <i class="fa fa-user"></i> Scheduled Services
            </a>
            <br>
            <a href="/service/add" class="nav-item nav-link">
                <i class="fa fa-cogs"></i> Request Services
            </a>
            <br>
        </nav>
    </div>
    <div class="p-4 col-sm-9">
        <div class="">
            <div class="display-4">INVOICES</div>
            <p class="h2 darker"><u>Pending Invoices</u></p>
            <div class="card-body">
                
            @foreach($vehicles as $vehicle)
                @foreach($vehicle->services as $service)
                    @if($service->is_cleared && $service->is_paid == false)
                        <div class="container" style="border:1px solid black; border-radius: 10px;">
                            <div class="row">
                                <div class="col-sm-8"><u><b>Vehicle Number plate: {{$service->number_plate}}</b></u></div>
                                <div class="col-sm-4 text-muted">Date: {{$service->time_end}} {{$service->date_set}}</div>
                            </div>
                            <div class="text-muted">Service Type: {{$service->type}}</div>
                            <div class="text-muted">Service Description: {{$service->description}}</div>
                            <div class="row">
                                <div class="col-sm-10 text-muted ">Area Service: {{$service->service_area}}</div>
                                <div class="col-sm-1" style="margin:2px">
                                    <form action="/invoice/{{$service->id}}">
                                        <button type="submit" name="pay"formmethod="POST" class="btn btn-primary">Pay</button>
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
            @endforeach
            </div>
        </div> 
    </div>  
    @else
        <div class="card-body">
            <p>Oops You need to log in buddy. <a href="/login">Click here to login</a></p>
        </div>
    @endif
</div>
</div>
@endsection