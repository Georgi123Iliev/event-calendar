@extends('app')

@section('title', 'Edit Location')

{{-- Page Header --}}
@section('header-title', 'Edit Location')
@section('header-subtitle', 'Update the details for ' . $location->name)

@section('content')
    {{-- UPDATE FORM CARD --}}
    <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm mb-10">
        
        <form action="{{ route('locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="px-6 py-6 space-y-6">
                
                {{-- 1. Name Input --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Location Name</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $location->name) }}"
                           class="mt-1 block w-full rounded-md border-0 bg-[#27272a] text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 px-3 py-2"
                           required>
                    @error('name') 
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                {{-- 2. Address Input --}}
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-300">Address</label>
                    <input type="text" 
                           name="address" 
                           id="address" 
                           value="{{ old('address', $location->address) }}"
                           class="mt-1 block w-full rounded-md border-0 bg-[#27272a] text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 px-3 py-2">
                    @error('address') 
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                {{-- 3. Capacity Input --}}
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-300">Capacity</label>
                    <input type="number" 
                           name="capacity" 
                           id="capacity" 
                           value="{{ old('capacity', $location->capacity) }}"
                           class="mt-1 block w-full rounded-md border-0 bg-[#27272a] text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 px-3 py-2">
                    @error('capacity') 
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span> 
                    @enderror
                </div>

            </div>

            {{-- Form Footer / Actions --}}
            <div class="bg-[#27272a]/30 px-6 py-4 border-t border-[#27272a] flex justify-end gap-x-3">
                <a href="{{ route('locations.index') }}" class="px-3 py-2 text-sm font-medium text-gray-300 hover:text-white transition-colors">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- DANGER ZONE (Delete) --}}
    <div class="bg-[#18181b] border border-red-900/30 rounded-xl overflow-hidden shadow-sm">
        <div class="px-6 py-6">
            <h3 class="text-base font-semibold leading-6 text-white">Delete Location</h3>
            <div class="mt-2 max-w-xl text-sm text-gray-400">
                <p>Once you delete a location, there is no going back. Please be certain.</p>
            </div>
            <div class="mt-5">
                <form action="{{ route('locations.destroy', $location->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you absolutely sure? This action cannot be undone.')"
                            class="rounded-md bg-red-500/10 px-3 py-2 text-sm font-semibold text-red-500 shadow-sm hover:bg-red-500/20 ring-1 ring-inset ring-red-500/20 transition-all">
                        Delete Location
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection