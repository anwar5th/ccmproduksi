<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produksi WS1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <!-- Tambahan -->
                        <div class="row">
                            <div class="col-md-12">
                                <div>

                                </div>
                                <div class="card border-0 shadow-sm rounded">
                                    <div class="card-body">
                                       <a href="{{ route('proyekorders.create')}}" class="btn btn-md btn-success mb-3"> PO Baru </a>
                                       <!-- search -->
                                        <div class="row justify-content-start">
                                        <div class="col-12 col-sm-8 col-md-5">
                                        <form action="" method="GET">
                                            <div class="input-group mb-3">
                                              <input name="keyword" class="form-control" placeholder="Pencarian Berdasarkan Nama PO atau Tanggal PO, disini" aria-label="Pencarian Berdasarkan Nama PO atau Tanggal PO, disini" aria-describedby="button-addon2" value="">
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                        <table class="table">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">Kode PO</th>
                                                <th scope="col">Nama PO</th>
                                                <th scope="col">Tanggal PO</th>
                                                <th scope="col">List Item SPK</th>
                                                <th scope="col">....</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($proyekorders as $po)
                                                    <tr>
                                                        <td class="">{{ $po->kodepo }}</td>
                                                        <td class="">{{ $po->namaproyek }}</td>
                                                        <td class="">{{ $po->tglpo }}</td>
                                                        <td class="break-all">{!! $po->keteranganpoitem !!}</td>
                                                        <td class="text-center">
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('proyekorders.destroy', $po->id) }}" method="POST">
                                                                <a href="{{ route('proyekorders.show', $po->id) }}" class="rounded-md btn bg-sky-800 hover:bg-sky-600 text-white">Buat SPK</a><hr>
                                                                <a href="{{ route('proyekorders.edit', $po->id) }}" class="rounded-md btn bg-sky-500 hover:bg-sky-600 text-white">Ubah</a><hr>
                                                                @csrf
                                                                @method('DELETE')
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
                                        {{ $proyekorders->links() }}  
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
