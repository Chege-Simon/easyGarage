@extends('layouts.app')
@section('title', 'Vehicles')

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
        <div class="container">
            <div class="container">
                <div class="display-4">SERVICES</div>
                <div class="card-body">
                @if(count($user->vehicles) > 0)
                    <p class="h2 darker"><u>Scheduled Services</u></p>
                    <table class="table mt-4 table-bordered table-hover">
                        <thead style="background:#a5a5a5">
                        </thead>
                        <tbody>
                                @foreach($vehicles as $vehicle)
                                    @if(count($vehicle->services)>0)
                                        @foreach($vehicle->services as $service)
                                            <tr>
                                                <td><div class="btn">{{ $service->type }}</div></td>
                                                <td><div class="btn">{{ $service->description }}</div></td>
                                                <td><div class="btn">{{ $service->time-start }}</div></td>
                                                <td><div class="btn">{{ $service->time-end }}</div></td>
                                                <td><div class="btn">{{ $service->is_in_progress }}</div></td>
                                                <td><div class="btn">{{ $service->is_cleared }}</div></td>
                                                <td>
                                                    <form action="/service/{{$service->id}}">
                                                        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                                        <button type="submit" name="delete" formmethod="POST" class="btn btn-danger">Delete</button>
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
                            <div class="text-muted text-justify" style=" margin-left: 30%">Oops, You dont have any registered vehicles yet!</div>
                        </div>
                    @endif
                </div>
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