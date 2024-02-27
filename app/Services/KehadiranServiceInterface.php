<?php

namespace App\Services;

interface KehadiranServiceInterface
{
    public function getKehadiran();
    public function createKehadiran($data);
    public function updateKehadiran($data, $kehadiran);
    public function deleteKehadiran($kehadiran);
}
