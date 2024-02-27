<?php

namespace App\Services;

use App\Models\Sekolah;

class SekolahService implements SekolahServiceInterface
{
    public function getSekolah()
    {
        return Sekolah::all()->first();
    }

    public function updateSekolah($data, $sekolah)
    {
        return $sekolah->update($data);
    }
}
