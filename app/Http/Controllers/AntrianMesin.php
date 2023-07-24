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

class AntrianMesin extends Controller
{
 /**
     * index
     *
     * @return View
     */
    public function index(): View
    {

        //get posts
        $antrianmesin = Antrianmesin::latest()->paginate(5);

        //render view with posts
        return view('antrianmesin.index', compact('antrianmesin'));
    }
    
}

