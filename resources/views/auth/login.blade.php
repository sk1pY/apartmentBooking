@extends('layouts.base')
@section('content')

    <div class="d-flex justify-content-center align-items-center bg-warning p-5" >

        <form method="POST" action="{{ route('login') }}">
            @csrf
            log<input class="form-control" type="text" name="email">
            pass<input class="form-control" type="text" name="password">
            <input class="btn btn-primary" type="submit">
        </form>
    </div>

@endsection
