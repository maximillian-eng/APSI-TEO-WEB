<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="nama" class="block text-sm font-semibold mb-1.5" style="color: #d1d5db;">Nama Lengkap</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg style="color: #6b7280;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                </div>
                <input id="nama" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="name"
                       class="block w-full pl-11 pr-4 py-3 rounded-xl text-white transition-all duration-200"
                       style="background-color: #374151; border: 2px solid #4b5563; color: #ffffff;"
                       placeholder="Nama lengkap Anda">
            </div>
            @error('nama') <p class="text-sm mt-1.5 flex items-center gap-1" style="color: #f87171;"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold mb-1.5" style="color: #d1d5db;">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg style="color: #6b7280;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                       class="block w-full pl-11 pr-4 py-3 rounded-xl text-white transition-all duration-200"
                       style="background-color: #374151; border: 2px solid #4b5563; color: #ffffff;"
                       placeholder="anda@email.com">
            </div>
            @error('email') <p class="text-sm mt-1.5 flex items-center gap-1" style="color: #f87171;"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold mb-1.5" style="color: #d1d5db;">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg style="color: #6b7280;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="block w-full pl-11 pr-4 py-3 rounded-xl text-white transition-all duration-200"
                       style="background-color: #374151; border: 2px solid #4b5563; color: #ffffff;"
                       placeholder="Minimal 8 karakter">
            </div>
            @error('password') <p class="text-sm mt-1.5 flex items-center gap-1" style="color: #f87171;"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold mb-1.5" style="color: #d1d5db;">Konfirmasi Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg style="color: #6b7280;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="block w-full pl-11 pr-4 py-3 rounded-xl text-white transition-all duration-200"
                       style="background-color: #374151; border: 2px solid #4b5563; color: #ffffff;"
                       placeholder="Ulangi password">
            </div>
        </div>

        <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-3 px-4 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.01]"
                style="background: linear-gradient(to right, #b45309, #92400e);">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
            Daftar
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm" style="color: #9ca3af;">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold transition" style="color: #fbbf24;">Masuk</a>
        </p>
    </div>
</x-guest-layout>
