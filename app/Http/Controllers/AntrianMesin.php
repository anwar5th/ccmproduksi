<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//return type View
use Illuminate\View\View;

class AntrianMesin extends Controller
{
 /**
     * index
     *
     * @return View
     */
    public function index(): View
    {

        //render view with proyekorders
        return view('antrianmesin.index');
    }
    
}

