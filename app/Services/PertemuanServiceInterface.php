<?php

namespace App\Services;

interface PertemuanServiceInterface
{
    public function getPertemuan();
    public function createPertemuan($data);
    public function updatePertemuan($data, $pertemuan);
    public function deletePertemuan($pertemuan);
}
