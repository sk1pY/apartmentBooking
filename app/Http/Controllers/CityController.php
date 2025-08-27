<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Bookmark;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        return view('index', compact('cities'));
    }

    public function show(City $city){

        $apartments = Apartment::where('city_id',$city->id)->get();

        $user = Auth::user();
        $bookmarksIds = $user->bookmarks()->pluck('apartment_id')->toArray();
        return view('show', compact('apartments','city','bookmarksIds'));
    }
}
