<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Services\SekolahService;
use App\Http\Requests\SekolahRequest;

class DashboardController extends Controller
{
    protected $sekolahService;
    public function __construct(SekolahService $sekolahService)
    {
        $this->sekolahService = $sekolahService;
    }
    public function index()
    {
        $sekolah = $this->sekolahService->getSekolah();
        return view('dashboard.sekolah.index', [
            'sekolah' => $sekolah,
        ]);
    }
    public function edit(Sekolah $sekolah)
    {
        return view('dashboard.sekolah.edit', ['sekolah' => $sekolah]);
    }
    public function update(SekolahRequest $request, Sekolah $sekolah)
    {
        $this->sekolahService->updateSekolah($request->validated(), $sekolah);
        return redirect()->route('sekolah.index');
    }
}
