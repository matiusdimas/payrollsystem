<?php

namespace App\Models;

use CodeIgniter\Model;

class GajiModel extends Model
{
    protected $table = 'gaji';
    protected $allowedFields = ['nik', 'gaji_pokok', 'tunjangan'];

    public function addPegawai($data)
    {
        return $this->insert($data);
    }
}