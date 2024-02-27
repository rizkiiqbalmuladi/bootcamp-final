<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use Illuminate\Http\Request;
use App\Http\Requests\SarprasRequest;

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
    public function store(SarprasRequest $request)
    {

        Sarpras::create($request->validated());
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit(Sarpras $sarpras)
    {
        return view('dashboard.sarpras.edit', ['sarpras' => $sarpras]);
    }
    public function update(SarprasRequest $request, Sarpras $sarpras)
    {
        $sarpras->update($request->validated());
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil diupdate');
    }
    public function destroy(Sarpras $sarpras)
    {
        $sarpras->delete();
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil dihapus');
    }
}
