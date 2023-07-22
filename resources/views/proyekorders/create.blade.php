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
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-body">
                                <form action="{{ route('proyekorders.store') }}" method="POST" enctype="multipart/form-data">
                                
                                    @csrf

                                    <div class="form-group">
                                        <label class="font-weight-bold">Kode PO</label>
                                        <input type="text" class="form-control @error('kodepo') is-invalid @enderror" name="kodepo" value="{{ old('kodepo') }}" placeholder="">
                                    
                                        <!-- error message untuk kodepo -->
                                        @error('kodepo')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama Proyek</label>
                                        <input type="text" class="form-control @error('namaproyek') is-invalid @enderror" name="namaproyek" value="{{ old('namaproyek') }}" placeholder="">
                                    
                                        <!-- error message untuk namaproyek -->
                                        @error('namaproyek')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Tgl PO</label>
                                        <input type="date" class="form-control @error('tglpo') is-invalid @enderror" name="tglpo" value="{{ old('tglpo') }}" placeholder="">
                                    
                                        <!-- error message untuk tglpo -->
                                        @error('tglpo')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Keterangan List Item SPK</label>
                                        <textarea class="form-control @error('keteranganpoitem') is-invalid @enderror" name="keteranganpoitem" rows="5" placeholder="">{{ old('keteranganpoitem') }}</textarea>
                                    
                                        <!-- error message untuk content -->
                                        @error('keteranganpoitem')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                    <button type="reset" class="btn btn-md btn-warning">RESET</button>

                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
