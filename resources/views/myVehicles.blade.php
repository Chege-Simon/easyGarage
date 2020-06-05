@extends('layouts.app')
@section('title', 'Vehicles')

@section('content')
<div class="container">
@if (Auth::check())
<div class="row">
    <div class="p-4 col-sm-3 py-20" style="border-right: 2px solid #b1d1ea">
        <div class="h3 P-20">Vehicles settings</div>
        <br>
        <br>
        <br>
        <nav class="nav nav-tabs flex-column">
            <a href="/vehicle" class="nav-item nav-link active">
                <i class="fa fa-user"></i> My Vehicles
            </a>
            <br>
            <a href="/vehicle/add" class="nav-item nav-link">
                <i class="fa fa-cogs"></i> Register Vehicle
            </a>
            <br>
            <!-- <a href="/vehicle/edit" class="nav-item nav-link">
                <i class="fa fa-remove"></i> Edit Vehicle Details
            </a>
            <br>
            <a href="/vehicle/delete" class="nav-item nav-link">
                <i class="fa fa-remove"></i> Delete Vehicle Details
            </a> -->
        </nav>
    </div>
    <div class="p-4 col-sm-9">
        <div class="container">
            <div class="container">
                <div class="display-4">VEHICLES</div>
                <div class="card-body">
                    @if(count($user->vehicles) > 0)
                    <p class="h2 darker"><u>My Vehicles</u></p>
                    <table class="table mt-4 table-bordered table-hover">
                        <thead style="background:#a5a5a5">
                            <!-- <tr>
                                <td>Number Plate</td>
                                <td>Brand</td>
                                <td>Model</td>
                                <td>Color</td>
                            </tr> -->
                        </thead>
                        <tbody>
                                @foreach($user->vehicles as $vehicle)
                                    <tr>
                                        <td><div class="btn">{{ $vehicle->number_plate }}</div></td>
                                        <td><div class="btn">{{ $vehicle->brand }}</div></td>
                                        <td><div class="btn">{{ $vehicle->model }}</div></td>
                                        <td><div class="btn" style="background-color:{{ $vehicle->color }};">Color</div></td>
                                        <td>
                                            <form action="/vehicle/{{$vehicle->id}}">
                                                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                                <button type="submit" name="delete" formmethod="POST" class="btn btn-danger">Delete</button>
                                                {{ csrf_field() }}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="container">
                            <div class="fa fa-frown-o text-muted" aria-hidden="true" style="font-size: 10rem; margin-left: 40%"></div>                           
                            <div class="text-muted text-justify" style=" margin-left: 30%">Oops, You dont have any vehicles registered yet!</div>
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