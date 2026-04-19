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
                                    <span><strong>Nama Proyek:</strong></span> <span>{{ $antrianmesin->proyekorder->namaproyek }}</span><br><br>
                                    <span><strong>Nomor SPK:</strong></span> <span>{{ $antrianmesin->nospk }}</span><br><br>
                                    <span><strong>Tanggal Turun SPK:</strong></span>
                                    <span>{{ $antrianmesin->tglspk ? \Carbon\Carbon::parse($antrianmesin->tglspk)->format('d M Y H.i') : '' }}</span><br><br>
                                    <span><strong>Nama Barang:</strong></span> <span>{{ $antrianmesin->namabarang }}</span><br><br>
                                    <span><strong>Quantity:</strong></span> <span>{{ $antrianmesin->qtybarang }}</span>
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
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmhotpress ? \Carbon\Carbon::parse($antrianmesin->tglmhotpress)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkhotpress ? \Carbon\Carbon::parse($antrianmesin->tglkhotpress)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->kethotpress }}</P></span>
                            </div>
                            <p>R.SAW / BASIC</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmbasic ? \Carbon\Carbon::parse($antrianmesin->tglmbasic)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkbasic ? \Carbon\Carbon::parse($antrianmesin->tglkbasic)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->ketbasic }}</P></span>
                            </div>
                            <p>EDGING</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmedging ? \Carbon\Carbon::parse($antrianmesin->tglmedging)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkedging ? \Carbon\Carbon::parse($antrianmesin->tglkedging)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->ketedging }}</P></span>
                            </div>
                            <p>CNC</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmcnc ? \Carbon\Carbon::parse($antrianmesin->tglmcnc)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkcnc ? \Carbon\Carbon::parse($antrianmesin->tglkcnc)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->ketcnc }}</P></span>
                            </div>
                            <p>TK. KAYU</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmtukang ? \Carbon\Carbon::parse($antrianmesin->tglmtukang)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglktukang ? \Carbon\Carbon::parse($antrianmesin->tglktukang)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Keterangan</span>
                                <span class="input-group-text bg-yellow-100"><p>{{ $antrianmesin->kettukang }}</P></span>
                            </div>
                            <p>FINISHING</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text bg-white">Tanggal Masuk</span>
                                <span class="input-group-text bg-orange-300"><p>{{ $antrianmesin->tglmfinish ? \Carbon\Carbon::parse($antrianmesin->tglmfinish)->format('d M Y H.i') : '' }}</P></span>
                                <span class="input-group-text bg-white">Tanggal Selesai</span>
                                <span class="input-group-text bg-green-300"><p>{{ $antrianmesin->tglkfinish ? \Carbon\Carbon::parse($antrianmesin->tglkfinish)->format('d M Y H.i') : '' }}</P></span>
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
