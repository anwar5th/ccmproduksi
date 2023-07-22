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
                                    <h3 class="text-center my-5"></h3>      
                                    <hr>
                                </div>
                                <div class="card border-0 shadow-sm rounded">
                                    <div class="card-body">
                                       <a href="{{ route('proyekorders.create')}}" class="btn btn-md btn-success mb-3"> PO Baru </a>
                                        <table class="table-auto table table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">KODE PO</th>
                                                <th scope="col">NAMA PO</th>
                                                <th scope="col">Tgl PO</th>
                                                <th scope="col">LIST ITEM SPK</th>
                                                <th scope="col">.....</th>
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
                                                                <a href="{{ route('proyekorders.show', $po->id) }}" class="rounded-md btn bg-sky-500 hover:bg-cyan-600 text-white">Tampil</a><hr>
                                                                <a href="{{ route('proyekorders.edit', $po->id) }}" class="rounded-md btn bg-green-500 hover:bg-green-600 text-white">Ubah</a><hr>
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
