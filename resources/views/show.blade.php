@extends('layouts.base')
@section('content')
    <h1>{{$city->name}}</h1>
    <form action="{{ route('search')}}" class="d-flex align-items-center">
        <input class="form-control " type="text" placeholder="В какой город хотите поехать?" name="name"
               value="{{ $city->name}}">
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата начала" name="date_start"
               value="{{ request('date_start')}}">
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата окончания" name="date_end"
               value="{{ request('date_end')}}">
        <button type="submit" class="btn btn-primary">Найти</button>
    </form>


    <div class="row g-4 justify-content-center mt-3">
        @foreach($apartments as $apartment)
            <div class="card me-4 rounded-3 border-0" style="height: 15rem;width: 16rem">
                                <img src="{{Storage::url('apartmentsImages/'.$apartment->image)}}"
                                     class="card-img-top rounded-4 mt-2"  style=" height: 10rem;">
                <div class="card-body">
                    <a href="{{route('apartments.show', [$apartment, 'date_start' => request('date_start'), 'date_end' => request('date_end')]) }}"
                       class="text-decoration-none  text-muted card-text">  {{$apartment->name}}</a>
                    <form action="{{route('bookmark.store',$apartment)}}" method="post">
                        @csrf
                        <button class="btn btn-warning btn-sm" type="submit"
                            {{in_array($apartment->id,$bookmarksIds)? 'disabled' : ''}}>Добавить в избранное</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
