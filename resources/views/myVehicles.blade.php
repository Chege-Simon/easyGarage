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
            <a href="/profile" class="nav-item nav-link active">
                <i class="fa fa-user"></i> My Vehicles
            </a>
            <br>
            <a href="/profile/edit" class="nav-item nav-link">
                <i class="fa fa-cogs"></i> Register Vehicle
            </a>
            <br>
            <a href="profile/delete" class="nav-item nav-link">
                <i class="fa fa-remove"></i> Edit Vehicle Details
            </a>
            <br>
            <a href="profile/delete" class="nav-item nav-link">
                <i class="fa fa-remove"></i> Delete Vehicle Details
            </a>
        </nav>
    </div>
    <div class="p-4 col-sm-9">
        <div class="container">
            <div class="container">
                    <div class="display-4">VEHICLES</div>
                    <div class="card-body">
                    <table class="table mt-4 table-bordered table-hover">
                            <thead style="background:#b1d1ea"><tr>
                                <th class="h3" colspan="4">My Vehicles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->number_plate }}</td>
                                    <td>{{ $vehicle->brand }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->color }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
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