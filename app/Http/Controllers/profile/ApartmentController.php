<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\City;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = auth()->user()->apartments()->get();

        return view('profile.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('profile.apartments.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'city_id' => 'required|exists:cities,id',
        ]);


        $validate['image'] = $request->hasFile('image')
            ? basename($request->file('image')->store('apartmentsImages', 'public'))
            : null;


        auth()->user()->apartments()->create($validate);
        return back()->with('success', 'apartment created successfully.');

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
    public function edit(Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        $cities = City::all();

        return view('profile.apartments.edit', compact('apartment', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        $validate = $request->validate([
            'name' => 'required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'city_id' => 'required|exists:cities,id',
        ]);


        $validate['image'] = $request->hasFile('image')
            ? basename($request->file('image')->store('apartmentsImages', 'public'))
            : $apartment->image;

        auth()->user()->apartments()->update($validate);
        return back()->with('success', 'apartment update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment    )
    {
        $apartment->delete();
        return back()->with('success', 'apartment deleted successfully.');
    }
}
