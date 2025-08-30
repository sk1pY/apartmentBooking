@extends('profile.index')
@section('profile')
    <h3>store apartment</h3>
    <form action="{{route('profile.apartments.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="text" name="name" value="{{old('name')}}">
        <input class="form-control" type="text" name="address" value="{{old('address')}}">
        <input class="form-control" type="text" name="price" value="{{old('price')}}">
        <select class="form-control" name="city_id" id="">
            @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach

        </select>
        <input class="form-control" type="file" name="image">
        <input type="submit">
    </form>
@endsection
