@extends('layouts.app')


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
            <a href="/vehicle" class="nav-item nav-link">
                <i class="fa fa-user"></i> My Vehicles
            </a>
            <br>
            <a href="/vehicle/add" class="nav-item nav-link active">
                <i class="fa fa-cogs"></i> Register Vehicle
            </a>
        </nav>
    </div>
    <div class="p-4 col-sm-9">
        <div class="container">
            <div class="container">
                    <div class="display-4">ADD VEHICLE</div>
                    <div class="card-body">
                    <form method="POST" action="/vehicle/register">
                        @csrf

                        <div class="form-group row">
                            <label for="number_plate" class="col-md-4 col-form-label text-md-right">{{ __('Number Plate') }}</label>

                            <div class="col-md-6">
                                <input id="number_plate" type="text" class="form-control @error('number_plate') is-invalid @enderror" name="number_plate" required autocomplete="number_plate" autofocus>

                                @error('number_plate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>

                            <div class="col-md-6">
                                <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" required autocomplete="brand">

                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="model" class="col-md-4 col-form-label text-md-right">{{ __('Model') }}</label>

                            <div class="col-md-6">
                                <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" required autocomplete="model">

                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                            <div class="col-md-6">
                                <input id="color" type="color" class="form-control @error('color') is-invalid @enderror" name="color" required autocomplete="color">

                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register Vehicle') }}
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