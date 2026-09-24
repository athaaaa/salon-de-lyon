<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Salon De Lyon')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brown: { 950: '#2b1710', 900: '#3d2314', 800: '#4a2c1a' },
                        gold: { 600: '#a9702e', 700: '#8b5e26' },
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-[#faf6ef] font-sans text-stone-800 antialiased">
<div class="max-w-md mx-auto min-h-screen bg-[#faf6ef] shadow-xl relative">

    @hasSection('back')
        <div class="flex items-center gap-3 px-4 pt-5 pb-2">
            <a href="@yield('back')" class="w-8 h-8 flex items-center justify-center rounded-full bg-white shadow text-stone-700">
                @include('partials.icon', ['name' => 'chevron-left', 'class' => 'w-4 h-4'])
            </a>
            <h1 class="font-serif text-base text-stone-800">@yield('title')</h1>
        </div>
    @endif

    @if (session('success'))
        <div class="mx-4 mt-3 rounded-lg bg-green-50 border border-green-200 text-green-800 px-3 py-2 text-xs">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mx-4 mt-3 rounded-lg bg-red-50 border border-red-200 text-red-800 px-3 py-2 text-xs">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- KONTEN UTAMA (Ditambah padding bawah pb-28 agar tidak tertutup nav) --}}
    <div class="pb-28">
        @yield('content')
    </div>

    {{-- BOTTOM NAV (Ditambah z-50 agar berada di lapisan paling depan) --}}
    <nav class="fixed bottom-0 left-0 right-0 z-50 max-w-md mx-auto bg-white border-t border-stone-200 flex items-center justify-around py-2.5 text-[11px] text-stone-400">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-brown-950 font-semibold' : '' }}">
            @include('partials.icon', ['name' => 'home', 'class' => 'w-5 h-5'])
            Beranda
        </a>
        <a href="{{ route('booking.treatments') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('booking.treatments*') ? 'text-brown-950 font-semibold' : '' }}">
            @include('partials.icon', ['name' => 'scissors', 'class' => 'w-5 h-5'])
            Treatment
        </a>
        <a href="{{ route('booking.status.form') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('booking.status*') ? 'text-brown-950 font-semibold' : '' }}">
            @include('partials.icon', ['name' => 'calendar', 'class' => 'w-5 h-5'])
            Booking
        </a>
        <a href="{{ route('booking.history') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('booking.history') ? 'text-brown-950 font-semibold' : '' }}">
            @include('partials.icon', ['name' => 'clock', 'class' => 'w-5 h-5'])
            Riwayat
        </a>
    </nav>
</div>
</body>
</html>