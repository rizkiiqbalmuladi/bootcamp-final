<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Pertemuan;
use App\Models\User;
use App\Services\KehadiranServiceInterface;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function __construct(protected KehadiranServiceInterface $kehadiranService)
    {
    }
    public function index()
    {
        $kehadiran = $this->kehadiranService->getKehadiran();
        return view('dashboard.kehadiran.index', compact('kehadiran'));
    }
    public function create()
    {
        return view('dashboard.kehadiran.create', ['pertemuan' => Pertemuan::all(), 'users' => User::all()]);
    }
    public function store(Request $request)
    {
        $this->kehadiranService->createKehadiran($request->all());
        return redirect()->route('kehadiran.index');
    }
    public function edit(Kehadiran $kehadiran)
    {
        return view('dashboard.kehadiran.edit', ['kehadiran' => $kehadiran, 'pertemuan' => Pertemuan::all(), 'users' => User::all()]);
    }
    public function update(Request $request, Kehadiran $kehadiran)
    {
        $this->kehadiranService->updateKehadiran($request->all(), $kehadiran);
        return redirect()->route('kehadiran.index');
    }
    public function destroy(Kehadiran $kehadiran)
    {
        $this->kehadiranService->deleteKehadiran($kehadiran);
        return redirect()->route('kehadiran.index');
    }
}
