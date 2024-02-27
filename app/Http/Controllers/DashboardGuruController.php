<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    public $role_id;
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->role_id = 2;
        $this->userService = $userService;
    }
    public function index()
    {
        $user = $this->userService->getUserByRoleId($this->role_id);
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
        $this->userService->createUser($validatedData);
        return redirect('/guru')->with('success', 'Data berhasil ditambahkan!');
    }
    public function edit(User $user)
    {
        return view('dashboard.guru.edit', ['user' => $user, 'role' => Role::where('name', '<>', 'admin')->get(), 'kelas' => Kelas::all()]);
    }
    public function update(Request $request, User $user)
    {
        $this->userService->updateUser($request->all(), $user);
        return redirect()->route('guru.index');
    }
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return redirect()->route('guru.index');
    }
}
