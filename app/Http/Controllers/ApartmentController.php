<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(){

    }

    public function show(Apartment $apartment){
        $bookings = $apartment->bookings()->get();
        return view('apartment_show', compact('apartment','bookings'));
    }
}
