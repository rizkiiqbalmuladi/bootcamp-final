<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    public $role_id;
    public function __construct()
    {
        $this->role_id = 2;
    }
    public function index()
    {
        $user = User::with(['role', 'kelas'])->where('role_id', 'like', $this->role_id)->get();
        return view('dashboard.guru.index', ['user' => $user]);
    }
    public function create()
    {
        return view('dashboard.guru.create', ['role' => Role::where('name', '<>', 'admin')->get(), 'kelas' => Kelas::all()]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'required|min:8',
            'alamat' => 'max:255',
            'role_id' => 'required',
            'kelas_id' => 'required'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return redirect('/guru')->with('success', 'Data berhasil ditambahkan!');
    }
    public function edit(User $user)
    {
        return view('dashboard.guru.edit', ['user' => $user, 'role' => Role::where('name', '<>', 'admin')->get(), 'kelas' => Kelas::all()]);
    }
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->username = $request->username;
        $user->username = $request->username;
        $user->alamat = $request->alamat;
        $user->role_id = $request->role_id;
        $user->kelas_id = $request->kelas_id;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('guru.index');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('guru.index');
    }
}
