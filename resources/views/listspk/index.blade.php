<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Manajemen Stok / List SPK') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    
                    <!-- Filters -->
                    <form action="{{ route('listspk.index') }}" method="GET" class="w-full mt-4 sm:mt-0">
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
                                <a href="{{ route('listspk.index', ['perPage' => request('perPage', 10)]) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-md text-sm font-semibold">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama PO</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No SPK</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal SPK</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Barang</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Qty (Stok)</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-slate-500 bg-slate-50">
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
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 flex flex-col lg:flex-row items-center justify-end gap-4">
                    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto justify-center lg:justify-start">
                        <form action="{{ route('listspk.index') }}" method="GET" id="perPageForm" class="flex items-center gap-2">
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
                        
                        @if($listspk->lastPage() > 1)
                        <div class="h-5 w-px bg-slate-300 hidden sm:block"></div>
                        
                        <form action="{{ route('listspk.index') }}" method="GET" id="pageJumpForm" class="flex items-center gap-2">
                            <input type="hidden" name="po" value="{{ request('po') }}">
                            <input type="hidden" name="nospk" value="{{ request('nospk') }}">
                            <input type="hidden" name="namabarang" value="{{ request('namabarang') }}">
                            <input type="hidden" name="tglspk_from" value="{{ request('tglspk_from') }}">
                            <input type="hidden" name="tglspk_to" value="{{ request('tglspk_to') }}">
                            <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                            <label for="pageJump" class="text-sm font-medium text-slate-600 hidden sm:inline-block">Ke halaman:</label>
                            <select name="page" id="pageJump" onchange="this.form.submit()" class="block w-28 pl-3 pr-8 py-1.5 text-sm border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm transition-shadow">
                                @for ($i = 1; $i <= $listspk->lastPage(); $i++)
                                    <option value="{{ $i }}" {{ $listspk->currentPage() == $i ? 'selected' : '' }}>Hal {{ $i }} / {{ $listspk->lastPage() }}</option>
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
