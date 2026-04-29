<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Detail Laporan') }}
            </h2>
            <a href="{{ route('report.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 border border-transparent rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Summary Card -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Informasi SPK & Proyek</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $antrianmesin->qtybarang <= 10 ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                        Qty: {{ $antrianmesin->qtybarang }}
                    </span>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Kode PO</p>
                            <p class="text-sm font-bold text-slate-900">{{ $antrianmesin->proyekorder->kodepo ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nama Proyek</p>
                            <p class="text-sm font-bold text-slate-900">{{ $antrianmesin->proyekorder->namaproyek ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nomor SPK</p>
                            <p class="text-sm font-bold text-slate-900">{{ $antrianmesin->nospk }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal Turun SPK</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $antrianmesin->tglspk ? \Carbon\Carbon::parse($antrianmesin->tglspk)->format('d M Y H.i') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nama Barang</p>
                            <p class="text-sm font-bold text-slate-900">{{ $antrianmesin->namabarang }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal Selesai</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $antrianmesin->tglcompleted ? \Carbon\Carbon::parse($antrianmesin->tglcompleted)->format('d M Y H.i') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Dibuat</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $antrianmesin->created_at ? \Carbon\Carbon::parse($antrianmesin->created_at)->format('d M Y H.i') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Diubah</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $antrianmesin->updated_at ? \Carbon\Carbon::parse($antrianmesin->updated_at)->format('d M Y H.i') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Machine Queue Status -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-900">Laporan Antrian Mesin</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        
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
                            <div class="bg-white border border-slate-200 rounded-lg overflow-hidden flex flex-col md:flex-row">
                                <!-- Machine Name (Left) -->
                                <div class="bg-slate-100 px-6 py-4 md:w-48 flex items-center border-b md:border-b-0 md:border-r border-slate-200">
                                    <span class="font-bold text-slate-800">{{ $machine['name'] }}</span>
                                </div>
                                
                                <!-- Status Content (Right) -->
                                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-100">
                                    
                                    <!-- Tanggal Masuk -->
                                    <div class="px-4 py-3 bg-white">
                                        <p class="text-xs font-semibold text-slate-500 mb-1">Tanggal Masuk</p>
                                        @if($antrianmesin->{'tglm'.$machine['id']})
                                            <p class="text-sm font-medium text-amber-700 bg-amber-50 inline-block px-2 py-0.5 rounded border border-amber-200">
                                                {{ \Carbon\Carbon::parse($antrianmesin->{'tglm'.$machine['id']})->format('d M Y H.i') }}
                                            </p>
                                        @else
                                            <p class="text-sm text-slate-400">-</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Tanggal Keluar -->
                                    <div class="px-4 py-3 bg-white">
                                        <p class="text-xs font-semibold text-slate-500 mb-1">Tanggal Selesai</p>
                                        @if($antrianmesin->{'tglk'.$machine['id']})
                                            <p class="text-sm font-medium text-emerald-700 bg-emerald-50 inline-block px-2 py-0.5 rounded border border-emerald-200">
                                                {{ \Carbon\Carbon::parse($antrianmesin->{'tglk'.$machine['id']})->format('d M Y H.i') }}
                                            </p>
                                        @else
                                            <p class="text-sm text-slate-400">-</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Keterangan -->
                                    <div class="px-4 py-3 bg-white md:col-span-1">
                                        <p class="text-xs font-semibold text-slate-500 mb-1">Keterangan</p>
                                        @if($antrianmesin->{'ket'.$machine['id']})
                                            <p class="text-sm text-slate-700 break-words">{{ $antrianmesin->{'ket'.$machine['id']} }}</p>
                                        @else
                                            <p class="text-sm text-slate-400 italic">Tidak ada keterangan</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
