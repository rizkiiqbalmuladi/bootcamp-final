<?php

namespace App\Services;

use App\Models\Kehadiran;

class KehadiranService implements KehadiranServiceInterface
{
    public function getKehadiran()
    {
        return Kehadiran::with(['user', 'pertemuan'])->get();
    }
    public function createKehadiran($data)
    {
        return Kehadiran::create($data);
    }
    public function updateKehadiran($data, $kehadiran)
    {
        return $kehadiran->update($data);
    }
    public function deleteKehadiran($kehadiran)
    {
    }
}
