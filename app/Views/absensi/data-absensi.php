<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php
$msg = session()->getFlashdata('msg');
$err_msg = session()->getFlashdata('err_msg');
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="mb-2">
        <a href="/absensi/add" class="btn btn-primary">Add</a>
    </div>
    <h1 class="h3 mb-2 text-gray-800">Data Absensi</h1>
    <?php if ($msg): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $msg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <?php if ($err_msg): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $err_msg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Absen Masuk</th>
                            <th scope="col">Absen Keluar</th>
                            <th scope="col">Telat</th>
                            <th scope="col">Pulang</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($absensi as $key => $value): ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td>
                                    <?= strtoupper($value['nik']) ?>
                                </td>
                                <td>
                                    <?= strtoupper($value['hari']) ?>
                                </td>
                                <td>
                                    <?= strtoupper(date("d F Y", strtotime($value['date']))) ?>
                                </td>
                                <td>
                                    <?= strtoupper($value['absen_masuk']) ?>
                                </td>
                                <td>
                                    <?= strtoupper($value['absen_keluar']) ?>
                                </td>
                                <td>
                                    <?= strtoupper($value['telat']) ?>
                                </td>
                                <td>
                                    <?= strtoupper($value['keluar']) ?>
                                </td>
                                <td>
                                    <a href="/absensi/edit/<?= esc($value['id']) ?>" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form class="d-inline-block" action="/absensi/delete/<?= $value['id'] ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            <?php endforeach ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
<?= $this->endSection() ?>