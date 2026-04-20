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
                    <h3 class="text-lg font-bold text-slate-900">List Barang SPK</h3>
                    
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
                
                @if($listspk->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    {{ $listspk->links() }}
                </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>
