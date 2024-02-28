<?php

namespace App\Services;

interface LoginServiceInterface
{
    public function login($credentials);
    public function logout();
}
