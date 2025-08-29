@extends('profile.index')
@section('profile')
    <form action="{{route('profile.update'),Auth::user()->id}}" method="post">
        @csrf
        @method('put')
        <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
        <input type="submit">
    </form>
@endsection
