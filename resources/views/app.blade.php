<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ ($appearance ?? 'system') == 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name', 'Laravel'))</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';
                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (prefersDark) { document.documentElement.classList.add('dark'); }
                }
            })();
        </script>
        <style>
            html { background-color: oklch(1 0 0); }
            html.dark { background-color: oklch(0.145 0 0); }
        </style>

        @php
            $viteAssets = ['resources/css/app.css', 'resources/js/app.ts'];
            if (isset($page) && isset($page['component'])) {
                $viteAssets[] = "resources/js/pages/{$page['component']}.vue";
            }
        @endphp
        @vite($viteAssets)
        
        @if(isset($page)) @inertiaHead @endif
        @stack('head')
    </head>
    <body class="font-sans antialiased bg-white dark:bg-[#09090b] text-gray-900 dark:text-gray-100">

        @if (isset($page))
            @inertia
        @else
            {{-- BLADE LAYOUT SHELL --}}
            <div class="min-h-screen flex">
                
                {{-- Sidebar --}}
                <aside class="hidden md:flex w-64 flex-col fixed inset-y-0 z-50 bg-black border-r border-white/10">
                    <div class="flex h-16 shrink-0 items-center px-6 text-white font-bold">Laravel Starter Kit</div>
                    
                    {{-- 
                        UPDATED NAVIGATION LOGIC 
                        We check the current route pattern to apply the 'active' classes.
                    --}}
                    <nav class="flex flex-1 flex-col px-4 py-4 space-y-1">
                        
                        {{-- Dashboard --}}
                        <a href="/dashboard" 
                           class="{{ request()->is('dashboard') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-colors">
                           Dashboard
                        </a>

                        {{-- Locations (Active for index, create, edit, show, etc.) --}}
                        <a href="{{ route('locations.index') }}" 
                           class="{{ request()->routeIs('locations.*') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-colors">
                           Locations
                        </a>

                        {{-- Organizers (Active for index, create, edit, show, etc.) --}}
                        <a href="{{ route('organizers.index') }}" 
                           class="{{ request()->routeIs('organizers.*') ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-colors">
                           Organizers
                        </a>

                    </nav>
                </aside>

                {{-- Main Content Wrapper --}}
                <main class="flex-1 md:pl-64 flex flex-col min-h-screen">
                    
                    {{-- Top Navbar --}}
                    <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-white/10 bg-[#09090b] px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                         <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 justify-end items-center">
                            <span class="text-sm text-gray-400">Admin</span>
                         </div>
                    </div>

                    {{-- DYNAMIC PAGE HEADER --}}
                    @hasSection('header-title')
                    <header class="bg-[#09090b] border-b border-white/5">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
                            <div>
                                <h1 class="text-xl font-semibold text-white">
                                    @yield('header-title')
                                </h1>
                                @hasSection('header-subtitle')
                                    <p class="mt-1 text-sm text-gray-400">@yield('header-subtitle')</p>
                                @endif
                            </div>
                            <div>
                                @yield('header-action')
                            </div>
                        </div>
                    </header>
                    @endif

                    {{-- PAGE CONTENT --}}
                    <div class="flex-1 py-8">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            @yield('content')
                        </div>
                    </div>

                    {{-- GLOBAL FOOTER --}}
                    <footer class="border-t border-white/10 bg-[#09090b] py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-xs text-gray-500">
                            <p>&copy; {{ date('Y') }} Laravel Starter Kit.</p>
                            <p>v1.0.0</p>
                        </div>
                    </footer>

                </main>
            </div>
            @stack('scripts')
        @endif
    </body>
</html>