<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesin;
use App\Models\Antrian;
use App\Models\Antrianmesin;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MesinController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Mesin::query();

        if ($request->filled('search')) {
            $query->where('nama_mesin', 'ILIKE', '%' . $request->search . '%');
        }

        $mesins = $query->orderBy('nama_mesin', 'asc')->paginate(10);

        return view('mesin.index', compact('mesins'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('mesin.create');
    }

    /**
     * store
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_mesin' => 'required|min:3|max:50|unique:mesins,nama_mesin',
            'status'     => 'required|in:aktif,nonaktif'
        ]);

        $mesin = Mesin::create([
            'nama_mesin' => $request->nama_mesin,
            'status'     => $request->status,
        ]);

        // Automatically populate existing SPKs with queue entries for this new machine
        $spks = Antrianmesin::all();
        foreach ($spks as $spk) {
            $spk->antrians()->firstOrCreate(
                ['mesin_id' => $mesin->id],
                [
                    'waktu_masuk' => null,
                    'waktu_selesai' => null,
                    'keterangan' => null,
                    'status_antrian' => 'menunggu',
                    'nomor_antrian' => 0,
                ]
            );
        }

        return redirect()->route('mesin.index')->with(['success' => 'Mesin Berhasil Ditambahkan!']);
    }

    /**
     * edit
     *
     * @param  Mesin $mesin
     * @return View
     */
    public function edit(Mesin $mesin): View
    {
        return view('mesin.edit', compact('mesin'));
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  Mesin $mesin
     * @return RedirectResponse
     */
    public function update(Request $request, Mesin $mesin): RedirectResponse
    {
        $this->validate($request, [
            'nama_mesin' => 'required|min:3|max:50|unique:mesins,nama_mesin,' . $mesin->id,
            'status'     => 'required|in:aktif,nonaktif'
        ]);

        $mesin->update([
            'nama_mesin' => $request->nama_mesin,
            'status'     => $request->status,
        ]);

        return redirect()->route('mesin.index')->with(['success' => 'Mesin Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  Mesin $mesin
     * @return RedirectResponse
     */
    public function destroy(Mesin $mesin): RedirectResponse
    {
        // We set status to nonaktif instead of hard deleting to prevent breaking database integrity
        $mesin->update(['status' => 'nonaktif']);

        return redirect()->route('mesin.index')->with(['success' => 'Status Mesin Berhasil Dinonaktifkan!']);
    }

    /**
     * showQueue
     *
     * @param  Request $request
     * @param  Mesin $mesin
     * @return View
     */
    public function showQueue(Request $request, Mesin $mesin): View
    {
        $twoDaysFromNow = \Carbon\Carbon::now()->addDays(2)->toDateString();
        
        $query = Antrian::with(['antrianmesin.proyekorder'])
            ->where('mesin_id', $mesin->id);

        // Filter by PO (namaproyek)
        if ($request->filled('po')) {
            $po = $request->po;
            $query->whereHas('antrianmesin.proyekorder', function ($q) use ($po) {
                $q->where('namaproyek', 'ILIKE', '%' . $po . '%');
            });
        }

        // Filter by nospk
        if ($request->filled('nospk')) {
            $nospk = $request->nospk;
            $query->whereHas('antrianmesin', function ($q) use ($nospk) {
                $q->where('nospk', 'ILIKE', '%' . $nospk . '%');
            });
        }

        // Filter by namabarang
        if ($request->filled('namabarang')) {
            $namabarang = $request->namabarang;
            $query->whereHas('antrianmesin', function ($q) use ($namabarang) {
                $q->where('namabarang', 'ILIKE', '%' . $namabarang . '%');
            });
        }

        // Filter by tanggal SPK (range)
        if ($request->filled('tglspk_from')) {
            $query->whereHas('antrianmesin', function ($q) use ($request) {
                $q->whereDate('tglspk', '>=', $request->tglspk_from);
            });
        }

        if ($request->filled('tglspk_to')) {
            $query->whereHas('antrianmesin', function ($q) use ($request) {
                $q->whereDate('tglspk', '<=', $request->tglspk_to);
            });
        }

        // Item appears in list only when waktu_masuk (Tanggal Masuk) is filled
        // Item disappears from list only when waktu_selesai (Waktu Keluar) is filled
        // Use fully-qualified column names to avoid ambiguity after JOIN with antrianmesins
        $query->whereNotNull('antrians.waktu_masuk')->whereNull('antrians.waktu_selesai');

        // Sort queue by prioritas & deadline & nomor_antrian & created_at
        $query->join('antrianmesins', 'antrians.antrianmesin_id', '=', 'antrianmesins.id')
            ->select('antrians.*')
            ->orderByRaw("
                CASE 
                    WHEN antrianmesins.deadline IS NOT NULL AND antrianmesins.deadline <= ? THEN 1
                    WHEN antrianmesins.prioritas IS NOT NULL THEN antrianmesins.prioritas
                    ELSE 999999
                END ASC
            ", [$twoDaysFromNow])
            ->orderBy('antrians.nomor_antrian', 'asc')
            ->orderBy('antrians.created_at', 'asc');

        $perPage = $request->perPage ? (int) $request->perPage : 10;
        $allowed = [5, 10, 25, 50, 100];
        if (!in_array($perPage, $allowed)) {
            $perPage = 10;
        }

        $antrian = $query->paginate($perPage);
        $antrian->appends($request->query());

        return view('mesin.show_queue', compact('mesin', 'antrian'));
    }

    /**
     * updateQueue
     *
     * @param  Request $request
     * @param  Mesin $mesin
     * @param  int $antrianId
     * @return RedirectResponse
     */
    public function updateQueue(Request $request, Mesin $mesin, $antrianId): RedirectResponse
    {
        $this->validate($request, [
            'nomor_antrian'  => 'required|integer|min:0',
            'status_antrian' => 'required|in:menunggu,diproses,selesai',
            'waktu_masuk'    => 'nullable|date',
            'waktu_selesai'  => 'nullable|date'
        ]);

        $antrian = Antrian::where('mesin_id', $mesin->id)->findOrFail($antrianId);

        $antrian->update([
            'nomor_antrian'  => $request->nomor_antrian,
            'status_antrian' => $request->status_antrian,
            'waktu_masuk'    => $request->waktu_masuk ?: null,
            'waktu_selesai'  => $request->waktu_selesai ?: null,
            'keterangan'     => $request->keterangan ?: null,
        ]);

        // Also check if this changes the parent SPK overall completion status.
        // E.g., if finishing stage is marked completed, update the tglcompleted in the parent SPK.
        if ($mesin->nama_mesin === 'Finishing' && $request->status_antrian === 'selesai' && !empty($request->waktu_selesai)) {
            $antrian->antrianmesin->update([
                'tglcompleted' => $request->waktu_selesai
            ]);
        }

        return redirect()->route('antrian.mesin.show', $mesin->id)->with(['success' => 'Data Antrian Berhasil Diupdate!']);
    }
}
