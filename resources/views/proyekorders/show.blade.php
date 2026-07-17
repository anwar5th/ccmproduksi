<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Buat Surat Perintah Kerja (SPK)') }}
            </h2>
            <a href="{{ route('proyekorders.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 border border-transparent rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Detail PO Card -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-900">Informasi Proyek Order</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Kode Proyek Order</p>
                            <p class="text-base font-bold text-slate-900">{{ $proyekorders->kodepo }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Nama Proyek Order</p>
                            <p class="text-base font-bold text-slate-900">{{ $proyekorders->namaproyek }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Tanggal Proyek Order</p>
                            <p class="text-base font-bold text-slate-900">{{ $proyekorders->tglpo ? \Carbon\Carbon::parse($proyekorders->tglpo)->format('d M Y H.i') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form SPK Card -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-900">Input Data SPK & Antrian Mesin</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('antrianmesin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- Hidden / Readonly PO ID -->
                        <div class="hidden">
                            <input type="hidden" name="proyekorders_id" value="{{ $proyekorders->id }}">
                        </div>

                        <!-- Basic SPK Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="nospk" class="block text-sm font-semibold text-slate-700">No SPK</label>
                                <input type="text" id="nospk" name="nospk" value="{{ old('nospk') }}" minlength="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('nospk') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('nospk')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tglspk" class="block text-sm font-semibold text-slate-700">Tanggal SPK</label>
                                <input type="datetime-local" id="tglspk" name="tglspk" value="{{ old('tglspk') ? \Carbon\Carbon::parse(old('tglspk'))->format('Y-m-d\TH:i') : '' }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('tglspk') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('tglspk')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="deadline" class="block text-sm font-semibold text-slate-700">Deadline</label>
                                <input type="date" id="deadline" name="deadline" value="{{ old('deadline') ? \Carbon\Carbon::parse(old('deadline'))->format('Y-m-d') : '' }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('deadline') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('deadline')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="prioritas" class="block text-sm font-semibold text-slate-700">Prioritas (Angka)</label>
                                <input type="number" id="prioritas" name="prioritas" value="{{ old('prioritas') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('prioritas') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}" placeholder="Contoh: 1">
                                @error('prioritas')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="namabarang" class="block text-sm font-semibold text-slate-700">Nama Barang</label>
                                <input type="text" id="namabarang" name="namabarang" value="{{ old('namabarang') }}" minlength="5" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('namabarang') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('namabarang')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="qtybarang" class="block text-sm font-semibold text-slate-700">Quantity (Qty)</label>
                                <input type="number" id="qtybarang" name="qtybarang" value="{{ old('qtybarang') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('qtybarang') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('qtybarang')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-slate-200">
                            <button type="submit" class="inline-flex justify-center rounded-lg border border-transparent bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors">
                                Simpan SPK
                            </button>
                            <button type="reset" class="inline-flex justify-center rounded-lg border border-slate-300 bg-white px-6 py-2.5 text-sm font-bold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-colors">
                                Reset
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-900">List SPK</h3>
                </div>
                <div>
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama PO</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No SPK</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal SPK</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Barang</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Qty (Stok)</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Dibuat</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Diubah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($listspk as $spk)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-900">
                                    {{ $spk->proyekorder->namaproyek }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600">
                                    {{ $spk->nospk }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600">
                                    {{ $spk->tglspk ? \Carbon\Carbon::parse($spk->tglspk)->format('d M Y H.i') : '-' }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-900">
                                    {{ $spk->namabarang }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-center text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $spk->qtybarang <= 10 ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-emerald-100 text-emerald-700 border border-emerald-200' }}">
                                        {{ $spk->qtybarang }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-center text-sm">
                                    @if ($spk->tglcompleted)
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">Selesai</span>
                                    @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm animate-pulse">Proses</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('listspk.destroy', $spk->id) }}" method="POST" class="inline-flex items-center gap-2">
                                        <a href="{{ route('listspk.edit', $spk->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-md transition-colors text-sm font-semibold shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1">
                                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                            </svg>
                                            Update
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600">
                                    {{ $spk->created_at ? \Carbon\Carbon::parse($spk->created_at)->format('d M Y H.i') : '-' }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600">
                                    {{ $spk->updated_at ? \Carbon\Carbon::parse($spk->updated_at)->format('d M Y H.i') : '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-slate-500 bg-slate-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                        <span class="text-sm font-medium">Data SPK belum tersedia.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>