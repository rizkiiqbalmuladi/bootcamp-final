<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUserByRoleId($role_id)
    {
        return User::with(['role', 'kelas'])->where('role_id', 'like', $role_id)->get();
    }
    public function createUser($data)
    {
        return User::create($data);
    }
    public function updateUser($data, $user)
    {
        return $user->update($data);
    }
    public function deleteUser($user)
    {
        return $user->delete();
    }
}
