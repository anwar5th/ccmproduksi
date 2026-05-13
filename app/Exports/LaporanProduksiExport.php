<?php

namespace App\Exports;

use App\Models\Antrianmesin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class LaporanProduksiExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // Menggunakan FromQuery agar otomatis di-chunk oleh package (Aman untuk data besar)
    public function query()
    {
        // Eager loading relasi proyekorder untuk mencegah N+1 query
        $query = Antrianmesin::with('proyekorder')->whereNotNull('tglcompleted');

        // --- Filter Laporan Existing ---
        if ($this->request->filled('po')) {
            $query->whereHas('proyekorder', function($q) {
                $q->where('namaproyek', 'like', '%' . $this->request->po . '%');
            });
        }

        if ($this->request->filled('kodepo')) {
            $query->whereHas('proyekorder', function($q) {
                $q->where('kodepo', 'like', '%' . $this->request->kodepo . '%');
            });
        }

        if ($this->request->filled('nospk')) {
            $query->where('nospk', 'like', '%' . $this->request->nospk . '%');
        }

        if ($this->request->filled('namabarang')) {
            $query->where('namabarang', 'like', '%' . $this->request->namabarang . '%');
        }

        if ($this->request->filled('tglpo_from')) {
            $query->whereHas('proyekorder', function($q) {
                $q->whereDate('tglpo', '>=', $this->request->tglpo_from);
            });
        }

        if ($this->request->filled('tglpo_to')) {
            $query->whereHas('proyekorder', function($q) {
                $q->whereDate('tglpo', '<=', $this->request->tglpo_to);
            });
        }

        if ($this->request->filled('tglspk_from')) {
            $query->whereDate('tglspk', '>=', $this->request->tglspk_from);
        }

        if ($this->request->filled('tglspk_to')) {
            $query->whereDate('tglspk', '<=', $this->request->tglspk_to);
        }

        // --- Tambahan Filter Tanggal Selesai (tglcompleted) dari Modal ---
        if ($this->request->filled('tglcompleted_from')) {
            $query->whereDate('tglcompleted', '>=', $this->request->tglcompleted_from);
        }

        if ($this->request->filled('tglcompleted_to')) {
            $query->whereDate('tglcompleted', '<=', $this->request->tglcompleted_to);
        }

        return $query->orderBy('tglcompleted', 'desc');
    }

    public function headings(): array
    {
        return [
            'Nama PO',
            'Kode PO',
            'Tanggal PO',
            'No SPK',
            'Tanggal SPK',
            'Nama Barang',
            'Qty',
            'Tanggal Selesai',
        ];
    }

    public function map($antrian): array
    {
        return [
            $antrian->proyekorder->namaproyek ?? '-',
            $antrian->proyekorder->kodepo ?? '-',
            $antrian->proyekorder->tglpo ? Carbon::parse($antrian->proyekorder->tglpo)->format('d-m-Y H:i') : '-',
            $antrian->nospk ?? '-',
            $antrian->tglspk ? Carbon::parse($antrian->tglspk)->format('d-m-Y H:i') : '-',
            $antrian->namabarang ?? '-',
            $antrian->qtybarang ?? 0,
            $antrian->tglcompleted ? Carbon::parse($antrian->tglcompleted)->format('d-m-Y H:i') : '-',
        ];
    }
}
