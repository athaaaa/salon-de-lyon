<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Salon De Lyon</title>
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
                        brown: {
                            950: '#2b1710',
                            900: '#3d2314',
                            800: '#4a2c1a',
                        },
                        gold: {
                            600: '#a9702e',
                            700: '#8b5e26',
                        },
                    },
                },
            },
        };
    </script>
    <style>[x-cloak]{display:none!important}</style>
    @stack('styles')
</head>
<body class="bg-[#faf6ef] font-sans text-stone-800 antialiased">
<div class="flex min-h-screen">
    {{-- SIDEBAR --}}
    <aside class="w-64 bg-brown-950 text-stone-200 flex-shrink-0 hidden md:flex md:flex-col">
        <div class="flex items-center gap-3 px-5 py-6 border-b border-white/10">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="w-9 h-9 rounded-full object-cover bg-white">
            <div>
                <p class="font-serif text-sm tracking-wide leading-tight">DE LYON</p>
                <p class="text-[10px] uppercase tracking-widest text-gold-600">Beauty Salon</p>
            </div>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
            @php
                $menu = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard'],
                    ['route' => 'admin.reservations.index', 'label' => 'Reservasi', 'icon' => 'calendar'],
                    ['route' => 'admin.customers.index', 'label' => 'Customer', 'icon' => 'users'],
                    ['route' => 'admin.treatments.index', 'label' => 'Treatment', 'icon' => 'scissors'],
                    ['route' => 'admin.stylists.index', 'label' => 'Stylist', 'icon' => 'user'],
                    ['route' => 'admin.transactions.index', 'label' => 'Transaksi', 'icon' => 'card'],
                    ['route' => 'admin.reports.history', 'label' => 'Riwayat Treatment', 'icon' => 'clock'],
                    ['route' => 'admin.reports.index', 'label' => 'Laporan', 'icon' => 'chart'],
                    ['route' => 'admin.jadwal-stylist.index', 'label' => 'Jadwal Stylist', 'icon' => 'clipboard'],
                ];
            @endphp
            @foreach ($menu as $item)
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
                          {{ request()->routeIs($item['route'].'*') ? 'bg-gold-700/90 text-white' : 'hover:bg-white/5 text-stone-300' }}">
                    @include('partials.icon', ['name' => $item['icon'], 'class' => 'w-[18px] h-[18px] flex-shrink-0'])
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
        <div class="px-3 py-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-lg text-stone-300 hover:bg-white/5 text-sm">
                    @include('partials.icon', ['name' => 'logout', 'class' => 'w-[18px] h-[18px]'])
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-stone-200 px-4 md:px-8 py-3 flex items-center justify-between">
            <h1 class="font-serif text-lg text-stone-800">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-gold-700 text-white flex items-center justify-center text-sm font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="text-sm hidden sm:block">
                    <p class="font-medium leading-tight">{{ auth()->user()->name ?? '-' }}</p>
                    <p class="text-xs text-stone-500 capitalize">{{ auth()->user()->role ?? '' }}</p>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-8">
            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
