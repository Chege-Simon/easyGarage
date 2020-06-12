@extends('layouts.app')
@section('title', 'Service')

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
            <div class="display-4">SERVICES</div>
            <p class="h2 darker"><u>Scheduled Services</u></p>
            <div class="card-body">
            @if(count($user->vehicles) > 0)
                <table class="table mt-4 table-bordered table-hover text-center">
                    <thead style="background-color:#b1d1ea">
                        <tr>
                            <th>Vehicle</th>
                            <th>Type of Service</th>
                            <th>Description</th>
                            <th>start</th>
                            <th>Estmate End</th>
                            <th>Assigned to:</th>
                            <th>Stage</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="overflow-y: scroll; max-height:400px;">
                            @foreach($vehicles as $vehicle)
                                @if(count($vehicle->services)>0)
                                    @foreach($vehicle->services as $service)
                                        <tr>
                                            <td><div class="btn">{{ $service->vehicle->number_plate }}</div></td>
                                            <td><div class="btn">{{ $service->type }}</div></td>
                                            <td><div class="btn">{{ $service->description }}</div></td>
                                            <td><div class="btn">{{ $service->time_start }}</div></td>
                                            <td><div class="btn">{{ $service->time_end }}</div></td>
                                            <td><div class="btn">{{ $service->employee->first_name }} {{ $service->employee->last_name }}</div></td>
                                            <td><div class="btn">@switch($service->is_cleared)
                                                                    @case (0)
                                                                        <span style="background:orange; padding:5px; border-radius:10%">Waiting...</span>
                                                                        @break
                                                                    @case (1)
                                                                        <span style="background:green">In progress...</span>
                                                                        @break
                                                                    @default
                                                                        <span style="background:orange">Waiting...</span>
                                                                        @endswitch
                                                                    </div></td>
                                            <td>
                                                <form action="/service/{{$service->id}}">
                                                    <button type="submit" name="edit" class="btn btn-primary" style="margin:2px">Edit </button>
                                                    <button type="submit" onclick="return confirm('Are you sure you want to Remove?');" style="margin:2px" name="delete" formmethod="POST" class="btn btn-danger">Delete</button>
                                                    {{ csrf_field() }}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>                                                 
                                        <div class="container">
                                            <div class="fa fa-frown-o text-muted" aria-hidden="true" style="font-size: 10rem; margin-left: 40%"></div>                           
                                            <div class="text-muted text-justify" style=" margin-left: 30%">Oops, You dont have any services in schedule yet!</div>
                                        </div>
                                    </tr>
                                @endif
                            @endforeach
                    </tbody>
                </table>
                @else
                    <div class="container">
                        <div class="fa fa-frown-o text-muted" aria-hidden="true" style="font-size: 10rem; margin-left: 40%"></div>                           
                        <div class="text-muted text-justify" style=" margin-left: 30%">Oops, You need to register a vehicle first</div>
                    </div>
                @endif
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