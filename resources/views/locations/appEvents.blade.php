@extends('app')

@section('title', 'AppEvents at ' . $location->name)

@section('header-title', 'AppEvents')
@section('header-subtitle', 'Schedule for ' . $location->name)

@section('header-action')
    <a href="{{ route('locations.show', $location->id) }}" 
       class="inline-flex items-center px-4 py-2 border border-[#27272a] bg-transparent text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:border-gray-500 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back to Location
    </a>
@endsection

@section('content')

    <div class="space-y-10">

        {{-- ================= UPCOMING EVENTS ================= --}}
        <div>
            <h3 class="text-lg font-medium leading-6 text-white mb-4 flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-indigo-500"></span>
                Upcoming AppEvents
            </h3>

            <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-400">
                        <thead class="bg-[#27272a] text-gray-200 uppercase tracking-wider text-xs font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4">Title</th>
                                <th scope="col" class="px-6 py-4">Start At</th>
                                <th scope="col" class="px-6 py-4">End At</th>
                                <th scope="col" class="px-6 py-4">Organizers</th>
                                <th scope="col" class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#27272a]">
                            @forelse($upcomingEvents as $appEvent)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 font-medium text-white">{{ $appEvent->title }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appEvent->start_at)->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appEvent->end_at)->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    @if($appEvent->organizers->isNotEmpty())
                                        <div class="flex -space-x-2 overflow-hidden">
                                            @foreach($appEvent->organizers->take(3) as $organizer)
                                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-gray-600 ring-2 ring-[#18181b] text-[10px] font-bold text-white" title="{{ $organizer->name }}">
                                                    {{ substr($organizer->name, 0, 1) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-600 italic">None</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="text-indigo-400 hover:text-indigo-300">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <p class="text-base font-medium text-gray-300">No upcoming AppEvents.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ================= PAST EVENTS ================= --}}
        <div>
            <h3 class="text-lg font-medium leading-6 text-gray-400 mb-4 flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-gray-600"></span>
                Past AppEvents
            </h3>

            <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm opacity-80 hover:opacity-100 transition-opacity">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500">
                        <thead class="bg-[#27272a] text-gray-400 uppercase tracking-wider text-xs font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4">Title</th>
                                <th scope="col" class="px-6 py-4">Start At</th>
                                <th scope="col" class="px-6 py-4">End At</th>
                                <th scope="col" class="px-6 py-4">Organizers</th>
                                <th scope="col" class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#27272a]">
                            @forelse($pastEvents as $appEvent)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-300">{{ $appEvent->title }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appEvent->start_at)->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appEvent->end_at)->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    @if($appEvent->organizers->isNotEmpty())
                                        <div class="flex -space-x-2 overflow-hidden">
                                            @foreach($appEvent->organizers->take(3) as $organizer)
                                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-gray-600 ring-2 ring-[#18181b] text-[10px] font-bold text-white" title="{{ $organizer->name }}">
                                                    {{ substr($organizer->name, 0, 1) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-600 italic">None</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#" class="text-gray-500 hover:text-indigo-300">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-600">
                                    No past history found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection