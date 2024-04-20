<?php

namespace App\Controllers;

use App\Models\GajiModel;
use App\Models\HariModel;
use App\Models\PegawaiModel;

class Hari extends BaseController
{
    protected $pegawai;
    protected $gaji;

    protected $hari;

    public function __construct()
    {
        parent::__construct();
        $this->pegawai = new PegawaiModel();
        $this->gaji = new GajiModel();
        $this->hari = new HariModel();

    }

    public function index(): string
    {
        $data = [
            'title' => "Data Hari",
            'hari' => $this->hari->findAll()
        ];
        return view('hari/data-hari', $data);
    }

    public function add()
    {
        if ($this->request->is('get')) {
            $data = [
                'title' => "Form Tambah Hari"
            ];
            return view('hari/add-hari', $data);
        }
        $rules = [
            'nik' => ['rules' => 'required|min_length[16]|numeric|is_unique[pegawai.nik]'],
            'nama' => ['rules' => 'required|max_length[255]|min_length[3]'],
            'jabatan' => ['rules' => 'required|max_length[255]|min_length[3]'],
            'gaji_pokok' => ['rules' => 'required|max_length[255]|min_length[3]|numeric'],
            'tunjangan' => ['rules' => 'required|max_length[255]|min_length[3]|numeric'],
        ];
        $data = $this->request->getPost(array_keys($rules));
        if (!$this->validateData($data, $rules)) {
            $this->session->setFlashdata('err', $this->validator->getErrors());
            return redirect()->to('/add')->withInput();
        }
        $this->pegawai->addPegawai($data);
        $this->gaji->insert($data);
        $this->session->setFlashdata('msg', "Berhasil Tambah Pegawai");
        return redirect()->to('/');
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
    public function delete($nik)
    {
        $this->pegawai->delete($nik);
        $this->session->setFlashdata('msg', "Berhasil Hapus Pegawai");
        return redirect()->to('/');
    }
}
