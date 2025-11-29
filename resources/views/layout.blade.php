<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ ($appearance ?? 'system') == 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- 1. Dynamic Title: Child views can define their own title --}}
        <title>@yield('title', config('app.name', 'Laravel'))</title>

        {{-- Favicons --}}
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        {{-- 2. Styles: Load your global CSS/JS --}}
        {{-- You typically only need the entry point here, not specific page components --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- 3. Head Stack: Child views can push specific CSS or meta tags here --}}
        @stack('head')

        {{-- Dark Mode Script --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';
                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline Style for Background --}}
        <style>
            html { background-color: oklch(1 0 0); }
            html.dark { background-color: oklch(0.145 0 0); }
        </style>
    </head>
    <body class="font-sans antialiased">

        {{-- 4. Content Yield: This is where your individual pages will appear --}}
        <main>
            @yield('content')
        </main>

        {{-- 5. Scripts Stack: Child views can push custom JS to the bottom of the page --}}
        @stack('scripts')
        
    </body>
</html>