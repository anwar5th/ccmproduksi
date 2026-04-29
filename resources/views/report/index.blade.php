<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Laporan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    
                    <!-- Filters -->
                    <form action="{{ route('report.index') }}" method="GET" class="w-full mt-4 sm:mt-0">
                        <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-2 w-full">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Nama PO</label>
                                <input name="po" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari nama PO..." value="{{ request('po') }}">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Kode PO</label>
                                <input name="kodepo" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari nama PO..." value="{{ request('kodepo') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Tgl PO dari</label>
                                <input name="tglpo_from" type="date" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none sm:text-sm" value="{{ request('tglpo_from') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">sampai</label>
                                <input name="tglpo_to" type="date" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none sm:text-sm" value="{{ request('tglpo_to') }}">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-2 w-full mt-2">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1">No SPK</label>
                                <input name="nospk" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari No SPK..." value="{{ request('nospk') }}">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Nama Barang</label>
                                <input name="namabarang" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari nama barang..." value="{{ request('namabarang') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Tgl SPK dari</label>
                                <input name="tglspk_from" type="date" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none sm:text-sm" value="{{ request('tglspk_from') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">sampai</label>
                                <input name="tglspk_to" type="date" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none sm:text-sm" value="{{ request('tglspk_to') }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-2 w-full mt-2">
                            <div class="sm:col-span-6 flex items-end justify-end gap-2">
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white hover:bg-emerald-700 rounded-md text-sm font-semibold">Cari</button>
                                <a href="{{ route('report.index', ['perPage' => request('perPage', 10)]) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-md text-sm font-semibold">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Nama PO</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Kode PO</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Tanggal PO</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">No SPK</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Tanggal SPK</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Nama Barang</th>
                                <th scope="col" class="px-4 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Qty</th>

                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Tanggal Selesai</th>

                                <th scope="col" class="px-4 py-3 text-right font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>

                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Dibuat</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Diubah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($antrianmesin as $antri)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-4 py-4 whitespace-nowrap font-medium text-slate-900">
                                        {{ $antri->proyekorder->namaproyek }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap font-medium text-slate-900">
                                        {{ $antri->proyekorder->kodepo }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap font-medium text-slate-900">
                                        {{  $antri->proyekorder->tglpo ? \Carbon\Carbon::parse( $antri->proyekorder->tglpo)->format('d M Y H.i') : '-' }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-slate-600">
                                        {{ $antri->nospk }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-slate-600">
                                        {{ $antri->tglspk ? \Carbon\Carbon::parse($antri->tglspk)->format('d M Y H.i') : '-' }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-slate-900 truncate max-w-[150px]" title="{{ $antri->namabarang }}">
                                        {{ $antri->namabarang }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $antri->qtybarang <= 10 ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-emerald-100 text-emerald-700 border border-emerald-200' }}">
                                            {{ $antri->qtybarang }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-slate-600">
                                        {{ $antri->tglcompleted ? \Carbon\Carbon::parse($antri->tglcompleted)->format('d M Y H.i') : '-' }}
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-right font-medium">
                                        <a href="{{ route('report.show', $antri->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-md transition-colors text-xs font-semibold shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1">
                                                <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                                <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                            Detail
                                        </a>
                                    </td>

                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600">
                                        {{ $antri->created_at ? \Carbon\Carbon::parse($antri->created_at)->format('d M Y H.i') : '-' }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600">
                                        {{ $antri->updated_at ? \Carbon\Carbon::parse($antri->updated_at)->format('d M Y H.i') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="px-6 py-8 text-center text-slate-500 bg-slate-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                                            </svg>
                                            <span class="text-sm font-medium">Data Report belum tersedia.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 flex flex-col lg:flex-row items-center justify-end gap-4">
                    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto justify-center lg:justify-start">
                        <form action="{{ route('report.index') }}" method="GET" id="perPageForm" class="flex items-center gap-2">
                            <input type="hidden" name="po" value="{{ request('po') }}">
                            <input type="hidden" name="nospk" value="{{ request('nospk') }}">
                            <input type="hidden" name="namabarang" value="{{ request('namabarang') }}">
                            <input type="hidden" name="tglspk_from" value="{{ request('tglspk_from') }}">
                            <input type="hidden" name="tglspk_to" value="{{ request('tglspk_to') }}">
                            <input type="hidden" name="page" value="1">
                            <label for="perPage" class="text-sm font-medium text-slate-600">Tampilkan:</label>
                            @php $pp = (int) request('perPage', 10); @endphp
                            <select name="perPage" id="perPage" onchange="this.form.submit()" class="block w-20 pl-3 pr-8 py-1.5 text-sm border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm transition-shadow">
                                @foreach([5,10,25,50,100] as $opt)
                                    <option value="{{ $opt }}" {{ $pp == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                            <span class="text-sm text-slate-500">baris</span>
                        </form>
                        
                        @if($antrianmesin->lastPage() > 1)
                        <div class="h-5 w-px bg-slate-300 hidden sm:block"></div>
                        
                        <form action="{{ route('report.index') }}" method="GET" id="pageJumpForm" class="flex items-center gap-2">
                            <input type="hidden" name="po" value="{{ request('po') }}">
                            <input type="hidden" name="nospk" value="{{ request('nospk') }}">
                            <input type="hidden" name="namabarang" value="{{ request('namabarang') }}">
                            <input type="hidden" name="tglspk_from" value="{{ request('tglspk_from') }}">
                            <input type="hidden" name="tglspk_to" value="{{ request('tglspk_to') }}">
                            <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                            <label for="pageJump" class="text-sm font-medium text-slate-600 hidden sm:inline-block">Ke halaman:</label>
                            <select name="page" id="pageJump" onchange="this.form.submit()" class="block w-28 pl-3 pr-8 py-1.5 text-sm border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm transition-shadow">
                                @for ($i = 1; $i <= $antrianmesin->lastPage(); $i++)
                                    <option value="{{ $i }}" {{ $antrianmesin->currentPage() == $i ? 'selected' : '' }}>Hal {{ $i }} / {{ $antrianmesin->lastPage() }}</option>
                                @endfor
                            </select>
                        </form>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
