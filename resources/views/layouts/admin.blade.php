<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700;playfair+display:700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-display { font-family: 'Playfair Display', serif; }
        .sidebar-gradient { background: linear-gradient(180deg, #1e1b4b 0%, #312e81 50%, #1e1b4b 100%); }
        .sidebar-gradient-light { background: linear-gradient(180deg, #312e81 0%, #4338ca 50%, #312e81 100%); }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50">
    <div x-data="{ open: false }" class="min-h-screen flex">
        {{-- Mobile overlay --}}
        <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

        {{-- Sidebar --}}
        <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-72 sidebar-gradient transform transition-transform duration-300 ease-out lg:translate-x-0 lg:static lg:z-auto flex flex-col">
            {{-- Brand --}}
            <div class="flex items-center gap-3 h-16 px-6 border-b border-indigo-500/20">
                <div class="w-9 h-9 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <span class="font-display text-white font-bold text-lg leading-none block">Perpustakaan</span>
                    <span class="text-indigo-300/60 text-[10px] uppercase tracking-widest font-semibold">Admin Panel</span>
                </div>
                <button @click="open = false" class="lg:hidden ml-auto text-indigo-300 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'name' => 'Dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                        ['route' => 'admin.buku.index', 'name' => 'Kelola Buku', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>'],
                        ['route' => 'admin.anggota.index', 'name' => 'Anggota', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>'],
                        ['route' => 'admin.transaksi.index', 'name' => 'Transaksi', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>'],
                    ];
                @endphp

                <div class="px-3 mb-3">
                    <span class="text-[10px] uppercase tracking-widest text-indigo-300/50 font-semibold">Menu Utama</span>
                </div>

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs($item['route'] . '*') ? 'bg-white/15 text-white shadow-lg shadow-indigo-900/30' : 'text-indigo-200/70 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">{!! $item['icon'] !!}</svg>
                        {{ $item['name'] }}
                        @if(request()->routeIs($item['route'] . '*'))
                            <div class="ml-auto w-1.5 h-1.5 bg-amber-400 rounded-full"></div>
                        @endif
                    </a>
                @endforeach

                <div class="px-3 mt-6 mb-3">
                    <span class="text-[10px] uppercase tracking-widest text-indigo-300/50 font-semibold">Master Data</span>
                </div>

                @foreach([
                    ['route' => 'admin.kategori.index', 'name' => 'Kategori', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>'],
                    ['route' => 'admin.pengarang.index', 'name' => 'Pengarang', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>'],
                ] as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs($item['route'] . '*') ? 'bg-white/15 text-white shadow-lg shadow-indigo-900/30' : 'text-indigo-200/70 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">{!! $item['icon'] !!}</svg>
                        {{ $item['name'] }}
                        @if(request()->routeIs($item['route'] . '*'))
                            <div class="ml-auto w-1.5 h-1.5 bg-amber-400 rounded-full"></div>
                        @endif
                    </a>
                @endforeach
            </nav>

            {{-- User info --}}
            <div class="p-4 border-t border-indigo-500/20">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-lg shadow-amber-500/20">
                        {{ substr(auth()->user()->nama, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->nama }}</p>
                        <p class="text-xs text-indigo-300/50">Administrator</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-indigo-300/50 hover:text-white hover:bg-white/10 rounded-lg transition" title="Logout">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-h-screen min-w-0">
            {{-- Header --}}
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-4">
                        <button @click="open = true" class="lg:hidden p-2 -ml-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div>
                            <h1 class="text-lg font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-lg text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                            {{ now()->translatedFormat('l, d M Y') }}
                        </div>
                        <a href="{{ route('profile.edit') }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition" title="Profil">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </a>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl shadow-sm" x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition>
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 flex items-center gap-3 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl shadow-sm">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
