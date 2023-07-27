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
                         <div class="row justify-content-left">
                                <div class="">
                                    <span>Nama Proyek</span> | <span>{{ $antrianmesin->proyekorder->namaproyek }}</span><br><br>
                                    <span>Nomor SPK</span> | <span>{{ $antrianmesin->nospk }}</span><br><br>
                                    <span>Tanggal Turun SPK</span> | <span>{{ $antrianmesin->tglspk }}</span><br><br>
                                    <span>Nama Barang</span> | <span>{{ $antrianmesin->namabarang }}</span><br><br>
                                    <span>Quantity</span> | <span>{{ $antrianmesin->qtybarang }}</span>
                                </div>
                         </div>
                         <br>
                            <br>
                            <b><h4>Laporan Antrian Mesin</h4></b>
                            <br>
                            <form>
                            
                            @csrf
                            <p>HOT PRESS</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmhotpress }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkhotpress }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->kethotpress }}</P></span>
                            </div>
                            <p>R.SAW / BASIC</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmbasic }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkbasic }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->ketbasic }}</P></span>
                            </div>
                            <p>EDGING</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmedging }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkedging }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->ketedging }}</P></span>
                            </div>
                            <p>CNC</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmcnc }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkcnc }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->ketcnc }}</P></span>
                            </div>
                            <p>TK. KAYU</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmtukang }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglktukang }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->kettukang }}</P></span>
                            </div>
                            <p>FINISHING</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmfinish }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkfinish }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->ketfinish }}</P></span>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
