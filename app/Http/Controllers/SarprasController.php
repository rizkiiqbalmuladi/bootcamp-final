<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use Illuminate\Http\Request;
use App\Http\Requests\SarprasRequest;
use App\Services\SarprasServiceInterface;

class SarprasController extends Controller
{
    public function __construct(protected SarprasServiceInterface $sarprasService)
    {
    }
    public function index()
    {
        $sarpras = $this->sarprasService->getAll();
        return view('dashboard.sarpras.index', ['sarpras' => $sarpras]);
    }
    public function create()
    {
        return view('dashboard.sarpras.create');
    }
    public function store(SarprasRequest $request)
    {
        $this->sarprasService->createSarpras($request->validated());
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit(Sarpras $sarpras)
    {
        return view('dashboard.sarpras.edit', ['sarpras' => $sarpras]);
    }
    public function update(SarprasRequest $request, Sarpras $sarpras)
    {
        $this->sarprasService->updateSarpras($request->validated(), $sarpras);
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil diupdate');
    }
    public function destroy(Sarpras $sarpras)
    {
        $this->sarprasService->deleteSarpras($sarpras);
        return redirect()->route('sarpras.index')->with('success', 'Data berhasil dihapus');
    }
}
