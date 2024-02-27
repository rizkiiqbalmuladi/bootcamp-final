<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardSiswaController extends Controller
{
    public $role_id;
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->role_id = 3;
        $this->userService = $userService;
    }
    public function index()
    {
        $user = $this->userService->getUserByRoleId($this->role_id);
        return view('dashboard.guru.index', ['user' => $user]);
    }
}
