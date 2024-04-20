<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    protected $useAutoIncrement = false;
    protected $primaryKey = 'nik';
    protected $allowedFields = ['nik', 'nama', 'jabatan'];
    public function getPegawai()
    {

        return $this
            ->join('gaji', 'pegawai.nik = gaji.nik')
            ->findAll();
    }

    public function wherePegawai($where)
    {
        return $this
            ->select('pegawai.*, gaji.gaji_pokok, gaji.tunjangan')
            ->where($where) // Example condition based on 'nik'
            ->join('gaji', 'pegawai.nik = gaji.nik', 'inner')
            ->first();
    }

    public function addPegawai($data)
    {
        return $this->insert($data);
    }
}