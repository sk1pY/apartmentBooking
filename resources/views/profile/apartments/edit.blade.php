@extends('profile.index')
@section('profile')
    <h3>update apartment</h3>
    <form action="{{route('profile.apartments.update',$apartment)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input class="form-control" type="text" name="name" value="{{$apartment->name}}">
        <select class="form-control" name="city_id" id="">
            @foreach($cities as $city)
                <option value="{{$city->id}}"
                    {{$city->name == $apartment->city->name?'selected':''}}>
                    {{$city->name}}
                </option>
            @endforeach

        </select>
        <input class="form-control" type="file" name="image" >
        <input type="submit">
    </form>
@endsection
