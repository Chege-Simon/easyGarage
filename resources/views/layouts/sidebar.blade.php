@if (Auth::check())  
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
    <a href="profile/delete" class="nav-item nav-link">
        <i class="fa fa-remove"></i> Delete Profile
    </a>
    <br>
    <a href="{{ route('password.request') }}" class="nav-item nav-link">
        <i class="fa fa-exchange"></i> Change Password
    </a>
</nav>
@endif