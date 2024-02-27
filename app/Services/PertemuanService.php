<?php

namespace App\Services;

use App\Models\Pertemuan;

class PertemuanService implements PertemuanServiceInterface
{
    public function getPertemuan()
    {
        return Pertemuan::with(['user', 'kelas'])->get();
    }
    public function createPertemuan($data)
    {
        return Pertemuan::create($data);
    }
    public function updatePertemuan($data, $pertemuan)
    {
        return $pertemuan->update($data);
    }
    public function deletePertemuan($pertemuan)
    {
        return $pertemuan->delete();
    }
}
