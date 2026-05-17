<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 px-4 sm:px-0">
                <h3 class="text-2xl font-bold text-slate-900">Selamat Datang di FCS</h3>
                <p class="text-slate-500 mt-1">Sistem Manajemen Produksi Furniture</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 px-4 sm:px-0">

                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-slate-900 mb-2">1. Input PO & SPK</h4>
                    <p class="text-sm text-slate-600 leading-relaxed flex-grow">Input PO pada menu Produksi > Input PO & SPK. Agar form SPK muncul, Input PO terlebih dahulu.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-slate-900 mb-2">2. Buat SPK</h4>
                    <p class="text-sm text-slate-600 leading-relaxed flex-grow">Pembuatan Surat Perintah Kerja (SPK) dapat dilakukan melalui tombol <span class="font-medium text-emerald-600">"Buat SPK"</span> pada data PO.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-slate-900 mb-2">3. Update Proses</h4>
                    <p class="text-sm text-slate-600 leading-relaxed flex-grow">Update proses dan pantau antrian mesin untuk setiap barang dapat dilihat di menu <span class="font-medium text-amber-600">"List SPK"</span>.</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-slate-900 mb-2">4. Antrian Mesin</h4>
                    <p class="text-sm text-slate-600 leading-relaxed flex-grow">Detail antrian mesin dan statistik operasional terdapat pada menu <span class="font-medium text-indigo-600">"Antrian Mesin"</span> tombol Detail.</p>
                </div>

                <!-- Card 5 -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-12 w-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>

                    <h4 class="text-lg font-semibold text-slate-900 mb-2">5. Laporan Produksi</h4>

                    <p class="text-sm text-slate-600 leading-relaxed flex-grow">
                        SPK dan antrian mesin yang telah selesai dikerjakan dapat dilihat pada menu
                        <span class="font-medium text-rose-600">"Laporan"</span>.
                        Data laporan juga dapat di-export ke
                        <span class="font-medium text-emerald-600">Excel</span> untuk kebutuhan rekap dan analisa produksi.
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>