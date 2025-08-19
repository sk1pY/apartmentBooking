<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Apartment $apartment)
    {
        $validated = $request->validate([
            'date_start' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'date_end' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        $user = Auth::user();

        $validated['apartment_id'] = $apartment->id;
        $user->bookings()->create($validated);

        return response()->json([
            'message' => 'added successfully'
        ], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
