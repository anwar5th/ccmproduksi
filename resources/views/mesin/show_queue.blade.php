<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('Antrian Mesin: ') }} {{ $mesin->nama_mesin }}
            </h2>
            <a href="{{ route('antrianmesin.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 border border-transparent rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Kembali ke Ringkasan
            </a>
        </div>
    </x-slot>

    <div class="py-8" x-data="{ openEditModal: false, editRoute: '', nospk: '', namabarang: '', nomor_antrian: 0, status_antrian: 'menunggu', waktu_masuk: '', waktu_selesai: '', keterangan: '' }">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            
            <!-- Filters -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden mb-6">
                <div class="p-6">
                    <form action="{{ route('antrian.mesin.show', $mesin->id) }}" method="GET">
                        <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-2 w-full">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-slate-655 mb-1">Nama PO</label>
                                <input name="po" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari nama PO..." value="{{ request('po') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-655 mb-1">No SPK</label>
                                <input name="nospk" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari No SPK..." value="{{ request('nospk') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-655 mb-1">Nama Barang</label>
                                <input name="namabarang" type="text" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari nama barang..." value="{{ request('namabarang') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-655 mb-1">Tgl SPK dari</label>
                                <input name="tglspk_from" type="date" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none sm:text-sm" value="{{ request('tglspk_from') }}">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-xs font-semibold text-slate-655 mb-1">sampai</label>
                                <input name="tglspk_to" type="date" class="block w-full pl-3 pr-3 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none sm:text-sm" value="{{ request('tglspk_to') }}">
                            </div>

                            <div class="sm:col-span-6 flex items-end justify-end gap-2">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white hover:bg-emerald-700 rounded-lg text-sm font-semibold transition shadow-sm">Cari</button>
                                <a href="{{ route('antrian.mesin.show', $mesin->id, ['perPage' => request('perPage', 10)]) }}" class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-lg text-sm font-semibold transition border border-slate-250">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Queue Table Card -->
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-slate-200 text-xs" style="min-width: 1200px;">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">No Urut</th>
                                <th scope="col" class="px-3 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Nama PO</th>
                                <th scope="col" class="px-3 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">No SPK</th>
                                <th scope="col" class="px-3 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Deadline</th>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Prioritas</th>
                                <th scope="col" class="px-3 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Nama Barang</th>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Qty</th>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-3 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Mulai</th>
                                <th scope="col" class="px-3 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Keluar</th>
                                <th scope="col" class="px-3 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Keterangan</th>
                                <th scope="col" class="px-3 py-3 text-right font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($antrian as $row)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-3 py-3 whitespace-nowrap text-center font-bold text-slate-800 text-sm">
                                        {{ $row->nomor_antrian ?? 0 }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-slate-900 font-medium">
                                        {{ $row->antrianmesin->proyekorder->namaproyek ?? '-' }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-slate-600 font-mono">
                                        {{ $row->antrianmesin->nospk }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-slate-600">
                                        {{ $row->antrianmesin->deadline ? \Carbon\Carbon::parse($row->antrianmesin->deadline)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-center">
                                        @if($row->antrianmesin->deadline && \Carbon\Carbon::parse($row->antrianmesin->deadline)->startOfDay()->lte(now()->addDays(2)->startOfDay()))
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-700 border border-red-200 animate-pulse" title="Prioritas H-2">
                                                1 (H-2)
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-bold {{ $row->antrianmesin->prioritas == 1 ? 'bg-red-100 text-red-700 border border-red-200' : ($row->antrianmesin->prioritas ? 'bg-blue-100 text-blue-700 border border-blue-200' : 'bg-slate-100 text-slate-600') }}">
                                                {{ $row->antrianmesin->prioritas ?? '-' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-slate-900 truncate max-w-[130px]" title="{{ $row->antrianmesin->namabarang }}">
                                        {{ $row->antrianmesin->namabarang }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-center font-semibold text-slate-700">
                                        {{ $row->antrianmesin->qtybarang }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold {{ $row->status_antrian == 'selst' || $row->status_antrian == 'selesai' ? 'bg-emerald-100 text-emerald-850 border border-emerald-200' : ($row->status_antrian == 'diproses' ? 'bg-amber-100 text-amber-850 border border-amber-200 shadow-sm animate-pulse' : 'bg-slate-100 text-slate-600 border border-slate-200') }}">
                                            {{ ucfirst($row->status_antrian) }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-slate-600">
                                        {{ $row->waktu_masuk ? \Carbon\Carbon::parse($row->waktu_masuk)->format('d M Y H.i') : '-' }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-slate-600">
                                        {{ $row->waktu_selesai ? \Carbon\Carbon::parse($row->waktu_selesai)->format('d M Y H.i') : '-' }}
                                    </td>
                                    <td class="px-3 py-3 text-slate-500 truncate max-w-[150px]" title="{{ $row->keterangan }}">
                                        {{ $row->keterangan ?? '-' }}
                                    </td>
                                    <td class="px-3 py-3 whitespace-nowrap text-right font-medium">
                                        <button @click="
                                            editRoute = '{{ route('antrian.mesin.update', [$mesin->id, $row->id]) }}';
                                            nospk = '{{ $row->antrianmesin->nospk }}';
                                            namabarang = '{{ $row->antrianmesin->namabarang }}';
                                            nomor_antrian = {{ $row->nomor_antrian ?? 0 }};
                                            status_antrian = '{{ $row->status_antrian }}';
                                            waktu_masuk = '{{ $row->waktu_masuk ? \Carbon\Carbon::parse($row->waktu_masuk)->format('Y-m-d\TH:i') : '' }}';
                                            waktu_selesai = '{{ $row->waktu_selesai ? \Carbon\Carbon::parse($row->waktu_selesai)->format('Y-m-d\TH:i') : '' }}';
                                            keterangan = '{{ addslashes($row->keterangan) }}';
                                            openEditModal = true;
                                        " class="inline-flex items-center px-2 py-1 bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200 rounded transition text-[10px] font-bold shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5 mr-0.5">
                                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                            </svg>
                                            Kelola
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="px-6 py-8 text-center text-slate-500 bg-slate-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                                            </svg>
                                            <span class="text-sm font-medium">Belum ada antrian aktif di mesin ini.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Footer Pagination -->
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 flex flex-col lg:flex-row items-center justify-end gap-4">
                    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto justify-center lg:justify-start">
                        <form action="{{ route('antrian.mesin.show', $mesin->id) }}" method="GET" id="perPageForm" class="flex items-center gap-2">
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
                        
                        @if($antrian->lastPage() > 1)
                        <div class="h-5 w-px bg-slate-300 hidden sm:block"></div>
                        
                        <form action="{{ route('antrian.mesin.show', $mesin->id) }}" method="GET" id="pageJumpForm" class="flex items-center gap-2">
                            <input type="hidden" name="po" value="{{ request('po') }}">
                            <input type="hidden" name="nospk" value="{{ request('nospk') }}">
                            <input type="hidden" name="namabarang" value="{{ request('namabarang') }}">
                            <input type="hidden" name="tglspk_from" value="{{ request('tglspk_from') }}">
                            <input type="hidden" name="tglspk_to" value="{{ request('tglspk_to') }}">
                            <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                            <label for="pageJump" class="text-sm font-medium text-slate-600 hidden sm:inline-block">Ke halaman:</label>
                            <select name="page" id="pageJump" onchange="this.form.submit()" class="block w-28 pl-3 pr-8 py-1.5 text-sm border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm transition-shadow">
                                @for ($i = 1; $i <= $antrian->lastPage(); $i++)
                                    <option value="{{ $i }}" {{ $antrian->currentPage() == $i ? 'selected' : '' }}>Hal {{ $i }} / {{ $antrian->lastPage() }}</option>
                                @endfor
                            </select>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal Edit Queue Status (AlpineJS controlled) -->
        <div id="editQueueModal" class="fixed inset-0 z-50 overflow-y-auto" x-show="openEditModal" style="display: none;">
            <!-- Dark overlay -->
            <div class="fixed inset-0 bg-slate-900 bg-opacity-50 transition-opacity backdrop-blur-sm" @click="openEditModal = false"></div>

            <div class="relative flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                     @click.away="openEditModal = false">
                    
                    <form :action="editRoute" method="POST">
                        @csrf
                        
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="flex items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-amber-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg font-bold text-slate-900 mb-1" id="modal-title">Kelola Antrian SPK</h3>
                                    <p class="text-xs text-slate-500 mb-4">
                                        SPK: <span class="font-bold text-slate-800" x-text="nospk"></span> - <span x-text="namabarang"></span>
                                    </p>

                                    <div class="space-y-4">
                                        <div>
                                            <label for="nomor_antrian" class="block text-xs font-semibold text-slate-700">Nomor Urut Antrian</label>
                                            <input type="number" name="nomor_antrian" id="nomor_antrian" x-model="nomor_antrian" required min="0" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>

                                        <div>
                                            <label for="status_antrian" class="block text-xs font-semibold text-slate-700">Status Antrian</label>
                                            <select name="status_antrian" id="status_antrian" x-model="status_antrian" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                                <option value="menunggu">Menunggu</option>
                                                <option value="diproses">Diproses</option>
                                                <option value="selesai">Selesai</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="waktu_masuk" class="block text-xs font-semibold text-slate-700">Tanggal & Jam Mulai (Waktu Masuk)</label>
                                            <input type="datetime-local" name="waktu_masuk" id="waktu_masuk" x-model="waktu_masuk" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>

                                        <div>
                                            <label for="waktu_selesai" class="block text-xs font-semibold text-slate-700">Tanggal &amp; Jam Keluar (Waktu Keluar)</label>
                                            <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" x-model="waktu_selesai" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>

                                        <div>
                                            <label for="keterangan" class="block text-xs font-semibold text-slate-700">Keterangan / Catatan</label>
                                            <textarea name="keterangan" id="keterangan" x-model="keterangan" rows="2" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Catatan tambahan..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 sm:ml-3 sm:w-auto transition">
                                Simpan Perubahan
                            </button>
                            <button type="button" @click="openEditModal = false" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
