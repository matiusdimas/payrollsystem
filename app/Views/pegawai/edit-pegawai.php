<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<?php $errors = session()->getFlashdata('err'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1>Form Edit Pegawai</h1>
            <?php if (!empty($pegawai)): ?>
                <form action="/edit/<?= $pegawai['nik'] ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text"
                                class="form-control <?= !empty($errors['nik'] ?? null) ? 'is-invalid' : '' ?>" id="nik"
                                name="nik" value="<?= old('nik') ? old('nik') : $pegawai['nik'] ?>" disabled>
                            <div class=" invalid-feedback">
                                <?= !empty($errors['nik'] ?? null) ? $errors['nik'] : ''; ?>
                            </div>
                        </div>
                        <div class="mb-3 col">
                            <label for="nama" class="form-label">Nama Pegawai</label>
                            <input type="text"
                                class="form-control <?= !empty($errors['nama'] ?? null) ? 'is-invalid' : '' ?>" id="nama"
                                name="nama" value="<?= old('nama') ? old('nama') : $pegawai['nama'] ?>">
                            <div class="invalid-feedback">
                                <?= !empty($errors['nama'] ?? null) ? $errors['nama'] : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text"
                                class="form-control <?= !empty($errors['jabatan'] ?? null) ? 'is-invalid' : '' ?>"
                                id="jabatan" name="jabatan"
                                value="<?= old('jabatan') ? old('jabatan') : $pegawai['jabatan'] ?>">
                            <div class="invalid-feedback">
                                <?= !empty($errors['jabatan'] ?? null) ? $errors['jabatan'] : ''; ?>
                            </div>
                        </div>
                        <div class="mb-3 col">
                            <label for="gaji_pokok" class="form-label">Gaji Pokok (Rp)</label>
                            <input type="number"
                                class="form-control <?= !empty($errors['gaji_pokok'] ?? null) ? 'is-invalid' : '' ?>"
                                id="gaji_pokok" name="gaji_pokok"
                                value="<?= old('gaji_pokok') ? old('gaji_pokok') : $pegawai['gaji_pokok'] ?>">
                            <div class="invalid-feedback">
                                <?= !empty($errors['gaji_pokok'] ?? null) ? $errors['gaji_pokok'] : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="tunjangan" class="form-label">Tunjangan (Rp)</label>
                            <input type="number"
                                class="form-control <?= !empty($errors['tunjangan'] ?? null) ? 'is-invalid' : '' ?>"
                                id="tunjangan" name="tunjangan"
                                value="<?= old('tunjangan') ? old('tunjangan') : $pegawai['tunjangan'] ?>">
                            <div class="invalid-feedback">
                                <?= !empty($errors['tunjangan'] ?? null) ? $errors['tunjangan'] : ''; ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/" class="btn btn-danger">Back</a>
                </form>
            <?php else: ?>
                <p>No Data</p>
            <?php endif ?>

        </div>
    </div>
</div>
<?= $this->endSection() ?>