<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <h2 class="text-2xl font-bold text-slate-900 text-center mb-6">Daftar Akun Baru</h2>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-slate-700">Nama Lengkap</label>
            <input id="name" class="block mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-600 text-xs" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-slate-700">Email</label>
            <input id="email" class="block mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-xs" />
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block font-medium text-sm text-slate-700">Role</label>
            <select id="role" name="role" required class="block mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>- Pilih Role -</option>
                <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>1 - Engineering & Estimator</option>
                <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>2 - Admin Produksi</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-1 text-red-600 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-slate-700">Password</label>
            <input id="password" class="block mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-medium text-sm text-slate-700">Konfirmasi Password</label>
            <input id="password_confirmation" class="block mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-600 text-xs" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors uppercase tracking-wider">
                Register
            </button>
        </div>
        
        <p class="mt-4 text-center text-sm text-slate-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-500 transition-colors">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
