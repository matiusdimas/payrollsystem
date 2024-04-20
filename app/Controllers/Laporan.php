<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\GajiModel;
use App\Models\PegawaiModel;

class Laporan extends BaseController
{
    protected $pegawai;
    protected $gaji;
    protected $absensi;

    public function __construct()
    {
        parent::__construct();
        $this->pegawai = new PegawaiModel();
        $this->gaji = new GajiModel();
        $this->absensi = new AbsensiModel();
    }

    public function index(): string
    {
        $data = [
            'title' => "Laporan",
            'laporan' => $this->absensi->getAbsensi(),
            'tahun' => $this->absensi->select('DISTINCT YEAR(date) as tahun')->findAll()
        ];
        return view('laporan/index', $data);
    }

    public function cetak()
    {
        if ($this->request->is('get')) {
            return redirect()->to('/laporan');
        }
        $rules = [
            'bulan' => ['rules' => 'required|min_length[2]'],
            'tahun' => ['rules' => 'required|min_length[2]'],
        ];
        $data = $this->request->getPost(array_keys($rules));
        $laporan = $this->absensi
            ->like(['date' => $data['tahun'] . '-' . $data['bulan']])
            ->join('pegawai', 'pegawai.nik = absensi.nik', 'left')
            ->findAll();
        if (!$laporan) {
            $this->session->setFlashdata('err_msg', 'Tidak Ada Laporan di bulan dan tahun tersebut');
            return redirect()->to('/laporan');
        }
        if (!$this->validateData($data, $rules)) {
            $this->session->setFlashdata('err_msg', 'Isi Pilihan Tahun dan Bulan');
            return redirect()->to('/laporan');
        }
        $this->session->setFlashdata('msg', "Bserhasil Dapat Laporan");
        $bulan = date('F', mktime(0, 0, 0, $data['bulan'], 1));
        $data['title'] = "Laporan Payroll $bulan " . $data['tahun'];
        $data['pegawai'] = $this->pegawai->getPegawai();
        $data['absensi'] = $laporan;

        return view('laporan/cetak', $data);
    }
}
