<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produksi WS1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <!-- Tambahan -->
                        <div class="py-12">
                            <div class="max-w-full mx-auto ">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        {{ __("List Barang SPK") }}
                                        <div class="container mt-5">
                                            <!-- Tambahan -->
                                            <table class="table" enctype="multipart/form-data">
                                                                <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col">Nama PO</th>
                                                                    <th scope="col">No SPK</th>
                                                                    <th scope="col">Tgl SPK</th>
                                                                    <th scope="col">Nama Barang</th>
                                                                    <th scope="col">Qty</th>
                                                                    <th scope="col">...</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @forelse ($listspk as $spk)
                                                                        <tr>
                                                                            <td class="">{{ $spk->proyekorder->namaproyek }}</td>
                                                                            <td class="">{{ $spk->nospk }}</td>
                                                                            <td class="">{{ $spk->tglspk }}</td>
                                                                            <td class="">{{ $spk->namabarang }}</td>
                                                                            <td class="">{{ $spk->qtybarang }}</td>

                                                                            <td class="text-center">
                                                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('listspk.destroy', $spk->id) }}" method="POST">
                                                                                    <a href="{{ route('listspk.edit', $spk->id) }}" class="rounded-md btn bg-sky-500 hover:bg-sky-600 text-white">Ubah</a><hr>
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="rounded-md btn bg-red-500 hover:bg-red-600 text-white">Hapus</button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        <div class="alert alert-danger">
                                                                            Data PO belum Tersedia.
                                                                        </div>
                                                                    @endforelse
                                                                </tbody>
                                                                
                                            </table>
                                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
