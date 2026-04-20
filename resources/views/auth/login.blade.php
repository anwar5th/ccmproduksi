<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <h2 class="text-2xl font-bold text-slate-900 text-center mb-6">Login ke Akun Anda</h2>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-slate-700">Email</label>
            <input id="email" class="block mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email anda..." />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-slate-700">Password</label>
            <input id="password" class="block mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500 cursor-pointer" name="remember">
                <span class="ml-2 text-sm text-slate-600">Ingat Saya</span>
            </label>
            
            <!-- @if (Route::has('password.request'))
                <a class="text-sm text-emerald-600 hover:text-emerald-500 font-medium transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif -->
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors uppercase tracking-wider">
                Masuk
            </button>
        </div>
        
        <!-- @if (Route::has('register'))
            <p class="mt-4 text-center text-sm text-slate-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-500 transition-colors">Daftar sekarang</a>
            </p>
        @endif -->
    </form>
</x-guest-layout>
