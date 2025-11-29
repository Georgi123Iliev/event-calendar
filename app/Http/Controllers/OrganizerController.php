<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizer;

class OrganizerController extends Controller
{



public function index()
{
    $organizers = Organizer::withCount([
        // 1. Get total count and alias it to match your view
        'appEvents as total_events_count', 

        // 2. Get upcoming count using a condition
        'appEvents as upcoming_events_count' => function ($query) {
            $query->where('start_at', '>', now());
        }
    ])
    ->paginate(10);

    return view('organizers.index', compact('organizers'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organizers.create');
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

        Organizer::create($validated);

        return redirect()->route('Organizers.index')
            ->with('success', 'Organizer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizer $organizer)
    {

     
            // 1. Get Counts
            $totalEventsCount = $organizer->appEvents()->count();
            $upcomingEventsCount = $organizer->appEvents()->where('start_at', '>', now())->count();

            // 2. Get specific limited lists
            $upcomingEvents = $organizer->appEvents()
                ->where('start_at', '>', now())
                ->orderBy('start_at', 'asc')
                ->limit(3)
                ->get();

            $pastEvents = $organizer->appEvents()
                ->where('end_at', '<', now())
                ->orderBy('end_at', 'desc')
                ->limit(3)
                ->get();


                //Тук може би с помощен клас ще е по-добре?
            return view('organizers.show', compact(
                'organizer', 
                'totalEventsCount', 
                'upcomingEventsCount', 
                'upcomingEvents', 
                'pastEvents'
            ));


      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizer $organizer)
    {
        return view('organizers.edit', compact('organizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organizer $organizer)
    {
          $validated = $request->validate([
            'name'=> 'required|string|max:255',
            'address' =>'required|string|max:255',
            'capacity' => 'required|integer|min:0'
        ]);

         $organizer->update($validated);

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizer $organizer)
    {
        $organizer->delete();

        return redirect()->route('organizers.index')
                         ->with('success', 'organizer deleted successfully.');
    }

}
