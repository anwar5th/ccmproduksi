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
                                        <!-- search -->
                                        <div class="row justify-content-start">
                                        <div class="col-12 col-sm-8 col-md-5">
                                        <form action="" method="GET">
                                            <div class="input-group mb-3">
                                              <input name="keyword" class="form-control" placeholder="Pencarian Berdasarkan No SPK, disini" aria-label="Pencarian Berdasarkan No SPK, disini" aria-describedby="button-addon2" value="">
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                        <div class="container mt-5">
                                            <!-- Tambahan -->
                                            <table class="table" enctype="multipart/form-data">
                                                                <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col">Nama PO</th>
                                                                    <th scope="col">No SPK</th>
                                                                    <th scope="col">Tanggal SPK</th>
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
                                                                            <td class="indent-0.5">{{ $antri->tglspk }}</td>
                                                                            <td class="">{{ $antri->namabarang }}</td>
                                                                            <td class="">{{ $antri->qtybarang }}</td>

                                                                            <td class="text-green-600/100 indent-0.5">{{ $antri->tglkhotpress }}</td>
                                                                            <td class="text-green-600/100 indent-0.5">{{ $antri->tglkbasic }}</td>
                                                                            <td class="text-green-600/100 indent-0.5">{{ $antri->tglkedging }}</td>
                                                                            <td class="text-green-600/100 indent-0.5">{{ $antri->tglkcnc }}</td>
                                                                            <td class="text-green-600/100 indent-0.5">{{ $antri->tglktukang }}</td>
                                                                            <td class="text-green-600/100 indent-0.5">{{ $antri->tglkfinish }}</td>
                                                                            
                                                                            <td class="text-center">
                                                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('proyekorders.destroy', $antri->id) }}" method="POST">
                                                                                    <a href="{{ route('antrianmesin.show', $antri->id) }}" class="rounded-md btn bg-sky-800 hover:bg-sky-600 text-white">Detail</a><hr>
                                                                                    
                                                                                    <!-- <button type="submit" class="rounded-md btn bg-red-500 hover:bg-red-600 text-white">Hapus</button> -->
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
                                            {{ $antrianmesin->links() }}                
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
