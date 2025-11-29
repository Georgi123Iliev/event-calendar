@extends('app')

@section('title', 'All Organizers')

@section('header-title', 'Organizers')
@section('header-subtitle', 'Manage event organizers')

@section('header-action')
    <a href="{{ route('organizers.create') }}" 
       class="inline-flex items-center px-4 py-2 bg-white text-black text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Add Organizer
    </a>
@endsection

@section('content')

    <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-400">
                <thead class="bg-[#27272a] text-gray-200 uppercase tracking-wider text-xs font-medium">
                    <tr>
                        <th scope="col" class="px-6 py-4">Name</th>
                        <th scope="col" class="px-6 py-4">Email</th>
                        <th scope="col" class="px-6 py-4">Statistics</th>
                        <th scope="col" class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#27272a]">
                    @forelse($organizers as $organizer)
                    <tr class="hover:bg-white/5 transition-colors">
                        
                        {{-- Name --}}
                        <td class="px-6 py-4 font-medium text-white">
                            {{ $organizer->name }}
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-4">
                            {{ $organizer->email }}
                        </td>

                        {{-- N organized, M upcoming --}}
                        <td class="px-6 py-4">
                            <div class="flex flex-col items-start gap-y-1">
                                
                                {{-- The Stats Text --}}
                                <div class="text-xs">
                                    <span class="text-gray-400">Has organized</span>
                                    <span class="text-white font-semibold">{{ $organizer->total_events_count - $organizer->upcoming_events_count ?? 0 }}</span>
                                    <span class="text-gray-400">events</span>
                                </div>
                                
                                <div class="text-xs">
                                    <span class="text-gray-400">and has</span>
                                    <span class="text-indigo-400 font-bold">{{ $organizer->upcoming_events_count ?? 0 }}</span>
                                    <span class="text-gray-400">upcoming</span>
                                </div>

                                {{-- The Link --}}
                                <a href="{{ route('organizers.show', $organizer->id) }}" class="mt-2 text-xs font-medium text-indigo-400 hover:text-white border-b border-indigo-400/30 hover:border-white transition-colors">
                                    See events by this organizer &rarr;
                                </a>
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right space-x-3 align-middle">
                            <a href="{{ route('organizers.edit', $organizer->id) }}" class="text-indigo-400 hover:text-indigo-300">
                                Edit
                            </a>

                            <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-gray-500 hover:text-red-400 bg-transparent border-0 cursor-pointer transition-colors"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <p class="text-base font-medium text-gray-300">No organizers found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($organizers, 'links') && $organizers->hasPages())
            <div class="px-6 py-4 border-t border-[#27272a]">
                {{ $organizers->links() }}
            </div>
        @endif
    </div>

@endsection