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


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
        @foreach($apartments as $apartment)
            <div class="col">
                <div class="card h-100 rounded-3 border-0 shadow-sm">
                    <img src="{{ Storage::url('apartmentsImages/'.$apartment->image) }}"
                         class="card-img-top rounded-4 mt-2 mx-auto d-block"
                         style="height: 10rem; object-fit: cover; width: 95%;">

                    <div class="card-body d-flex flex-column">
                        <a href="{{ route('apartments.show', [$apartment, 'date_start' => request('date_start'), 'date_end' => request('date_end')]) }}"
                           class="text-decoration-none text-dark fw-semibold mb-2 flex-grow-1">
                            {{ $apartment->name }}
                        </a>

                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 fw-bold text-primary">{{ $apartment->price }} ₽</p>

                            <form action="{{ route('bookmark.store',$apartment) }}" method="post" class="mb-0">
                                @csrf
                                <button class="  btn-sm" type="submit">
                                    <i class="bi bi-star"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
