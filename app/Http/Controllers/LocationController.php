<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

use \Carbon\Carbon;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $locations = Location::latest()->get();
        return view('locations.index',compact('locations'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name'=> 'required|string|max:255',
            'address' =>'required|string|max:255',
            'capacity' => 'required|integer|min:0'
        ]);

        Location::create($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Location created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {

        return view('locations.show',compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
          $validated = $request->validate([
            'name'=> 'required|string|max:255',
            'address' =>'required|string|max:255',
            'capacity' => 'required|integer|min:0'
        ]);

         $location->update($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')
                         ->with('success', 'Location deleted successfully.');
    }

    public function appEvents(Location $location)
    {
        $upcomingEvents = $location->appEvents()
            ->where('start_at', '>', now())   // 1. Comparison
            ->orderBy('start_at', 'asc')      // 2. Sort: Nearest events first
            ->paginate(10);                   // 3. Execute & Paginate

        $pastEvents = $location->appEvents()
                ->where('start_at', '<', now())   // 1. Comparison
                ->orderBy('start_at', 'desc')      // 2. Sort: Nearest events first
                ->paginate(10);                   // 3. Execute & Paginate



        return view('locations.appEvents', compact('location', 'upcomingEvents','pastEvents'));
    }

}
