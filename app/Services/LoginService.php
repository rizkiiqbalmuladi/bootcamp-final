<?php

namespace App\Services;

class LoginService implements LoginServiceInterface
{
    public function login($credentials)
    {
        return auth()->attempt($credentials->only('email', 'password'));
    }
    public function logout()
    {
    }
}
