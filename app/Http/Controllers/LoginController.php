<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function store(LoginRequest $request)
    {
        $validated = $request->validated();
        if (!auth()->attempt($validated)) {
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
