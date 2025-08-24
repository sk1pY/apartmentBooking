@extends('layouts.base')
@section('content')
    <h3>Profile</h3>
    <hr>
    <div class="row">
        <div class="col-3">
            <div class="list-group">
                <a href="{{ route('profile.bookings.index') }}" class="list-group-item list-group-item-action">Bookings</a>
                <a href="#" class="list-group-item list-group-item-action">Settings</a>
                <a href="#" class="list-group-item list-group-item-action">My apartments</a>
            </div>
        </div>

        <div class="col">
            @yield('profile')
        </div>
    </div>
@endsection
