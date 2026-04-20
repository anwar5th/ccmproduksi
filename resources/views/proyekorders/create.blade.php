<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Buat Proyek Order (PO) Baru') }}
            </h2>
            <a href="{{ route('proyekorders.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 border border-transparent rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('proyekorders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Kode PO -->
                        <div>
                            <label for="kodepo" class="block text-sm font-semibold text-slate-700">Kode PO</label>
                            <input type="text" id="kodepo" name="kodepo" value="{{ old('kodepo') }}" minlength="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('kodepo') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                            @error('kodepo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Proyek -->
                        <div>
                            <label for="namaproyek" class="block text-sm font-semibold text-slate-700">Nama Proyek</label>
                            <input type="text" id="namaproyek" name="namaproyek" value="{{ old('namaproyek') }}" minlength="5" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('namaproyek') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                            @error('namaproyek')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal PO -->
                        <div>
                            <label for="tglpo" class="block text-sm font-semibold text-slate-700">Tanggal PO</label>
                            <input type="datetime-local" id="tglpo" name="tglpo" value="{{ old('tglpo') ? \Carbon\Carbon::parse(old('tglpo'))->format('Y-m-d\TH:i') : '' }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('tglpo') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                            @error('tglpo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="keteranganpoitem" class="block text-sm font-semibold text-slate-700">Keterangan List Item SPK</label>
                            <textarea id="keteranganpoitem" name="keteranganpoitem" rows="5" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('keteranganpoitem') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">{{ old('keteranganpoitem') }}</textarea>
                            @error('keteranganpoitem')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
                            <button type="submit" class="inline-flex justify-center rounded-lg border border-transparent bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors">
                                Simpan PO
                            </button>
                            <button type="reset" class="inline-flex justify-center rounded-lg border border-slate-300 bg-white px-6 py-2.5 text-sm font-bold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-colors">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
