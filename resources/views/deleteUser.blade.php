@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
@if (Auth::check())
<div class="row">
    <div class="p-4 col-sm-3 py-20" style="border-right: 2px solid #b1d1ea">
        <div class="h3 P-20">Profile settings</div>
        <br>
        <br>
        <br>
        <nav class="nav nav-tabs flex-column">
            <a href="/profile" class="nav-item nav-link active">
                <i class="fa fa-user"></i> My Info
            </a>
            <br>
            <a href="/profile/edit" class="nav-item nav-link">
                <i class="fa fa-cogs"></i> Edit Profile
            </a>
            <br>
            <a href="profile/delete" class="nav-item nav-link active">
                <i class="fa fa-remove"></i> Delete Profile
            </a>
            <br>
            <a href="{{ route('password.request') }}" class="nav-item nav-link">
                <i class="fa fa-exchange"></i> Change Password
            </a>
        </nav>
    </div>
    <div class="p-4 col-sm-9">
        <div class="container">
            <div class="container">
                    <div class="display-4">DELETE ACCOUNT</div>
                    <div class="card-body">
                        <table class="table mt-4 table-bordered table-hover">
                            <thead style="background:#b1d1ea"><tr>
                                <th class="h3" colspan="4">My Info</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>First Name:</td>
                            <td>{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>National_ID Number:</td>
                            <td>{{ $user->national_id }}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        </tbody>
                        </table>
                    <form action="/profile/delete">
                        <button type="submit" name="cancel" formmethod="POST" class="btn btn-primary">Cancel</button>
                        <button type="submit" onclick="return confirm('Are you sure you want to Delete Your Account?');" name="delete" formmethod="POST" class="btn btn-danger">Delete</button>
                        {{ csrf_field() }}
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