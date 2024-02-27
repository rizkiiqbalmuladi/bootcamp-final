<?php

namespace App\Services;

interface UserServiceInterface
{
    public function getUserByRoleId($role_id);
    public function createUser($data);
    public function updateUser($data, $user);
    public function deleteUser($user);
}
