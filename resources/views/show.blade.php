@extends('layouts.base')
@section('content')
    <h1>{{$city->name}}</h1>
    <form action="{{ route('search')}}" class="d-flex align-items-center">
        <input class="form-control " type="text" placeholder="В какой город хотите поехать?" name="name"
               value="{{ $city->name}}">
        <select class="form-control w-25 mx-2" name="quantity" id="">
            <option value="1" {{ request('quantity') === '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ request('quantity') === '2' ? 'selected' : '' }}>2 взрослых</option>
            <option value="3" {{ request('quantity') === '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ request('quantity') === '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ request('quantity') === '5' ? 'selected' : '' }}>5</option>
        </select>
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата начала" name="date_start"
               value="{{ request('date_start')}}">
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата окончания" name="date_end"
               value="{{ request('date_end')}}">
        <button type="submit" class="btn btn-primary">Найти</button>
    </form>
    {{--    FILTER--}}
    <form action="" method="get" class="mt-3">
        <select class="form-control w-25" name="filter"
                onchange="this.form.submit()">
            <option value="">Выберите фильтр</option>
            <option class="form-control" value="price_asc" {{ request('filter') === 'price_asc' ? 'selected' : '' }}>
                Сначала дешевле
            </option>
            <option class="form-control" value="price_desc"
                    {{ request('filter') === 'price_desc' ? 'selected' : '' }}>
                Сначала дороже
            </option>
            <option class="form-control" value="rating"
                    {{ request('filter') === 'rating' ? 'selected' : '' }}>
                Высокий рейтинг
            </option>
        </select>
    </form>
    {{--FILTER END--}}

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
        @foreach($apartments as $apartment)
            <div class="col">
                <div class="card h-100 rounded-3 border-0 shadow-sm">
                    <img src="{{ Storage::url('apartmentsImages/'.$apartment->image) }}"
                         class="card-img-top rounded-4 mt-2 mx-auto d-block"
                         style="height: 10rem; object-fit: cover; width: 95%;">

                    <div class="card-body d-flex flex-column">
                        <a href="{{ route('apartments.show', [$apartment, 'date_start' => request('date_start'), 'date_end' => request('date_end'),'quantity' => request('quantity')]) }}"
                           class="text-decoration-none text-dark fw-semibold mb-2 flex-grow-1">
                            {{ $apartment->name }}
                        </a>
                        <span>Рейтинг: {{$apartment->avgRating}}</span>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 fw-bold text-primary">{{ $apartment->price }} ₽</p>

                            {{-- BOOKMARKS --}}
                            <div class="bookmark-button" style="cursor: pointer"
                                 data-apartment-id="{{$apartment->id}}"
                                 data-url="{{route('bookmark.store')}}">
                                <i class="text-warning bi bi-bookmark{{in_array($apartment->id,$bookmarksIds)?"-fill":""}}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
