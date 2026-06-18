<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BISA - BersihBersama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .grad-green {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
        }
        .text-grad-green {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased pb-20">

    <header class="grad-green text-white shadow-md sticky top-0 z-50">
        <div class="max-w-md mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="bg-white text-green-600 p-2 rounded-full w-10 h-10 flex items-center justify-center">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                </div>
                <h1 class="text-xl font-bold tracking-wide">BISA <span class="text-sm font-normal opacity-80 block -mt-1">BersihBersama</span></h1>
            </div>
            <div>
                <i class="fa-solid fa-bell text-xl"></i>
            </div>
        </div>
    </header>

    <main class="max-w-md mx-auto p-4">
        @yield('content')
    </main>

    <nav class="fixed bottom-0 w-full max-w-md mx-auto bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-50 left-1/2 -translate-x-1/2">
        <div class="flex justify-around items-center py-3">
            <button onclick="switchTab('beranda', this)" class="nav-btn text-green-600 flex flex-col items-center w-1/4">
                <i class="fa-solid fa-house text-xl mb-1"></i>
                <span class="text-[10px] font-semibold">Beranda</span>
            </button>
            <button onclick="switchTab('pengaduan', this)" class="nav-btn text-gray-400 hover:text-green-600 flex flex-col items-center w-1/4">
                <i class="fa-solid fa-comment-dots text-xl mb-1"></i>
                <span class="text-[10px] font-semibold">Aduan</span>
            </button>
            <button onclick="switchTab('lacak', this)" class="nav-btn text-gray-400 hover:text-green-600 flex flex-col items-center w-1/4">
                <i class="fa-solid fa-clock-rotate-left text-xl mb-1"></i>
                <span class="text-[10px] font-semibold">Lacak</span>
            </button>
            <button onclick="switchTab('komunitas', this)" class="nav-btn text-gray-400 hover:text-green-600 flex flex-col items-center w-1/4">
                <i class="fa-solid fa-users text-xl mb-1"></i>
                <span class="text-[10px] font-semibold">Komunitas</span>
            </button>
        </div>
    </nav>

    <script>
        function switchTab(tabId, btnElement) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById(tabId).classList.add('active');

            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('text-green-600');
                btn.classList.add('text-gray-400');
            });
            btnElement.classList.remove('text-gray-400');
            btnElement.classList.add('text-green-600');
            
            window.scrollTo(0, 0);
        }
    </script>
</body>
</html>