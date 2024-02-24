<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;

class DashboardSiswaController extends Controller
{
    public $role_id;
    public function __construct()
    {
        $this->role_id = 3;
    }
    public function index()
    {
        $user = User::with(['role', 'kelas'])->where('role_id', 'like', $this->role_id)->get();
        return view('dashboard.guru.index', ['user' => $user]);
    }
}
