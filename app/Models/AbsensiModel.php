<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = 'absensi';
    protected $allowedFields = ['nik', 'absen_masuk', 'absen_keluar', 'date', 'id_hari', 'telat', 'keluar'];
    public function getAbsensi()
    {
        return $this
            ->select('absensi.* , hari.nama as hari')
            ->join('hari', 'absensi.id_hari = hari.id', 'inner')
            ->findAll();
    }
}