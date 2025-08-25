<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->get();
        return view('profile.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Apartment $apartment)
    {
        $validated = $request->validate([
            'date_start' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'date_end' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ]);

        $date_start = $request->input("date_start");
        $date_end = $request->input("date_end");

        $check = $apartment->bookings()
            ->where('date_start', '<=', $date_end)
            ->where('date_end', '>=', $date_start)
            ->first();

        if (!$check) {
            $user = Auth::user();
            $validated['apartment_id'] = $apartment->id;
            $user->bookings()->create($validated);
            return back()->with('success', 'booking created successfully');
        }
        return back()->with('error', 'booking exists already');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'booking deleted successfully');
    }
}
