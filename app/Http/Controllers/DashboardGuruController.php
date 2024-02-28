<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\UserServiceInterface;

class DashboardGuruController extends Controller
{
    public $role_id;
    public function __construct(protected UserServiceInterface $userService)
    {
        $this->role_id = 2;
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
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
        $this->userService->createUser($validatedData);
        return redirect('/guru')->with('success', 'Data berhasil ditambahkan!');
    }
    public function edit(User $user)
    {
        return view('dashboard.guru.edit', ['user' => $user, 'role' => Role::where('name', '<>', 'admin')->get(), 'kelas' => Kelas::all()]);
    }
    public function update(UserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $this->userService->updateUser($validatedData, $user);
        return redirect()->route('guru.index');
    }
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return redirect()->route('guru.index');
    }
}
