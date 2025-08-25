@extends('layouts.base')
@section('content')
    <div class="p-3 bg-primary m-4 rounded-5">
        <form action="{{route('search')}}"  class="d-flex align-items-center">
            <input class="form-control " type="text" placeholder="В какой город хотите поехать?" name="name">
            <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата начала" name="date_start">
            <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата окончания" name="date_end">
            <button type="submit" class="btn btn-primary">Найти</button>
        </form>
    </div>



    <div class="row g-4 justify-content-center">

        @foreach($cities as $city)
            <div class="card" style="width: 18rem;">
                {{--                <img src="..." class="card-img-top" alt="...">--}}
                <div class="card-body">
                    <a href="{{route('city.show',$city)}}" class="card-text">{{$city->name}}</a>
                </div>
            </div>
            {{--            {{$apartment->name}}--}}
        @endforeach
    </div>

@endsection

