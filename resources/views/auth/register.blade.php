<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BiSa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] flex items-center justify-center min-h-screen p-4 font-sans antialiased">
    <div class="w-full max-w-sm bg-white rounded-2xl border border-gray-200 p-8 shadow-xl">
        <div class="flex flex-col items-center mb-6 text-center">
            <div class="w-12 h-12 bg-[#1a8e5f] rounded-xl flex items-center justify-center mb-4 shadow-md"><i class="fa-solid fa-leaf text-white text-2xl"></i></div>
            <h1 class="text-2xl font-bold text-slate-900 mb-1">Daftar Akun</h1>
        </div>

        <form action="{{ route('register.attempt') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-[#1a8e5f] focus:ring-2 focus:ring-[#1a8e5f]/20 bg-slate-50">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Nomor HP</label>
                <input type="tel" name="phone" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-[#1a8e5f] focus:ring-2 focus:ring-[#1a8e5f]/20 bg-slate-50">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-[#1a8e5f] focus:ring-2 focus:ring-[#1a8e5f]/20 bg-slate-50">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-[#1a8e5f] focus:ring-2 focus:ring-[#1a8e5f]/20 bg-slate-50">
            </div>
            <button type="submit" class="w-full bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow-sm transition mt-2">Daftar</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-6">Sudah punya akun? <a href="{{ route('login') }}" class="text-[#1a8e5f] font-bold hover:underline">Masuk</a></p>
    </div>
</body>
</html>