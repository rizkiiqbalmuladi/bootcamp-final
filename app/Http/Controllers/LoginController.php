<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginServiceInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(protected LoginServiceInterface $loginService)
    {
    }
    public function index()
    {
        return view('login');
    }
    public function store(LoginRequest $request)
    {
        if (!$this->loginService->login($request->validated())) {
            return back()->withErrors([
                'message' => 'Please check your credentials'
            ]);
        }
        return to_route('sekolah.index');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('login');
    }
}
