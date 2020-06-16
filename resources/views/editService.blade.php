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
        <div class="container">
            <div class="container">
                    <div class="display-4">EDIT SERVICE</div>
                    <div class="card-body">
                    <form method="POST" action="/service/{{ $service->id }}">
                        @csrf
                        <div class="form-group row">
                            <label for="vehicle" class="col-md-4 col-form-label text-md-right">{{ __('vehicle for Servicing') }}</label>

                            <div class="col-md-6">
                                <select class="custom-select" id="vehicle_id" name="vehicle_id">
                                    <option value="{{ $vehicle->id }}">{{$vehicle->brand}} {{$vehicle->model}} {{$vehicle->number_plate}}</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{$vehicle->brand}} {{$vehicle->model}} {{$vehicle->number_plate}}</option>
                                    @endforeach
                                </select>
                                @error('vehicle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type of Service') }}</label>

                            <div class="col-md-6">
                                <select class="custom-select" id="type" name="type">
                                    <option selected>{{ $service->type }}</option>
                                    <option value="Repair">Repair</option>
                                    <option value="Paint-Work">Paint Work</option>
                                    <option value="Normal-Maintainace">Normal Maintainace</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Area of Attention') }}</label>

                            <div class="col-md-6">
                                <select class="custom-select" id="service_area" name="service_area">
                                    <option selected>{{ $service->service_area }}</option>
                                    <option value="Body">Body work</option>
                                    <option value="Engine">Engine</option>
                                    <option value="Electrical">Electrical</option>
                                    <option value="General">General Maintainace (like oil change)</option>
                                    <option value="Wheel">Wheel Alignment</option>
                                </select>
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{$service->description}}" name="description" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_set" class="col-md-4 col-form-label text-md-right">{{ __('Set Date') }}</label>

                            <div class="col-md-6">
                                <input id="date_set" type="date" class="form-control @error('date_set') is-invalid @enderror" value="{{$service->date_set}}" name="date_set" required autocomplete="date_set">

                                @error('date_set')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_start" class="col-md-4 col-form-label text-md-right">{{ __('Set Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="time_start" type="time" class="form-control @error('time_start') is-invalid @enderror" value="{{$service->time_start}}" name="time_start" required autocomplete="time_start">

                                @error('time_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mechanic" class="col-md-4 col-form-label text-md-right">{{ __('Mechanic') }}</label>
                            <div class=" row" style=" overflow-x: scroll;margin-left:100px;">
                            @foreach($employees as $employee)
                                <div class="col-md-4">
                                    <div class="card" style="width: 200px; height:380px; margin:10px">
                                        <i class="fa fa-user" class="card-img-top" aria-hidden="true" style="font-size:10em; margin-left:auto;margin-right:auto;"></i>
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{$employee ->first_name}} {{$employee->last_name}}</h5>
                                            <p class="card-text">
                                            <p><strong>Specialist in: </strong>{{$employee->speciality}}</p>
                                            <p><strong>Employee rating: </strong>{{$employee->rating}}</p>
                                            </p>
                                            <p class="btn btn-secondary"><input type='radio' name="employee_id" id="employee_id" value="{{$employee->id}}">Select</p>
                                        </div>
                                    </div>
                                    @error('mechanic')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit Service Details') }}
                                </button>
                            </div>
                        </div>
                    </form>
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