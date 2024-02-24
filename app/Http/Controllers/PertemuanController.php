<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    public function index()
    {
        $pertemuan = Pertemuan::with(['user', 'kelas'])->get();
        return view('dashboard.pertemuan.index', compact('pertemuan'));
    }
    public function create()
    {
        return view('dashboard.pertemuan.create', ['kelas' => Kelas::all()]);
    }
    public function store(Request $request)
    {
        Pertemuan::create($request->all());
        return redirect()->route('pertemuan.index');
    }
    public function edit(Pertemuan $pertemuan)
    {
        return view('dashboard.pertemuan.edit', ['pertemuan' => $pertemuan, 'kelas' => Kelas::all()]);
    }
    public function update(Request $request, pertemuan $pertemuan)
    {
        $pertemuan->tanggal = $request->tanggal;
        $pertemuan->kelas_id = $request->kelas_id;
        $pertemuan->user_id = $request->user_id;
        $pertemuan->save();
        return redirect()->route('pertemuan.index');
    }
    public function destroy(Pertemuan $pertemuan)
    {
        $pertemuan->delete();
        return redirect()->route('pertemuan.index');
    }
}
