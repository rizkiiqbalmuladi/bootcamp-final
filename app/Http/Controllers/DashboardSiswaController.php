<?php

namespace App\Http\Controllers;

use App\Services\UserServiceInterface;

class DashboardSiswaController extends Controller
{
    public $role_id;
    public function __construct(protected UserServiceInterface $userService)
    {
        $this->role_id = 3;
    }
    public function index()
    {
        $user = $this->userService->getUserByRoleId($this->role_id);
        return view('dashboard.guru.index', ['user' => $user]);
    }
}
