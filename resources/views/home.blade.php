@extends('layouts.app')

@section('content')
<div class="container">
<section class="bg-light">
      <div class="container"> 
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">
            <br>
            <br>
            <h1>Easy Garage</h1>
            <br>
            <br>
            <p class="lead">The number one website for stress-free vehicle services.</p>
            <br>
            <br>
            <p><a href="{{ route('register') }}" class="btn btn-primary shadow mr-2">Register Today</a><a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a></p>
            </div>
            <div class="col-lg-6 order-1 order-lg-2"><img src="images/car-repair.jpg" alt="..." class="img-fluid"></div>
        </div>
      </div>
    </section>
</div>
@endsection
