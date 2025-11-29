@extends('app')

@section('title', 'Organizer Details')

@section('header-title', $organizer->name)
@section('header-subtitle', 'Organizer Profile & Overview')

@section('header-action')
    <a href="{{ route('organizers.index') }}" 
       class="inline-flex items-center px-4 py-2 border border-[#27272a] bg-transparent text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:border-gray-500 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back to List
    </a>
@endsection

@section('content')

    <div class="space-y-8">

        {{-- 1. PROFILE & STATS CARD --}}
        <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm">
            <div class="px-6 py-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    
                    {{-- Contact Info --}}
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                        <dd class="mt-1 text-sm text-white">{{ $organizer->email }}</dd>
                    </div>

                    {{-- Pre-calculated Stats passed from Controller --}}
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Total Events</dt>
                        <dd class="mt-1 text-2xl font-semibold text-white">
                            {{ $totalEventsCount }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Upcoming</dt>
                        <dd class="mt-1 text-2xl font-semibold text-indigo-400">
                            {{ $upcomingEventsCount }}
                        </dd>
                    </div>
                </dl>
            </div>
            
            {{-- Profile Actions --}}
            <div class="bg-[#27272a]/30 px-6 py-4 border-t border-[#27272a] flex justify-end gap-x-3">
                <a href="{{ route('organizers.edit', $organizer->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    Edit Profile
                </a>
                <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-400 hover:bg-red-900/20 hover:text-red-300 transition-colors" onclick="return confirm('Delete this organizer?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        {{-- 2. EVENTS OVERVIEW --}}
        @if($totalEventsCount > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- UPCOMING LIST --}}
            <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm flex flex-col">
                <div class="px-6 py-4 border-b border-[#27272a] bg-[#27272a]/20">
                    <h3 class="text-sm font-medium text-white flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-500"></span> Upcoming Schedule
                    </h3>
                </div>
                <div class="flex-1">
                    @forelse($upcomingEvents as $appEvent)
                        <div class="px-6 py-4 border-b border-[#27272a] last:border-0 hover:bg-white/5 transition-colors">
                            <p class="text-sm font-semibold text-white">{{ $appEvent->title }}</p>
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($appEvent->start_at)->format('M d, H:i') }}
                                </p>
                                {{-- Placeholder for specific event view --}}
                                <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300">View</a>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center">
                            <p class="text-sm text-gray-500">No upcoming events scheduled.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- PAST LIST --}}
            <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm flex flex-col opacity-90">
                <div class="px-6 py-4 border-b border-[#27272a] bg-[#27272a]/20">
                    <h3 class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-gray-600"></span> Recent History
                    </h3>
                </div>
                <div class="flex-1">
                    @forelse($pastEvents as $appEvent)
                        <div class="px-6 py-4 border-b border-[#27272a] last:border-0 hover:bg-white/5 transition-colors">
                            <p class="text-sm font-medium text-gray-300">{{ $appEvent->title }}</p>
                            
                            {{-- UPDATED: Now includes 'View' link consistent with Upcoming --}}
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-xs text-gray-500">
                                    Ended {{ \Carbon\Carbon::parse($appEvent->end_at)->diffForHumans() }}
                                </p>
                                {{-- Placeholder for specific event view --}}
                                <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300">View</a>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center">
                            <p class="text-sm text-gray-500">No past events found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
        </div>

        {{-- 3. VIEW ALL FOOTER LINK --}}
        <div class="flex justify-center">
            <a href="#" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors border-b border-transparent hover:border-white pb-0.5">
                View all {{ $totalEventsCount }} events &rarr;
            </a>
        </div>
        @endif

    </div>

@endsection