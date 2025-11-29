@extends('app')

@section('title', 'Location Details')

@section('header-title', $location->name)
@section('header-subtitle', 'Detailed information ID: #' . $location->id)

@section('header-action')
    <a href="{{ route('locations.index') }}" 
       class="inline-flex items-center px-3 py-2 border border-[#27272a] bg-transparent text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:border-gray-500 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back to List
    </a>
@endsection

@section('content')

    <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm">
        
        {{-- Details Grid --}}
        <div class="px-6 py-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                {{-- Address --}}
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Address</dt>
                    <dd class="mt-1 text-sm text-white">{{ $location->address ?? 'N/A' }}</dd>
                </div>

                {{-- Capacity --}}
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Capacity</dt>
                    <dd class="mt-1 text-sm text-white">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-800 text-gray-300 border border-gray-700">
                            {{ $location->capacity }}
                        </span>
                    </dd>
                </div>

                {{-- Timestamps --}}
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Created</dt>
                    <dd class="mt-1 text-sm text-white">{{ $location->created_at->format('M d, Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        {{-- Action Footer --}}
        <div class="bg-[#27272a]/30 px-6 py-4 border-t border-[#27272a] flex items-center gap-x-4">
            
            {{-- 1. NEW BUTTON: View Related Events --}}
            {{-- Note: Ensure you create this route or replace with '#' --}}
          <a href="{{ route('locations.appEvents', $location->id) }}"
               class="inline-flex items-center px-4 py-2 border border-[#3f3f46] text-sm font-medium rounded-md shadow-sm text-gray-200 bg-[#27272a] hover:bg-[#3f3f46] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                </svg>
                Related Events
                
                {{-- Count Badge --}}
                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-900/50 text-indigo-200">
                    {{ $location->appEvents->count() }}
                </span>
            </a>

            <div class="flex-1"></div> {{-- Spacer to push Edit/Delete to the right --}}

            {{-- Edit Button --}}
            <a href="{{ route('locations.edit', $location->id) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                Edit Location
            </a>

            {{-- Delete Button --}}
            <form action="{{ route('locations.destroy', $location->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-400 hover:bg-red-900/20 hover:text-red-300 transition-colors"
                        onclick="return confirm('Are you sure you want to delete this location?')">
                    Delete
                </button>
            </form>

        </div>

    </div>

@endsection