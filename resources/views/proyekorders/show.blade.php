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
                        <div class="container mt-5 mb-5">
                            <div class="row justify-content-left">
                                <div class="">
                                    <span>Kode Proyek Order</span> | <span>{{ $proyekorders->kodepo }}</span><br>
                                    <span>Nama Proyek Order</span> | <span>{{ $proyekorders->namaproyek }}</span><br>
                                    <span>Tgl Proyek Order</span> | <span>{{ $proyekorders->tglpo }}</span>
                                </div>
                            </div>
                            <br>
                            <br>
                            <form>
                            <b><h4>Input Surat Perintah Kerja</h4></b>
                            <br>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">No SPK</span>
                                <input type="text" class="form-control">
                            </div>
                            <br>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl SPK</span>
                                <input type="text" class="form-control">
                            </div>
                            <br>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Nama Barang</span>
                                <input type="text" class="form-control">
                            </div>
                            <br>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Quantity</span>
                                <input type="text" class="form-control">
                            </div>
                            <br>
                            <p>HOT PRESS</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control">
                            </div>
                            <p>R.SAW / BASIC</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control">
                            </div>
                            <p>EDGING</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control">
                            </div>
                            <p>CNC</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control">
                            </div>
                            <p>TK. KAYU</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control">
                            </div>
                            <p>FINISHING</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="text" class="form-control">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control">
                            </div>
                            <button type="submit" class="rounded-md btn bg-sky-800 hover:bg-sky-600 text-white">Simpan</button>
                            <button type="reset" class="rounded-md btn bg-sky-500 hover:bg-sky-600 text-white">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("List Barang SPK") }}
                    <div class="container mt-5">
                        <!-- Tambahan -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
