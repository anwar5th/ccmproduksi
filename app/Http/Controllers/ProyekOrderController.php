<?php

namespace App\Http\Controllers;

//import Model "Proyekorder
use App\Models\Proyekorder;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class ProyekOrderController extends Controller
{
   /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get proyekorders
        $proyekorders = Proyekorder::latest()->paginate(5);

        //render view with proyekorders
        return view('proyekorders.index', compact('proyekorders'));
    }

// MEMBUAT CONTROLLER CREATE

        /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('proyekorders.create');
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
            'kodepo'     => 'required|min:3',
            'namaproyek'   => 'required|min:5',
            'keteranganpoitem'   => 'required|min:5',
        ]);

        //create post
        Post::create([
            'kodepo'     => $request->kodepo,
            'namaproyek'   => $request->namaproyek,
            'tglpo'   => $request->tglpo,
            'keteranganpoitem'   => $request->keteranganpoitem,
        ]);

        //redirect to index
        return redirect()->route('proyekorders.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
