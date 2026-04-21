<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Proyek Orders / PO') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="pt-6 pr-6 flex items-center justify-end gap-4">
                    <a href="{{ route('proyekorders.create')}}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        PO Baru
                    </a>
                </div>
                <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    
                    <!-- Filters -->
                    <form action="{{ route('proyekorders.index') }}" method="GET" class="w-full mt-4 sm:mt-0">
                        <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-2 w-full">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Nama PO</label>
                                <input name="po" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari nama PO..." value="{{ request('po') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">No SPK</label>
                                <input name="nospk" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari No SPK..." value="{{ request('nospk') }}">
                            </div>

                            <div class="sm:col-span-1">
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

                            <div class="sm:col-span-6 flex items-end justify-end gap-2 mt-2 sm:mt-0">
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white hover:bg-emerald-700 rounded-md text-sm font-semibold">Cari</button>
                                <a href="{{ route('proyekorders.index', ['perPage' => request('perPage', 10)]) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-md text-sm font-semibold">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kode PO</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama PO</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal PO</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">List Item SPK</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($proyekorders as $po)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-slate-900">
                                        {{ $po->kodepo }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-900">
                                        {{ $po->namaproyek }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-600">
                                        {{ $po->tglpo ? \Carbon\Carbon::parse($po->tglpo)->format('d M Y H.i') : '-' }}
                                    </td>
                                    <td class="px-6 py-5 text-sm text-slate-600 break-all max-w-md prose prose-sm prose-slate">
                                        {!! $po->keteranganpoitem !!}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('proyekorders.destroy', $po->id) }}" method="POST" class="inline-flex items-center gap-2">
                                            
                                            <a href="{{ route('proyekorders.show', $po->id) }}" class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 rounded-md transition-colors text-sm font-semibold shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1">
                                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                </svg>
                                                Buat SPK
                                            </a>
                                            
                                            <a href="{{ route('proyekorders.edit', $po->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-md transition-colors text-sm font-semibold shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1">
                                                    <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                </svg>
                                                Ubah
                                            </a>
                                            
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-slate-500 bg-slate-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                            </svg>
                                            <span class="text-sm font-medium">Data PO belum tersedia.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 flex flex-col lg:flex-row items-center justify-end gap-4">
                    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto justify-center lg:justify-start">
                        <form action="{{ route('proyekorders.index') }}" method="GET" id="perPageForm" class="flex items-center gap-2">
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
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

                        @if($proyekorders->lastPage() > 1)
                        <div class="h-5 w-px bg-slate-300 hidden sm:block"></div>
                        <form action="{{ route('proyekorders.index') }}" method="GET" id="pageJumpForm" class="flex items-center gap-2">
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                            <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                            <label for="pageJump" class="text-sm font-medium text-slate-600 hidden sm:inline-block">Ke halaman:</label>
                            <select name="page" id="pageJump" onchange="this.form.submit()" class="block w-28 pl-3 pr-8 py-1.5 text-sm border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm transition-shadow">
                                @for ($i = 1; $i <= $proyekorders->lastPage(); $i++)
                                    <option value="{{ $i }}" {{ $proyekorders->currentPage() == $i ? 'selected' : '' }}>Hal {{ $i }} / {{ $proyekorders->lastPage() }}</option>
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
