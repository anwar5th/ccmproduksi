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
                    {{ __("Applikasi PT Citra Cikal Mapan") }}
                    <div class="container mt-5">
                        <!-- Tambahan -->
                        <h3> - Input PO pada menu Produksi > Input PO & SPK > Agar Muncul Form Input SPK maka Input PO terlebih dahulu</h3>
                        <br>
                        <h3> - Input SPK terdapat pada tombol "Buat SPK" </h3> 
                        <br>
                        <h3> - Update Proses antrian mesin terdapat pada menu "List SPK" </h3>
                        <br>
                        <h3> - Detail laporan antrian mesin terdapat pada menu "Antrian Mesin" tombol "Detail" </h3>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
