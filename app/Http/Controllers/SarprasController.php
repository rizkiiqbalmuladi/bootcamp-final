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
    public function create()
    {
        return view('dashboard.sarpras.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'ruangan' => 'required',
        ]);
        Sarpras::create($request->all());
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit(Sarpras $sarpras)
    {
        return view('dashboard.sarpras.edit', ['sarpras' => $sarpras]);
    }
    public function update(Request $request, Sarpras $sarpras)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'ruangan' => 'required',
        ]);
        $sarpras->update($request->all());
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil diupdate');
    }
    public function destroy(Sarpras $sarpras)
    {
        $sarpras->delete();
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil dihapus');
    }
}
