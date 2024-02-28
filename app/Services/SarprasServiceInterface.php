<?php

namespace App\Services;

interface SarprasServiceInterface
{
    public function getAll();
    public function createSarpras($data);
    public function updateSarpras($data, $sarpras);
    public function deleteSarpras($sarpras);
}
