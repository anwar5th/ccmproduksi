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
                                <button onclick="openExportModal()" type="button" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Export Excel
                                </button>
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

    <!-- Modal Export Excel Tailwind -->
    <div id="exportModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Dark overlay dengan backdrop blur -->
        <div class="fixed inset-0 bg-slate-900 bg-opacity-50 transition-opacity backdrop-blur-sm" onclick="closeExportModal()"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                
                <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <form action="{{ route('report.export') }}" method="GET" id="exportForm">
                        
                        <!-- Bawa semua filter yang sudah ada di URL halaman saat ini -->
                        @foreach(request()->except(['tglcompleted_from', 'tglcompleted_to', 'page']) as $key => $value)
                            @if($value !== null)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg font-semibold leading-6 text-slate-900" id="modal-title">Export Laporan Produksi</h3>
                                    <div class="mt-2 text-sm text-slate-500 mb-4">
                                        <p>Tentukan rentang tanggal selesai untuk di-export. Kosongkan tanggal jika ingin mengekspor seluruh data (mengikuti filter yang sedang aktif).</p>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label for="tglcompleted_from" class="block text-sm font-medium text-slate-700">Tanggal Dari</label>
                                            <input type="date" name="tglcompleted_from" id="tglcompleted_from" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="tglcompleted_to" class="block text-sm font-medium text-slate-700">Tanggal Sampai</label>
                                            <input type="date" name="tglcompleted_to" id="tglcompleted_to" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit" onclick="closeExportModal()" class="inline-flex w-full justify-center rounded-lg bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 sm:ml-3 sm:w-auto transition-colors duration-200">
                                Export Excel
                            </button>
                            <button type="button" onclick="closeExportModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors duration-200">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }
        
        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }
    </script>

</x-app-layout>
