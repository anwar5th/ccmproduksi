<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-slate-900 leading-tight">
                {{ __('List Antrian Mesin') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h3 class="text-lg font-bold text-slate-900">Status Proses & Antrian Mesin</h3>
                    
                    <!-- Search -->
                    <form action="" method="GET" class="w-full sm:w-96 relative">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input name="keyword" type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition duration-150 ease-in-out" placeholder="Pencarian No SPK..." value="{{ request('keyword') }}">
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Nama PO</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">No SPK</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Tanggal SPK</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-600 uppercase tracking-wider">Nama Barang</th>
                                <th scope="col" class="px-4 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Qty</th>

                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Hotpress</th>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Basic</th>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Edging</th>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">CNC</th>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Tukang</th>
                                <th scope="col" class="px-3 py-3 text-center font-semibold text-slate-600 uppercase tracking-wider">Finishing</th>
                                <th scope="col" class="px-4 py-3 text-right font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($antrianmesin as $antri)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-4 py-4 whitespace-nowrap font-medium text-slate-900">
                                        {{ $antri->proyekorder->namaproyek }}
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

                                    <!-- Hotpress -->
                                    <td class="px-3 py-4 whitespace-nowrap text-center">
                                        @if ($antri->tglkhotpress)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">Selesai</span>
                                        @elseif ($antri->tglmhotpress)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm animate-pulse">Proses</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium text-slate-400">-</span>
                                        @endif
                                    </td>

                                    <!-- Basic -->
                                    <td class="px-3 py-4 whitespace-nowrap text-center">
                                        @if ($antri->tglkbasic)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">Selesai</span>
                                        @elseif ($antri->tglmbasic)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm animate-pulse">Proses</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium text-slate-400">-</span>
                                        @endif
                                    </td>

                                    <!-- Edging -->
                                    <td class="px-3 py-4 whitespace-nowrap text-center">
                                        @if ($antri->tglkedging)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">Selesai</span>
                                        @elseif ($antri->tgmkedging)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm animate-pulse">Proses</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium text-slate-400">-</span>
                                        @endif
                                    </td>

                                    <!-- CNC -->
                                    <td class="px-3 py-4 whitespace-nowrap text-center">
                                        @if ($antri->tglkcnc)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">Selesai</span>
                                        @elseif ($antri->tglmCnc)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm animate-pulse">Proses</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium text-slate-400">-</span>
                                        @endif
                                    </td>

                                    <!-- Tukang -->
                                    <td class="px-3 py-4 whitespace-nowrap text-center">
                                        @if ($antri->tglktukang)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">Selesai</span>
                                        @elseif ($antri->tglmTukang)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm animate-pulse">Proses</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium text-slate-400">-</span>
                                        @endif
                                    </td>

                                    <!-- Finishing -->
                                    <td class="px-3 py-4 whitespace-nowrap text-center">
                                        @if ($antri->tglkfinish)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">Selesai</span>
                                        @elseif ($antri->tglmFinish)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-sm animate-pulse">Proses</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium text-slate-400">-</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-right font-medium">
                                        <a href="{{ route('antrianmesin.show', $antri->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded-md transition-colors text-xs font-semibold shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1">
                                                <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                                <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="px-6 py-8 text-center text-slate-500 bg-slate-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                                            </svg>
                                            <span class="text-sm font-medium">Data Antrian Mesin belum tersedia.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($antrianmesin->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    {{ $antrianmesin->links() }}
                </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>
