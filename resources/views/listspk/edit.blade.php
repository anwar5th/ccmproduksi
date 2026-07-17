<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Ubah Surat Perintah Kerja (SPK)') }}
            </h2>
            <a href="{{ route('listspk.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 border border-transparent rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                            <p class="text-base font-bold text-slate-900">{{ $proyekorders->kodepo ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Nama Proyek Order</p>
                            <p class="text-base font-bold text-slate-900">{{ $proyekorders->namaproyek ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Tanggal Proyek Order</p>
                            <p class="text-base font-bold text-slate-900">{{ isset($proyekorders->tglpo) && $proyekorders->tglpo ? \Carbon\Carbon::parse($proyekorders->tglpo)->format('d M Y H.i') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form SPK Card -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-900">Ubah Data SPK & Antrian Mesin</h3>
                    <p class="text-xs text-slate-500 mt-1">Termasuk data Dimensi & Drawing PDF untuk SPK ini.</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('listspk.update', $listspk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
                        <!-- Hidden PO ID -->
                        <div class="hidden">
                            <input type="hidden" name="proyekorders_id" value="{{ old('proyekorders_id', $listspk->proyekorders_id) }}">
                        </div>

                        <!-- Basic SPK Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="nospk" class="block text-sm font-semibold text-slate-700">No SPK</label>
                                <input type="text" id="nospk" name="nospk" value="{{ old('nospk', $listspk->nospk) }}" minlength="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('nospk') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('nospk')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="tglspk" class="block text-sm font-semibold text-slate-700">Tanggal SPK</label>
                                <input type="datetime-local" id="tglspk" name="tglspk" value="{{ old('tglspk') ? \Carbon\Carbon::parse(old('tglspk'))->format('Y-m-d\TH:i') : ($listspk->tglspk ? \Carbon\Carbon::parse($listspk->tglspk)->format('Y-m-d\TH:i') : '') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('tglspk') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('tglspk')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="deadline" class="block text-sm font-semibold text-slate-700">Deadline</label>
                                <input type="date" id="deadline" name="deadline" value="{{ old('deadline') ? \Carbon\Carbon::parse(old('deadline'))->format('Y-m-d') : ($listspk->deadline ? \Carbon\Carbon::parse($listspk->deadline)->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('deadline') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('deadline')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="prioritas" class="block text-sm font-semibold text-slate-700">Prioritas (Angka)</label>
                                <input type="number" id="prioritas" name="prioritas" value="{{ old('prioritas', $listspk->prioritas) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('prioritas') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}" placeholder="Contoh: 1">
                                @error('prioritas')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="namabarang" class="block text-sm font-semibold text-slate-700">Nama Barang</label>
                                <input type="text" id="namabarang" name="namabarang" value="{{ old('namabarang', $listspk->namabarang) }}" minlength="5" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('namabarang') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('namabarang')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="qtybarang" class="block text-sm font-semibold text-slate-700">Quantity (Qty)</label>
                                <input type="number" id="qtybarang" name="qtybarang" value="{{ old('qtybarang', $listspk->qtybarang) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('qtybarang') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('qtybarang')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="dimensi" class="block text-sm font-semibold text-slate-700">Dimensi</label>
                                <input type="text" id="dimensi" name="dimensi" value="{{ old('dimensi', $listspk->proyekorder->dimensi ?? '') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: 120x60x75 cm">
                                <p class="mt-1 text-xs text-slate-400">Dimensi akan disimpan pada data Proyek Order terkait.</p>
                            </div>

                        </div>

                        {{-- Drawing PDF --}}
                        <div class="border-t border-slate-200 pt-6">
                            <h4 class="text-md font-bold text-slate-800 mb-4 uppercase tracking-wider">Drawing PDF</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="drawing" class="block text-sm font-semibold text-slate-700">Upload Drawing (PDF)</label>
                                    <input type="file" id="drawing" name="drawing" accept="application/pdf" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-slate-300 rounded-md focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500">
                                    @error('drawing')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-700 mb-1">Drawing Saat Ini</p>
                                    @if($listspk->proyekorder && $listspk->proyekorder->drawing_path)
                                        <a href="{{ Storage::url($listspk->proyekorder->drawing_path) }}" target="_blank" class="inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700 hover:underline">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat Drawing PDF
                                        </a>
                                    @else
                                        <span class="text-sm text-slate-400 italic">Belum ada drawing PDF.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-slate-200 pt-6">
                            <div>
                                <label for="tglcompleted" class="block text-sm font-semibold text-slate-700">Tanggal Selesai</label>
                                <input type="datetime-local" id="tglcompleted" name="tglcompleted" value="{{ old('tglcompleted') ? \Carbon\Carbon::parse(old('tglcompleted'))->format('Y-m-d\TH:i') : ($listspk->tglcompleted ? \Carbon\Carbon::parse($listspk->tglcompleted)->format('Y-m-d\TH:i') : '') }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm {{ $errors->has('tglcompleted') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : '' }}">
                                @error('tglcompleted')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-6">
                            <h4 class="text-md font-bold text-slate-800 mb-4 uppercase tracking-wider">Jadwal Mesin</h4>
                            <div class="space-y-4">
                                
                                <!-- Helper Macro for Machine Rows -->
                                @php
                                    $activeMesins = \App\Models\Mesin::where('status', 'aktif')->orderBy('id', 'asc')->get();
                                @endphp

                                @foreach($activeMesins as $mesin)
                                    @php
                                        $code = preg_replace('/[^a-z0-9]/', '', strtolower($mesin->nama_mesin));
                                    @endphp
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-slate-50 p-4 rounded-lg border border-slate-200">
                                        <div class="md:col-span-2">
                                            <span class="font-bold text-slate-700">{{ $mesin->nama_mesin }}</span>
                                        </div>
                                        
                                        <div class="md:col-span-3">
                                            <label class="block text-xs font-semibold text-slate-500 mb-1">Tanggal Masuk</label>
                                            <input type="datetime-local" name="tglm{{ $code }}" value="{{ old('tglm'.$code) ? \Carbon\Carbon::parse(old('tglm'.$code))->format('Y-m-d\TH:i') : ($listspk->{'tglm'.$code} ? \Carbon\Carbon::parse($listspk->{'tglm'.$code})->format('Y-m-d\TH:i') : '') }}" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>
                                        
                                        <div class="md:col-span-3">
                                            <label class="block text-xs font-semibold text-slate-500 mb-1">Tanggal Keluar</label>
                                            <input type="datetime-local" name="tglk{{ $code }}" value="{{ old('tglk'.$code) ? \Carbon\Carbon::parse(old('tglk'.$code))->format('Y-m-d\TH:i') : ($listspk->{'tglk'.$code} ? \Carbon\Carbon::parse($listspk->{'tglk'.$code})->format('Y-m-d\TH:i') : '') }}" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>

                                        <div class="md:col-span-4">
                                            <label class="block text-xs font-semibold text-slate-500 mb-1">Keterangan</label>
                                            <input type="text" name="ket{{ $code }}" value="{{ old('ket'.$code, $listspk->{'ket'.$code}) }}" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Keterangan opsional...">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-slate-200">
                            <button type="submit" class="inline-flex justify-center rounded-lg border border-transparent bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>