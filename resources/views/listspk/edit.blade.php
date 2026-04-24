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
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                                    $machines = [
                                        ['id' => 'hotpress', 'name' => 'Hot Press'],
                                        ['id' => 'basic', 'name' => 'R.Saw / Basic'],
                                        ['id' => 'edging', 'name' => 'Edging'],
                                        ['id' => 'cnc', 'name' => 'CNC'],
                                        ['id' => 'tukang', 'name' => 'Tk. Kayu'],
                                        ['id' => 'finish', 'name' => 'Finishing'],
                                    ];
                                @endphp

                                @foreach($machines as $machine)
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-slate-50 p-4 rounded-lg border border-slate-200">
                                        <div class="md:col-span-2">
                                            <span class="font-bold text-slate-700">{{ $machine['name'] }}</span>
                                        </div>
                                        
                                        <div class="md:col-span-3">
                                            <label class="block text-xs font-semibold text-slate-500 mb-1">Tanggal Masuk</label>
                                            <input type="datetime-local" name="tglm{{ $machine['id'] }}" value="{{ old('tglm'.$machine['id']) ? \Carbon\Carbon::parse(old('tglm'.$machine['id']))->format('Y-m-d\TH:i') : ($listspk->{'tglm'.$machine['id']} ? \Carbon\Carbon::parse($listspk->{'tglm'.$machine['id']})->format('Y-m-d\TH:i') : '') }}" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>
                                        
                                        <div class="md:col-span-3">
                                            <label class="block text-xs font-semibold text-slate-500 mb-1">Tanggal Keluar</label>
                                            <input type="datetime-local" name="tglk{{ $machine['id'] }}" value="{{ old('tglk'.$machine['id']) ? \Carbon\Carbon::parse(old('tglk'.$machine['id']))->format('Y-m-d\TH:i') : ($listspk->{'tglk'.$machine['id']} ? \Carbon\Carbon::parse($listspk->{'tglk'.$machine['id']})->format('Y-m-d\TH:i') : '') }}" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>

                                        <div class="md:col-span-4">
                                            <label class="block text-xs font-semibold text-slate-500 mb-1">Keterangan</label>
                                            <input type="text" name="ket{{ $machine['id'] }}" value="{{ old('ket'.$machine['id'], $listspk->{'ket'.$machine['id']}) }}" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Keterangan opsional...">
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