<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::all()->first();
        return view('dashboard.sekolah.index', [
            'sekolah' => $sekolah,
        ]);
    }
    public function edit(Sekolah $sekolah)
    {
        return view('dashboard.sekolah.edit', ['sekolah' => $sekolah]);
    }
    public function update(Request $request, Sekolah $sekolah)
    {
        $sekolah->name = $request->name;
        $sekolah->address = $request->address;
        $sekolah->phone = $request->phone;
        $sekolah->save();
        return redirect()->route('sekolah.index');
    }
}
