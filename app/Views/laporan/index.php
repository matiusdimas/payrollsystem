<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php
$msg = session()->getFlashdata('msg');
$err_msg = session()->getFlashdata('err_msg');
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Cetak Laporan</h1>
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
    <form action="/laporan/cetak" method="post">
        <div class="row mb-2 ">
            <div class="col-2">
                <select class="form-select" name="bulan">
                    <option selected value="0">Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-2">
                <select class="form-select" name="tahun">
                    <option selected value="0">Pilih Bulan</option>
                    <?php foreach ($tahun as $value): ?>
                        <option value="<?= $value['tahun'] ?>"><?= $value['tahun'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-primary">Cetak</a>
            </div>
        </div>
    </form>
</div>

</div>
<?= $this->endSection() ?>