<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php
$msg = session()->getFlashdata('msg');
$err_msg = session()->getFlashdata('err_msg');
?>
<?php $errors = session()->getFlashdata('err'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1>Form Tambah Absensi</h1>
            <?php if ($err_msg): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $err_msg ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <form action="/absensi/add" method="post">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="nik" class="form-label">NIK</label>
                        <select class="form-select" aria-label="Default select example" id="nik" name="nik">
                            <option selected value="0">Open this select menu</option>
                            <?php foreach ($pegawai as $key => $value): ?>
                                <option value="<?= $value['nik'] ?>"><?= strtoupper($value['nama']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3 col">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date"
                            class="form-control <?= !empty($errors['date'] ?? null) ? 'is-invalid' : '' ?>" id="date"
                            name="date" value="<?= old('date') ? old('date') : '' ?>">
                        <div class="invalid-feedback">
                            <?= !empty($errors['date'] ?? null) ? $errors['date'] : ''; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="absen_masuk" class="form-label">Jam Masuk</label>
                        <input type="time"
                            class="form-control <?= !empty($errors['absen_masuk'] ?? null) ? 'is-invalid' : '' ?>"
                            id="absen_masuk" name="absen_masuk"
                            value="<?= old('absen_masuk') ? old('absen_masuk') : '' ?>">
                        <div class="invalid-feedback">
                            <?= !empty($errors['absen_masuk'] ?? null) ? $errors['absen_masuk'] : ''; ?>
                        </div>
                    </div>
                    <div class="mb-3 col">
                        <label for="absen_keluar" class="form-label">Jam keluar</label>
                        <input type="time"
                            class="form-control <?= !empty($errors['absen_keluar'] ?? null) ? 'is-invalid' : '' ?>"
                            id="absen_keluar" name="absen_keluar"
                            value="<?= old('absen_keluar') ? old('absen_keluar') : '' ?>">
                        <div class="invalid-feedback">
                            <?= !empty($errors['absen_keluar'] ?? null) ? $errors['absen_keluar'] : ''; ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/absensi" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>