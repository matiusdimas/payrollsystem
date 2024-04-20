<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\GajiModel;
use App\Models\HariModel;
use App\Models\PegawaiModel;

class Absensi extends BaseController
{
    protected $pegawai;
    protected $gaji;
    protected $absensi;
    protected $hari;


    public function __construct()
    {
        parent::__construct();
        $this->pegawai = new PegawaiModel();
        $this->gaji = new GajiModel();
        $this->absensi = new AbsensiModel();
        $this->hari = new HariModel();

    }

    public function index(): string
    {
        $data = [
            'title' => "Data Absensi",
            'absensi' => $this->absensi->getAbsensi()
        ];
        return view('absensi/data-absensi', $data);
    }

    public function add()
    {
        if ($this->request->is('get')) {
            $data = [
                'title' => "Form Tambah Absensi",
                'hari' => $this->hari->findAll(),
                'pegawai' => $this->pegawai->findAll()
            ];
            return view('absensi/add-absensi', $data);
        }
        $rules = [
            'nik' => ['rules' => 'required|min_length[16]|numeric'],
            'date' => ['rules' => 'required|max_length[255]|min_length[3]'],
            'absen_masuk' => ['rules' => 'required|max_length[255]|min_length[3]'],
            'absen_keluar' => ['rules' => 'required|max_length[255]|min_length[3]'],
        ];

        $data = $this->request->getPost(array_keys($rules));

        // check hari
        $hari = findHari($data['date']);
        $checkHari = $this->hari->where(['nama' => $hari])->first();

        if ($checkHari == null) {
            $this->session->setFlashdata('err_msg', "Gagal Tidak ada jam kerja di hari tersebut");
            return redirect()->to('/absensi/add')->withInput();
        }

        $data['id_hari'] = $checkHari['id'];
        $data['absen_masuk'] = $data['absen_masuk'] . ':00';
        $data['absen_keluar'] = $data['absen_keluar'] . ':00';
        $checkTanggal = $this->absensi->where(['date' => $data['date'], 'nik' => $data['nik']])->first();
        if ($checkTanggal > 0) {
            $this->session->setFlashdata('err_msg', "Gagal Pegawai Telah Absensi di hari tersebut");
            return redirect()->to('/absensi/add')->withInput();
        }

        // keterlambatan
        $waktuabsensi = keterlambatan($checkHari['jam_masuk'], $data['absen_masuk']);
        $data['telat'] = $waktuabsensi ? 'TIDAK TELAT' : 'TELAT';

        // jam pulang
        $waktupulang = pulang($checkHari['jam_keluar'], $data['absen_keluar']);
        $data['keluar'] = $waktupulang ? 'BElUM WAKTUNYA' : 'TEPAT WAKTU';

        if (!$this->validateData($data, $rules)) {
            $this->session->setFlashdata('err', $this->validator->getErrors());
            return redirect()->to('/absensi/add')->withInput();
        }
        $this->absensi->insert($data);
        $this->session->setFlashdata('msg', "Berhasil Tambah Absensi");
        return redirect()->to('/absensi');
    }

    public function edit($nik)
    {
        if ($this->request->is('get')) {
            $data = [
                'title' => "Form Edit Pegawai",
                'pegawai' => $this->pegawai->wherePegawai(['pegawai.nik' => $nik])
            ];
            return view('pegawai/edit-pegawai', $data);
        }
        $rules = [
            'nik' => ['rules' => 'required|min_length[16]|numeric'],
            'nama' => ['rules' => 'required|max_length[255]|min_length[3]'],
            'jabatan' => ['rules' => 'required|max_length[255]|min_length[3]'],
            'gaji_pokok' => ['rules' => 'required|max_length[255]|min_length[3]|numeric'],
            'tunjangan' => ['rules' => 'required|max_length[255]|min_length[3]|numeric'],
        ];
        $data = $this->request->getPost(array_keys($rules));
        $data['nik'] = $nik;
        if (!$this->validateData($data, $rules)) {
            $this->session->setFlashdata('err', $this->validator->getErrors());
            return redirect()->to('/edit/' . $nik)->withInput();
        }
        $this->pegawai->save($data);
        $this->gaji->where(['nik' => $nik])->set($data)->update();
        $this->session->setFlashdata('msg', "Berhasil Edit Pegawai");
        return redirect()->to('/');
    }
    public function delete($id)
    {
        $this->absensi->delete($id);
        $this->session->setFlashdata('msg', "Berhasil Hapus Absensi");
        return redirect()->to('/absensi');
    }
}
