@extends('layouts.base')
@section('content')
    <h1>{{$city->name}}</h1>
    @foreach($apartments as $apartment)
        <table>

            <tr>
                <td>
                    <a href="{{route('apartments.show',$apartment)}}">{{$apartment->name}}</a>
                </td>
            </tr>
        </table>

    @endforeach
@endsection
