<?php
$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$hari_pertama = new \DateTime("$tahun-$bulan-01");
$minggu = 0;
$sabtu = 0;
for ($i = 0; $i < $jumlah_hari; $i++) {
    $hari = clone $hari_pertama;
    $hari->add(new \DateInterval('P' . $i . 'D'));
    if ($hari->format('N') == 6) { // Sabtu
        $sabtu++;
    } elseif ($hari->format('N') == 7) { // Minggu
        $minggu++;
    }
}
$hari_kerja = $jumlah_hari - ($sabtu + $minggu);


function rupiah($nilai_php)
{
    return "Rp. " . number_format($nilai_php, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Payroll</title>
    <style>
        /* Style CSS untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Style CSS untuk judul */
        .judul {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Style CSS untuk catatan */
        .note {
            font-style: italic;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1 class="judul"><?= $title ?></h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>NIK</th>
            <th>Jabatan</th>
            <th>Gaji Pokok</th>
            <th>Tunjangan</th>
            <th>Total Gaji</th>
            <th>Total Keterlambatan</th>
            <th>Total Kehadiran</th>
            <th>Total Tidak Masuk Kerja</th>
            <th>Akumulasi Gaji</th>
        </tr>
        <?php foreach ($pegawai as $key => $pegawai_item): ?>
            <tr>
                <td><?= $pegawai_item['nama'] ?></td>
                <td><?= $pegawai_item['nik'] ?></td>
                <td><?= $pegawai_item['jabatan'] ?></td>
                <td><?= rupiah($pegawai_item['gaji_pokok']) ?></td>
                <td><?= rupiah($pegawai_item['tunjangan']) ?></td>
                <td><?= rupiah($pegawai_item['tunjangan'] + $pegawai_item['gaji_pokok']) ?></td>

                <?php
                // Inisialisasi variabel $telat dan $kehadiran di setiap iterasi pegawai
                $telat = 0;
                $kehadiran = 0;
                ?>

                <?php foreach ($absensi as $value): ?>
                    <?php if ($value['nik'] === $pegawai_item['nik']): ?>
                        <?php
                        if ($value['telat'] === "TELAT") {
                            $telat++;
                        }
                        if ($value['date']) {
                            $kehadiran++;
                        }
                        ?>
                    <?php endif ?>
                <?php endforeach ?>

                <?php
                // Menghitung jumlah pengurangan berdasarkan keterlambatan dan tidak masuk kerja
                $pengurangan_keterlambatan = $telat * 50000; // Setiap telat dikurangi 50 ribu
                $pengurangan_tidak_masuk = ($hari_kerja - $kehadiran) * 150000; // Setiap tidak masuk kerja dikurangi 150 ribu
            
                // Menghitung total gaji setelah pengurangan
                $total_gaji_setelah_pengurangan = ($pegawai_item['tunjangan'] + $pegawai_item['gaji_pokok']) - ($pengurangan_keterlambatan + $pengurangan_tidak_masuk);
                ?>

                <td><?= $telat ?></td>
                <td><?= $kehadiran ?></td>
                <td><?= $hari_kerja - $kehadiran ?></td>
                <td><?= rupiah($total_gaji_setelah_pengurangan) ?></td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="5" class="note">
                Catatan: Setiap keterlambatan akan dikenai potongan gaji sebesar 50.000 IDR dan setiap ketidakhadiran
                akan dikenai potongan gaji sebesar 150.000 IDR.
            </td>
        </tr>
    </table>
</body>
<script>
    window.print();
</script>

</html>