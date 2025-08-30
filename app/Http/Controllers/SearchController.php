<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\City;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
//        dd($request->all());
        $validated = $request->validate([
            'name' => 'required',
            'date_start' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'date_end' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ],[
            'city.required' => 'The city is missing'
        ]);

        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');
        $city = City::where('name', $request->input('name'))->first();
        $apartments = Apartment::where('city_id', $city->id)
            ->whereDoesntHave('bookings', function ($query) use ($date_start, $date_end) {
                $query->where('date_start', '<=', $date_end)
                    ->where('date_end', '>=', $date_start);
            })->get();



        return view('show', compact('apartments', 'city'));
    }
}
