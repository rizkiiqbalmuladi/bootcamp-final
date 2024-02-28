<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pertemuan;
use App\Services\PertemuanServiceInterface;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    public function __construct(protected PertemuanServiceInterface $pertemuanService)
    {
    }
    public function index()
    {
        $pertemuan = $this->pertemuanService->getPertemuan();
        return view('dashboard.pertemuan.index', compact('pertemuan'));
    }
    public function create()
    {
        return view('dashboard.pertemuan.create', ['kelas' => Kelas::all()]);
    }
    public function store(Request $request)
    {
        $this->pertemuanService->createPertemuan($request->all());
        return redirect()->route('pertemuan.index');
    }
    public function edit(Pertemuan $pertemuan)
    {
        return view('dashboard.pertemuan.edit', ['pertemuan' => $pertemuan, 'kelas' => Kelas::all()]);
    }
    public function update(Request $request, pertemuan $pertemuan)
    {
        $this->pertemuanService->updatePertemuan($request->all(), $pertemuan);
        return redirect()->route('pertemuan.index');
    }
    public function destroy(Pertemuan $pertemuan)
    {
        $this->pertemuanService->deletePertemuan($pertemuan);
        return redirect()->route('pertemuan.index');
    }
}
