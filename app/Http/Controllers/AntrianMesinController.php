<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import Model "Antrianmesin"
use App\Models\Antrianmesin;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class AntrianMesinController extends Controller
{
 /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View
    {

        //get search
        $keyword = $request->keyword;
        //get posts
        $antrianmesin = Antrianmesin::where('nospk', 'LIKE', '%'.$keyword.'%')->latest()->paginate(5);

        //render view with posts
        return view('antrianmesin.index', compact('antrianmesin')); //text warna oranye "antrianmesin"(folder) didapat dari folder /resources/views/antrianmesin dan text index didapat dari file "index" berada di /resources/views/antrianmesin/index.blade.php
        // compact adalah mengambil variabel $antrianmesin yg ada di atas
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
            'nospk'     => 'required|min:3',
            'namabarang'   => 'required|min:5'
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
        return redirect()->route('listspk.index')->with(['success' => 'Data Berhasil Disimpan!']);
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

