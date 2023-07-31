<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import Model "Antrianmesin"
use App\Models\Antrianmesin;

//import Model "Proyekorder
use App\Models\Proyekorder;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class ListSpkController extends Controller
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
        $listspk = Antrianmesin::where('nospk', 'LIKE', '%'.$keyword.'%')->latest()->paginate(5);

        //render view with posts
        return view('listspk.index', compact('listspk')); //text warna oranye "antrianmesin"(folder) didapat dari folder /resources/views/antrianmesin dan text index didapat dari file "index" berada di /resources/views/antrianmesin/index.blade.php
        // compact adalah mengambil variabel $antrianmesin yg ada di atas
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $listspk = Antrianmesin::findOrFail($id);

        //get Proyekorder by ID
        $proyekorders = Proyekorder::findOrFail($id);

        //render view with post
        return view('listspk.edit', compact('proyekorders' , 'listspk'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nospk'     => 'required|min:3',
            'namabarang'   => 'required|min:5'
        ]);

        //get antrianmesin by ID
        $listspk = Antrianmesin::findOrFail($id);

        $listspk->update([
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
        return redirect()->route('listspk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $listspk = Antrianmesin::findOrFail($id);

        //delete post
        $listspk->delete();

        //redirect to index
        return redirect()->route('listspk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
