<?php

namespace App\Http\Controllers\api\v1\profile;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
        return response()->json($apartments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
        ]);
        $user = Auth::user();
        if ($user) {
            $user->apartments()->create($validate);
            return response([
                'message' => 'Apartment created successfully',
            ], 201);
        }

        return response([
            'message' => 'Login to continue',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function apartmentBookings(Apartment $apartment)
    {
        $bookings = $apartment->bookings()->get();
        return response()->json($bookings);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        $apartment->update([
            'name' => $request->input('name'),
        ]);
        return response()->json($apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $this->authorize('delete', $apartment);

        $apartment->delete();
        return response([
            'message' => 'Apartment deleted successfully',
        ], 201);
    }
}
