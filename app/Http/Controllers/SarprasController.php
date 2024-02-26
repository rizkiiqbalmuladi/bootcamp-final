<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use Illuminate\Http\Request;

class SarprasController extends Controller
{
    public function index()
    {
        $sarpras = Sarpras::get();
        return view('dashboard.sarpras.index', ['sarpras' => $sarpras]);
    }
}
