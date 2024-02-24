<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function store()
    {
        $this->validate(request(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if (!auth()->attempt(request(['username', 'password']))) {
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
