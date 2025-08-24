<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        return view('index', compact('cities'));
    }

    public function show(City $city){

        $apartments = Apartment::where('city_id',$city->id)->get();
        return view('show', compact('apartments','city'));
    }
}
