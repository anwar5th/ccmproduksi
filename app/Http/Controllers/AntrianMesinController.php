<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import Model "Antrianmesin"
use App\Models\Antrianmesin;
use App\Models\Proyekorder;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class AntrianMesinController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View
    {
        // Build query with eager load
        $twoDaysFromNow = \Carbon\Carbon::now()->addDays(2)->toDateString();
        $query = Antrianmesin::with('proyekorder')
            ->whereNull('tglcompleted')
            ->orderByRaw("
                CASE 
                    WHEN deadline IS NOT NULL AND deadline <= ? THEN 1
                    WHEN prioritas IS NOT NULL THEN prioritas
                    ELSE 999999
                END ASC
            ", [$twoDaysFromNow])
            ->orderBy('created_at', 'asc');

        // Filters
        // filter berdasarkan proyek order (relasi)
        if ($request->filled('po')) {
            $po = $request->po;

            $query->whereHas('proyekorder', function ($q) use ($po) {
                $q->where('namaproyek', 'ILIKE', '%' . $po . '%');
            });
        }

        // filter nospk
        if ($request->filled('nospk')) {
            $query->where('nospk', 'ILIKE', '%' . $request->nospk . '%');
        }

        // filter nama barang
        if ($request->filled('namabarang')) {
            $query->where('namabarang', 'ILIKE', '%' . $request->namabarang . '%');
        }

        // filter tanggal SPK (range)
        if ($request->filled('tglspk_from')) {
            $query->whereDate('tglspk', '>=', $request->tglspk_from);
        }

        if ($request->filled('tglspk_to')) {
            $query->whereDate('tglspk', '<=', $request->tglspk_to);
        }

        // Page length / per page
        $perPage = $request->perPage ? (int) $request->perPage : 10;
        $allowed = [5, 10, 25, 50, 100];
        if (!in_array($perPage, $allowed)) {
            $perPage = 10;
        }

        // Paginate and preserve query string
        $antrianmesin = $query->paginate($perPage);
        // preserve current query parameters (filters) in pagination links
        $antrianmesin->appends($request->query());

        // render view with posts
        return view('antrianmesin.index', compact('antrianmesin'));
    }   

    // MEMBUAT CONTROLLER CREATE

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {

        $proyekorders = Proyekorder::all();

        return view('antrianmesin.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nospk'      => 'required|min:3|unique:antrianmesins,nospk',
            'namabarang'   => 'required|min:5'
        ], [
            'nospk.required' => 'No SPK wajib diisi.',
            'nospk.min'      => 'No SPK minimal 3 karakter.',
            'nospk.unique'   => 'No SPK sudah terdaftar.',

            'namabarang.required' => 'Nama barang wajib diisi.',
            'namabarang.min'      => 'Nama barang minimal 5 karakter.',
        ]);

        //create Antrianmesin
        Antrianmesin::create([
            'proyekorders_id'     => $request->proyekorders_id,
            'nospk'     => $request->nospk,
            'tglspk'   => $request->tglspk,
            'deadline' => $request->deadline,
            'prioritas' => $request->prioritas,
            'namabarang'   => $request->namabarang,
            'qtybarang'   => $request->qtybarang,

            'tglmhotpress'   => $request->tglmhotpress,
            'tglkhotpress'   => $request->tglkhotpress,
            'kethotpress'   => $request->kethotpress,

            'tglmrunningsaw'   => $request->tglmrunningsaw,
            'tglkrunningsaw'   => $request->tglkrunningsaw,
            'ketrunningsaw'   => $request->ketrunningsaw,

            'tglmcnc5axis'   => $request->tglmcnc5axis,
            'tglkcnc5axis'   => $request->tglkcnc5axis,
            'ketcnc5axis'   => $request->ketcnc5axis,

            'tglmcnc4axis'   => $request->tglmcnc4axis,
            'tglkcnc4axis'   => $request->tglkcnc4axis,
            'ketcnc4axis'   => $request->ketcnc4axis,

            'tglmboring'   => $request->tglmboring,
            'tglkboring'   => $request->tglkboring,
            'ketboring'   => $request->ketboring,

            'tglmrouter'   => $request->tglmrouter,
            'tglkrouter'   => $request->tglkrouter,
            'ketrouter'   => $request->ketrouter,

            'tglmrakit'   => $request->tglmrakit,
            'tglkrakit'   => $request->tglkrakit,
            'ketrakit'   => $request->ketrakit,

            'tglmfinish'   => $request->tglmfinish,
            'tglkfinish'   => $request->tglkfinish,
            'ketfinish'   => $request->ketfinish,

            'created_by' => Auth::id()
        ]);

        //redirect to back
        $payloadSuccess = ['success' => 'Data Berhasil Disimpan!'];
        return redirect()->route('proyekorders.show', $request->proyekorders_id)->with($payloadSuccess);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $antrianmesin = Antrianmesin::findOrFail($id);

        //render view with post
        return view('antrianmesin.show', compact('antrianmesin')); // compact adalah mengambil variabel $antrianmesin yg ada di atas
    }
}
