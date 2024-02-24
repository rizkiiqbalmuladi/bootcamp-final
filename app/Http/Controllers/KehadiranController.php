<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Pertemuan;
use App\Models\User;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index()
    {
        $kehadiran = Kehadiran::with(['user', 'pertemuan'])->get();
        return view('dashboard.kehadiran.index', compact('kehadiran'));
    }
    public function store(Request $request)
    {
        Kehadiran::create($request->all());
        return redirect()->route('kehadiran.index');
    }
    public function create()
    {
        return view('dashboard.kehadiran.create', ['pertemuan' => Pertemuan::all(), 'users' => User::all()]);
    }
    public function edit(Kehadiran $kehadiran)
    {
        return view('dashboard.kehadiran.edit', ['kehadiran' => $kehadiran, 'pertemuan' => Pertemuan::all(), 'users' => User::all()]);
    }
    public function update(Request $request, Kehadiran $kehadiran)
    {
        $kehadiran->update($request->all());
        return redirect()->route('kehadiran.index');
    }
    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();
        return redirect()->route('kehadiran.index');
    }
}
