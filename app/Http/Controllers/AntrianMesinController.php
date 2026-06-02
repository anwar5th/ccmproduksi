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
        $query = Antrianmesin::with('proyekorder')->whereNull('tglcompleted')->orderBy('tglspk', 'desc');

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
            'namabarang'   => $request->namabarang,
            'qtybarang'   => $request->qtybarang,

            'tglmhotpress'   => $request->tglmhotpress,
            'tglkhotpress'   => $request->tglkhotpress,
            'kethotpress'   => $request->kethotpress,

            'tglmbasic'   => $request->tglmbasic,
            'tglkbasic'   => $request->tglkbasic,
            'ketbasic'   => $request->ketbasic,

            'tglmedging'   => $request->tglmedging,
            'tglkedging'   => $request->tglkedging,
            'ketedging'   => $request->ketedging,

            'tglmcnc'   => $request->tglmcnc,
            'tglkcnc'   => $request->tglkcnc,
            'ketcnc'   => $request->ketcnc,

            'tglmtukang'   => $request->tglmtukang,
            'tglktukang'   => $request->tglktukang,
            'kettukang'   => $request->kettukang,

            'tglmfinish'   => $request->tglmfinish,
            'tglkfinish'   => $request->tglkfinish,
            'ketfinish'   => $request->ketfinish
        ]);

        //redirect to index
        $payloadSuccess = ['success' => 'Data Berhasil Disimpan!'];
        $route = Auth::user()->role == 1 ? 'proyekorders.index' : 'listspk.index';
        return redirect()->route($route)->with($payloadSuccess);
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
