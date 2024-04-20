<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php $msg = session()->getFlashdata('msg'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="mb-2">
        <a href="/add" class="btn btn-primary">Add</a>
    </div>
    <h1 class="h3 mb-2 text-gray-800">Data Pegawai</h1>
    <?php if ($msg): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $msg ?>
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
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pegawai as $key => $value): ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td>
                                    <?= strtoupper($value['nama']) ?>
                                </td>
                                <td>
                                    <?= strtoupper($value['jabatan']) ?>
                                </td>
                                <td>
                                    <a href="/edit/<?= esc($value['nik']) ?>" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form class="d-inline-block" action="/delete/<?= $value['nik'] ?>" method="post">
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