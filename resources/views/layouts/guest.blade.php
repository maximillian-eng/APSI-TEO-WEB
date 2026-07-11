<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Perpustakaan') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700;playfair+display:700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-display { font-family: 'Playfair Display', serif; }
        .font-body { font-family: 'Inter', sans-serif; }
        .bookshelf-pattern {
            background-image:
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .float-book { animation: floatBook 6s ease-in-out infinite; }
        .float-book-delay { animation: floatBook 6s ease-in-out 2s infinite; }
        .float-book-delay2 { animation: floatBook 6s ease-in-out 4s infinite; }
        @keyframes floatBook {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(2deg); }
        }
    </style>
</head>
<body class="font-body antialiased">
    <div class="min-h-screen flex">
        {{-- Left decorative panel --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-amber-900 via-amber-800 to-amber-950 bookshelf-pattern">
            {{-- Decorative floating books --}}
            <div class="absolute top-20 left-16 float-book">
                <div class="w-16 h-22 bg-gradient-to-b from-rose-400 to-rose-600 rounded-sm shadow-lg transform rotate-6" style="height: 5.5rem;"></div>
            </div>
            <div class="absolute top-40 left-40 float-book-delay">
                <div class="w-14 h-20 bg-gradient-to-b from-emerald-400 to-emerald-600 rounded-sm shadow-lg transform -rotate-3" style="height: 5rem;"></div>
            </div>
            <div class="absolute bottom-32 left-24 float-book-delay2">
                <div class="w-12 h-18 bg-gradient-to-b from-sky-400 to-sky-600 rounded-sm shadow-lg transform rotate-12" style="height: 4.5rem;"></div>
            </div>
            <div class="absolute top-32 right-20 float-book-delay2">
                <div class="w-10 h-16 bg-gradient-to-b from-violet-400 to-violet-600 rounded-sm shadow-lg transform -rotate-6" style="height: 4rem;"></div>
            </div>
            <div class="absolute bottom-48 right-32 float-book">
                <div class="w-14 h-20 bg-gradient-to-b from-amber-300 to-amber-500 rounded-sm shadow-lg transform rotate-3" style="height: 5rem;"></div>
            </div>

            {{-- Center content --}}
            <div class="relative z-10 flex flex-col justify-center items-center w-full px-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-2xl bg-amber-700/50 backdrop-blur-sm mb-8 shadow-2xl">
                        <svg class="w-12 h-12 text-amber-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h1 class="font-display text-4xl font-bold text-amber-50 mb-4">Perpustakaan</h1>
                    <p class="text-amber-200/80 text-lg max-w-sm mx-auto leading-relaxed">
                        Sistem manajemen perpustakaan digital untuk mengelola buku, peminjaman, dan anggota.
                    </p>
                </div>

                <div class="mt-16 grid grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-3xl font-bold text-amber-100">150+</div>
                        <div class="text-amber-300/60 text-sm mt-1">Buku</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-amber-100">50+</div>
                        <div class="text-amber-300/60 text-sm mt-1">Anggota</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-amber-100">24/7</div>
                        <div class="text-amber-300/60 text-sm mt-1">Akses</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right form panel --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-gray-50 dark:bg-gray-900">
            <div class="w-full max-w-md">
                {{-- Mobile logo --}}
                <div class="lg:hidden flex items-center justify-center mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-amber-800 shadow-lg">
                        <svg class="w-7 h-7 text-amber-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h2 class="font-display text-3xl font-bold text-gray-900 dark:text-white">Selamat Datang</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Masuk ke akun perpustakaan Anda</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700/50 p-8">
                    {{ $slot }}
                </div>

                <p class="text-center text-gray-400 dark:text-gray-500 text-xs mt-8">
                    &copy; {{ date('Y') }} Sistem Perpustakaan. Hak cipta dilindungi.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
