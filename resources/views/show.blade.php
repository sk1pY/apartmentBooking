@extends('layouts.base')
@section('content')
    <h1>{{$city->name}}</h1>
    <form action="{{ route('search')}}" class="d-flex align-items-center">
        <input class="form-control " type="text" placeholder="В какой город хотите поехать?" name="name"
               value="{{ request('name')}}">
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата начала" name="date_start"
               value="{{ request('date_start')}}">
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата окончания" name="date_end"
               value="{{ request('date_end')}}">
        <button type="submit" class="btn btn-primary">Найти</button>
    </form>
    @foreach($apartments as $apartment)
        <table>

            <tr>
                <td>
                    <a href="{{ route('apartments.show', [$apartment, 'date_start' => request('date_start'), 'date_end' => request('date_end')]) }}">
                        {{ $apartment->name }}
                    </a></td>
            </tr>
        </table>

    @endforeach
@endsection
