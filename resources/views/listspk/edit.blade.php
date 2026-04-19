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
                                    <span><strong>Kode Proyek Order:</strong></span> <span>{{ $proyekorders->kodepo }}</span><br>
                                    <span><strong>Nama Proyek Order:</strong></span> <span>{{ $proyekorders->namaproyek }}</span><br>
                                    <span><strong>Tgl Proyek Order:</strong></span> <span>{{ $proyekorders->tglpo ? \Carbon\Carbon::parse($proyekorders->tglpo)->format('d M Y H.i') : '' }}</span>
                                </div>
                            </div>
                            <br>
                            <br>
                            <b><h4>Input Surat Perintah Kerja</h4></b>
                            <br>
                            <form action="{{ route('listspk.update', $listspk->id) }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf
                            @method('PUT')

                            <label for="personSelect">ID PO
                                <select name="proyekorders_id" lass="form-control @error('proyekorders_id') is-invalid @enderror" name="proyekorders_id" value="{{ old('proyekorders_id', $listspk->proyekorders_id) }}" placeholder="" >
                                  <option>{{ $listspk->proyekorders_id }}</option>
                                </select>
                            </label>
                            <br>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">No SPK</span>
                                <input type="text" class="form-control @error('nospk') is-invalid @enderror" name="nospk" value="{{ old('nospk', $listspk->nospk) }}" placeholder="">
                                <!-- error message untuk kodepo -->
                                @error('nospk')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                @enderror
                            </div>
                            <br>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl SPK</span>
                                <input type="datetime-local" class="form-control @error('tglspk') is-invalid @enderror" name="tglspk" value="{{ old('tglspk') ? \Carbon\Carbon::parse(old('tglspk'))->format('Y-m-d\\TH:i') : ($listspk->tglspk ? \Carbon\Carbon::parse($listspk->tglspk)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <!-- error message untuk kodepo -->
                                @error('tglspk')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                @enderror
                            </div>
                            <br>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Nama Barang</span>
                                <input type="text" class="form-control @error('namabarang') is-invalid @enderror" name="namabarang" value="{{ old('namabarang', $listspk->namabarang) }}" placeholder="">
                                <!-- error message untuk kodepo -->
                                @error('namabarang')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                @enderror
                            </div>
                            <br>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Quantity</span>
                                <input type="number" class="form-control @error('qtybarang') is-invalid @enderror" name="qtybarang" value="{{ old('qtybarang', $listspk->qtybarang) }}" placeholder="">
                                <!-- error message untuk kodepo -->
                                @error('qtybarang')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                @enderror
                            </div>
                            <br>
                            <p>HOT PRESS</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="datetime-local" class="form-control @error('tglmhotpress') is-invalid @enderror" name="tglmhotpress" value="{{ old('tglmhotpress') ? \Carbon\Carbon::parse(old('tglmhotpress'))->format('Y-m-d\\TH:i') : ($listspk->tglmhotpress ? \Carbon\Carbon::parse($listspk->tglmhotpress)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="datetime-local" class="form-control @error('tglkhotpress') is-invalid @enderror" name="tglkhotpress" value="{{ old('tglkhotpress') ? \Carbon\Carbon::parse(old('tglkhotpress'))->format('Y-m-d\\TH:i') : ($listspk->tglkhotpress ? \Carbon\Carbon::parse($listspk->tglkhotpress)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control @error('kethotpress') is-invalid @enderror" name="kethotpress" value="{{ old('kethotpress', $listspk->kethotpress) }}" placeholder="">
                            </div>
                            <p>R.SAW / BASIC</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="datetime-local" class="form-control @error('tglmbasic') is-invalid @enderror" name="tglmbasic" value="{{ old('tglmbasic') ? \Carbon\Carbon::parse(old('tglmbasic'))->format('Y-m-d\\TH:i') : ($listspk->tglmbasic ? \Carbon\Carbon::parse($listspk->tglmbasic)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="datetime-local" class="form-control @error('tglkbasic') is-invalid @enderror" name="tglkbasic" value="{{ old('tglkbasic') ? \Carbon\Carbon::parse(old('tglkbasic'))->format('Y-m-d\\TH:i') : ($listspk->tglkbasic ? \Carbon\Carbon::parse($listspk->tglkbasic)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control @error('ketbasic') is-invalid @enderror" name="ketbasic" value="{{ old('ketbasic', $listspk->ketbasic) }}" placeholder="">
                            </div>
                            <p>EDGING</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="datetime-local" class="form-control @error('tglmedging') is-invalid @enderror" name="tglmedging" value="{{ old('tglmedging') ? \Carbon\Carbon::parse(old('tglmedging'))->format('Y-m-d\\TH:i') : ($listspk->tglmedging ? \Carbon\Carbon::parse($listspk->tglmedging)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="datetime-local" class="form-control @error('tglkedging') is-invalid @enderror" name="tglkedging" value="{{ old('tglkedging') ? \Carbon\Carbon::parse(old('tglkedging'))->format('Y-m-d\\TH:i') : ($listspk->tglkedging ? \Carbon\Carbon::parse($listspk->tglkedging)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control @error('ketedging') is-invalid @enderror" name="ketedging" value="{{ old('ketedging', $listspk->ketedging) }}" placeholder="">
                            </div>
                            <p>CNC</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="datetime-local" class="form-control @error('tglmcnc') is-invalid @enderror" name="tglmcnc" value="{{ old('tglmcnc') ? \Carbon\Carbon::parse(old('tglmcnc'))->format('Y-m-d\\TH:i') : ($listspk->tglmcnc ? \Carbon\Carbon::parse($listspk->tglmcnc)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="datetime-local" class="form-control @error('tglkcnc') is-invalid @enderror" name="tglkcnc" value="{{ old('tglkcnc') ? \Carbon\Carbon::parse(old('tglkcnc'))->format('Y-m-d\\TH:i') : ($listspk->tglkcnc ? \Carbon\Carbon::parse($listspk->tglkcnc)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control @error('ketcnc') is-invalid @enderror" name="ketcnc" value="{{ old('ketcnc', $listspk->ketcnc) }}" placeholder="">
                            </div>
                            <p>TK. KAYU</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="datetime-local" class="form-control @error('tglmtukang') is-invalid @enderror" name="tglmtukang" value="{{ old('tglmtukang') ? \Carbon\Carbon::parse(old('tglmtukang'))->format('Y-m-d\\TH:i') : ($listspk->tglmtukang ? \Carbon\Carbon::parse($listspk->tglmtukang)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="datetime-local" class="form-control @error('tglktukang') is-invalid @enderror" name="tglktukang" value="{{ old('tglktukang') ? \Carbon\Carbon::parse(old('tglktukang'))->format('Y-m-d\\TH:i') : ($listspk->tglktukang ? \Carbon\Carbon::parse($listspk->tglktukang)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control @error('kettukang') is-invalid @enderror" name="kettukang" value="{{ old('kettukang', $listspk->kettukang) }}" placeholder="">
                            </div>
                            <p>FINISHING</p>
                            <div class="row justify-content-left input-group mb-3">
                                <span class="input-group-text">Tgl Masuk</span>
                                <input type="datetime-local" class="form-control @error('tglmfinish') is-invalid @enderror" name="tglmfinish" value="{{ old('tglmfinish') ? \Carbon\Carbon::parse(old('tglmfinish'))->format('Y-m-d\\TH:i') : ($listspk->tglmfinish ? \Carbon\Carbon::parse($listspk->tglmfinish)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Tgl Keluar</span>
                                <input type="datetime-local" class="form-control @error('tglkfinish') is-invalid @enderror" name="tglkfinish" value="{{ old('tglkfinish') ? \Carbon\Carbon::parse(old('tglkfinish'))->format('Y-m-d\\TH:i') : ($listspk->tglkfinish ? \Carbon\Carbon::parse($listspk->tglkfinish)->format('Y-m-d\\TH:i') : '') }}" placeholder="">
                                <span class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control @error('ketfinish') is-invalid @enderror" name="ketfinish" value="{{ old('ketfinish', $listspk->ketfinish) }}" placeholder="">
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

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("List Barang SPK") }}
                    <div class="container mt-5">
                        
                         <h5>Comeing soon</h5>
                                          
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</x-app-layout>