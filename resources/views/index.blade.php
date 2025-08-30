@extends('layouts.base')
@section('content')
    <div class="p-3 bg-primary m-4 rounded-5">
        <form action="{{route('search')}}" class="d-flex align-items-center">
            <select class="form-control w-25 mx-2" name="name">
{{--                <option>Выберите город</option>--}}
                @foreach($cities as $city)
                    <option value="{{old('city',$city->name)}}">{{$city->name}}</option>
                @endforeach

            </select>
            <select class="form-control w-25 mx-2" name="quantity" id="">
                <option value="1">1</option>
                <option value="2" selected>2 взрослых</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата начала" name="date_start"
                   value="{{old('date_start')}}">
            <input id="datepicker" class="form-control w-25 mx-2" type="date" placeholder="Дата окончания"
                   name="date_end"
                   value="{{old('date_end')}}">
            <button type="submit" class="btn btn-primary">Найти</button>
        </form>
    </div>



    <div class="row g-4 justify-content-center">
        @foreach($cities as $city)
            <div class="card me-4" style="width: 18rem;">
                <img src="{{Storage::url('citiesImages/'.$city->image)}}"
                     class="card-img-top h-75 rounded-3 p-1" alt="...">
                <div class="card-body">
                    <a href="{{route('city.show',$city)}}"
                       class="text-decoration-none  text-muted card-text">{{$city->name}}</a>
                </div>
            </div>
            {{--            {{$apartment->name}}--}}
        @endforeach
    </div>

@endsection

