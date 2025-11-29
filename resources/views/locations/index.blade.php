@extends('app')

@section('title', 'Locations')

{{-- Define the Page Header --}}
@section('header-title', 'Locations')
@section('header-action')
    <a href="{{ route('locations.create') }}" 
       class="inline-flex items-center px-4 py-2 bg-white text-black text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Add Location
    </a>
@endsection

@section('content')

    {{-- Notification (still needs to be here or can be moved to app layout too) --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-900/50 border border-green-600 p-4 text-sm text-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- The Content Table --}}
    <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-400">
                <thead class="bg-[#27272a] text-gray-200 uppercase tracking-wider text-xs font-medium">
                    <tr>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Address</th>
                        <th class="px-6 py-4">Capacity</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#27272a]">
                    @forelse($locations as $location)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-medium text-white">{{ $location->name }}</td>
                        <td class="px-6 py-4">{{ $location->address ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $location->capacity }}</td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('locations.show', $location->id) }}" class="hover:text-white">View</a>
                            <a href="{{ route('locations.edit', $location->id) }}" class="text-indigo-400 hover:text-indigo-300">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">No locations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($locations, 'links') && $locations->hasPages())
            <div class="px-6 py-4 border-t border-[#27272a]">{{ $locations->links() }}</div>
        @endif
    </div>
@endsection