<?php

namespace App\Services;

use App\Models\Sarpras;

class SarprasService implements SarprasServiceInterface
{
    public function getAll()
    {
        return Sarpras::get();
    }

    public function createSarpras($data)
    {
        return Sarpras::create($data);
    }
    public function updateSarpras($data, $sarpras)
    {
        return $sarpras->update($data);
    }
    public function deleteSarpras($sarpras)
    {
        return $sarpras->delete();
    }
}
