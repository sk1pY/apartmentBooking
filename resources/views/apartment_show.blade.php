@extends('layouts.base')
@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
                closeOnSelect: false,
                disable: @json($bookings->map(fn($b) => [
                    'from' => $b->date_start,
                    'to'   => $b->date_end,
                ]), JSON_THROW_ON_ERROR)
            });
        });
    </script>

    <h3>Apartment</h3>
    <hr>
    {{$apartment->name}}
    @foreach($bookings as $booking)
        {{$booking->date_start}}
        ---
        {{$booking->date_end}}|||||||
    @endforeach
    <form action="{{route('booking.store',$apartment)}}" method="post">
        @csrf
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата начала" name="date_start"
               value="{{ request('date_start')}}">
        <input id="datepicker" class="form-control w-25" type="date" placeholder="Дата окончания" name="date_end"
               value="{{ request('date_end')}}">
        <input class="btn btn-primary" type="submit">
    </form>
@endsection
