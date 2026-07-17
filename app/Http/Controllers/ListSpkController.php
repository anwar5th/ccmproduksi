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

use Illuminate\Support\Facades\Auth;

class ListSpkController extends Controller
{
 /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View
    {
        // Build query with eager load
        $query = Antrianmesin::with('proyekorder')->orderByRaw('tglcompleted IS NULL DESC')->orderBy('tglspk', 'desc');

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

        // filter tanggal SPK (exact or range)
        if ($request->filled('tglspk_from')) {
            $query->whereDate('tglspk', '>=', $request->tglspk_from);
        }

        if ($request->filled('tglspk_to')) {
            $query->whereDate('tglspk', '<=', $request->tglspk_to);
        }

        if ($request->filled('status')) {
            if ($request->status == 'selesai') {
                $query->whereNotNull('tglcompleted');
            } elseif ($request->status == 'proses') {
                $query->whereNull('tglcompleted');
            }
        }

        // Page length / per page
        $perPage = $request->perPage ? (int) $request->perPage : 10;
        $allowed = [5,10,25,50,100];
        if (!in_array($perPage, $allowed)) {
            $perPage = 10;
        }

        // Paginate and preserve query string
        $listspk = $query->paginate($perPage);
        $listspk->appends($request->query());

        // render view with posts
        return view('listspk.index', compact('listspk'));
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
        $listspk = compact('listspk');

        //get Proyekorder by ID
        $proyekorders = Proyekorder::findOrFail($listspk['listspk']->proyekorders_id);
        $proyekorders = compact('proyekorders');

        //render view with post
        return view('listspk.edit', [
            'listspk' => $listspk['listspk'],
            'proyekorders' => $proyekorders['proyekorders']
        ]);
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

            'tglcompleted'   => !empty($request->tglcompleted) ? $request->tglcompleted : null,
            'updated_by'     => Auth::id()
        ]);

        // Update dimensi dan drawing pada Proyekorder terkait
        if ($listspk->proyekorders_id) {
            $proyekorder = Proyekorder::find($listspk->proyekorders_id);
            if ($proyekorder) {
                $poData = [];

                // Update dimensi jika ada input
                if ($request->filled('dimensi')) {
                    $poData['dimensi'] = $request->dimensi;
                }

                // Upload drawing jika ada file baru
                if ($request->hasFile('drawing')) {
                    // Hapus file lama jika ada
                    if ($proyekorder->drawing_path) {
                        Storage::delete($proyekorder->drawing_path);
                    }
                    $drawingPath = $request->file('drawing')->store('drawings', 'public');
                    $poData['drawing_path'] = $drawingPath;
                }

                if (!empty($poData)) {
                    $proyekorder->update($poData);
                }
            }
        }

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
