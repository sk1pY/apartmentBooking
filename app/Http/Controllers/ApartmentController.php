<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(){
        //
    }

    public function show(Apartment $apartment){
        $bookings = $apartment->bookings()->get();
        $comments = $apartment->comments;
        return view('apartment_show', compact('apartment','bookings','comments'));
    }
}
