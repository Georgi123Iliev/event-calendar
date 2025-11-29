@extends('app')

@section('title', 'Create Location')

{{-- Page Header --}}
@section('header-title', 'Create Location')
@section('header-subtitle', 'Add a new location to the system')

@section('content')
    {{-- CREATE FORM CARD --}}
    <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm">
        
        <form action="{{ route('locations.store') }}" method="POST">
            @csrf

            <div class="px-6 py-6 space-y-6">
                
                {{-- 1. Name Input --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Location Name</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="mt-1 block w-full rounded-md border-0 bg-[#27272a] text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 px-3 py-2"
                           placeholder="e.g. Downtown Branch"
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
                           value="{{ old('address') }}"
                           class="mt-1 block w-full rounded-md border-0 bg-[#27272a] text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 px-3 py-2"
                           placeholder="e.g. 123 Main St">
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
                           value="{{ old('capacity') }}"
                           class="mt-1 block w-full rounded-md border-0 bg-[#27272a] text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 px-3 py-2"
                           placeholder="e.g. 50">
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
                <button type="submit" class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-black shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                    Create Location
                </button>
            </div>
        </form>
    </div>
@endsection