<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BISA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] flex items-center justify-center min-h-screen p-4 font-sans antialiased">
    
    <!-- CARD LOGIN CONTAINER -->
    <div class="w-full max-w-sm bg-white rounded-2xl border border-gray-200 p-8 shadow-xl">
        
        {{-- Area Logo & Judul Aplikasi --}}
        <div class="flex flex-col items-center mb-6 text-center">
            <div class="w-12 h-12 bg-[#1a8e5f] rounded-xl flex items-center justify-center mb-4 shadow-md select-none">
                <i class="fa-solid fa-leaf text-white text-2xl"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-900 mb-1 tracking-tight">BISA</h1>
            <p class="text-slate-500 text-xs font-semibold">Silakan masuk ke akun Anda</p>
        </div>

        {{-- Form Login Utama --}}
        <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Input Email --}}
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5 select-none">Email</label>
                <input type="email" name="email" required value="{{ old('email') }}" placeholder="user@example.com" 
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-[#1a8e5f] focus:ring-2 focus:ring-[#1a8e5f]/20 bg-slate-50 outline-none transition font-medium">
                @error('email')
                    <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5 select-none">Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-[#1a8e5f] focus:ring-2 focus:ring-[#1a8e5f]/20 bg-slate-50 outline-none transition font-medium">
                @error('password')
                    <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Submit Masuk --}}
            <button type="submit" class="w-full bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl shadow-sm transition mt-6 cursor-pointer text-sm tracking-wide select-none">
                Masuk
            </button>
        </form>

        {{-- Link Pindah ke Halaman Daftar Akun --}}
        <p class="text-center text-xs md:text-sm text-slate-600 mt-6 select-none font-medium">
            Belum punya akun? <a href="{{ route('register') }}" class="text-[#1a8e5f] font-bold hover:underline ml-0.5 transition">Daftar di sini</a>
        </p>

    </div>

</body>
</html>