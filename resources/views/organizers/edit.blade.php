@extends('app')

@section('title', 'Edit Organizer')

{{-- Page Header --}}
@section('header-title', 'Edit Organizer')
@section('header-subtitle', 'Update details for ' . $organizer->name)

@section('content')

    {{-- 1. UPDATE FORM CARD --}}
    <div class="bg-[#18181b] border border-[#27272a] rounded-xl overflow-hidden shadow-sm mb-10">
        
        <form action="{{ route('organizers.update', $organizer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="px-6 py-6 space-y-6">
                
                {{-- Name Input --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Organizer Name</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $organizer->name) }}"
                           class="mt-1 block w-full rounded-md border-0 bg-[#27272a] text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 px-3 py-2"
                           required>
                    @error('name') 
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                {{-- Email Input --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $organizer->email) }}"
                           class="mt-1 block w-full rounded-md border-0 bg-[#27272a] text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 px-3 py-2"
                           required>
                    @error('email') 
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span> 
                    @enderror
                </div>

            </div>

            {{-- Form Footer / Actions --}}
            <div class="bg-[#27272a]/30 px-6 py-4 border-t border-[#27272a] flex justify-end gap-x-3">
                <a href="{{ route('organizers.index') }}" class="px-3 py-2 text-sm font-medium text-gray-300 hover:text-white transition-colors">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- 2. DANGER ZONE (Delete) --}}
    <div class="bg-[#18181b] border border-red-900/30 rounded-xl overflow-hidden shadow-sm">
        <div class="px-6 py-6">
            <h3 class="text-base font-semibold leading-6 text-white">Delete Organizer</h3>
            <div class="mt-2 max-w-xl text-sm text-gray-400">
                <p>Deleting this organizer may detach them from existing events. This action cannot be undone.</p>
            </div>
            <div class="mt-5">
                <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you absolutely sure you want to delete {{ $organizer->name }}?')"
                            class="rounded-md bg-red-500/10 px-3 py-2 text-sm font-semibold text-red-500 shadow-sm hover:bg-red-500/20 ring-1 ring-inset ring-red-500/20 transition-all">
                        Delete Organizer
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection