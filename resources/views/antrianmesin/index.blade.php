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
                                        {{ __("List Antrian Mesin") }}
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

                                                                    <th scope="col">Hotpress</th>
                                                                    <th scope="col">Basic</th>
                                                                    <th scope="col">Edging</th>
                                                                    <th scope="col">CNC</th>
                                                                    <th scope="col">Tukang</th>
                                                                    <th scope="col">Finishing</th>
                                                                    <th scope="col">...</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @forelse ($antrianmesin as $antri)
                                                                        <tr>
                                                                            <td class="">{{ $antri->proyekorder->namaproyek }}</td>
                                                                            <td class="">{{ $antri->nospk }}</td>
                                                                            <td class="">{{ $antri->tglspk }}</td>
                                                                            <td class="">{{ $antri->namabarang }}</td>
                                                                            <td class="">{{ $antri->qtybarang }}</td>

                                                                            <td class="">{{ $antri->tglkhotpress }}</td>
                                                                            <td class="">{{ $antri->tglkbasic }}</td>
                                                                            <td class="">{{ $antri->tglkedging }}</td>
                                                                            <td class="">{{ $antri->tglkcnc }}</td>
                                                                            <td class="">{{ $antri->tglktukang }}</td>
                                                                            <td class="">{{ $antri->tglkfinish }}</td>
                                                                            
                                                                            <td class="text-center">
                                                                                
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
