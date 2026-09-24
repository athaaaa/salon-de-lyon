<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Admin Salon De Lyon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: {
            fontFamily: { serif: ['"Playfair Display"', 'serif'], sans: ['Inter', 'sans-serif'] },
            colors: { brown: { 950: '#2b1710' }, gold: { 700: '#8b5e26' } },
        } } };
    </script>
</head>
<body class="font-sans bg-[#faf6ef] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden grid md:grid-cols-2">
        <div class="hidden md:flex flex-col justify-end bg-brown-950 p-8 text-white relative"
             style="background-image:linear-gradient(rgba(20,10,5,.65),rgba(20,10,5,.75)),url('{{ asset('images/logo.jpeg') }}'); background-size:cover; background-position:center;">
            <img src="{{ asset('images/logo.jpeg') }}" class="w-20 h-20 rounded-full bg-white object-cover mb-4" alt="Logo">
            <p class="text-xs text-white/60">© {{ date('Y') }} Salon De Lyon. All rights reserved.</p>
        </div>

        <div class="p-8 md:p-10">
            <h1 class="font-serif text-2xl text-stone-800 mb-1">Selamat Datang Kembali</h1>
            <p class="text-sm text-stone-500 mb-6">Silakan login untuk masuk ke sistem</p>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full rounded-lg border border-stone-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-gold-700"
                           placeholder="Masukkan email">
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full rounded-lg border border-stone-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-gold-700"
                           placeholder="Masukkan password">
                </div>
                <label class="flex items-center gap-2 text-sm text-stone-600">
                    <input type="checkbox" name="remember" class="rounded"> Ingat saya
                </label>
                <button type="submit"
                        class="w-full bg-brown-950 hover:bg-gold-700 transition text-white py-2.5 rounded-lg font-medium">
                    Login
                </button>
            </form>

            <p class="text-xs text-stone-400 mt-6">
                Akun default (dari seeder): <br>
                <span class="font-mono">admin@salondelyon.test / password</span>
            </p>
        </div>
    </div>
</body>
</html>
