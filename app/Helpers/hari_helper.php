<?php
function findHari($data)
{
    $dateString = $data;
    $timestamp = strtotime($dateString);
    $dayOfWeek = date("l", $timestamp);
    $hari = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    );
    return $hari[$dayOfWeek];
}

function keterlambatan($waktupasti, $waktumasuk)
{
    // Waktu yang diberikan
    $waktuDiberikan = new \DateTime($waktupasti);
    $waktuDiinginkan = clone $waktuDiberikan;
    $waktuDiinginkan->add(new \DateInterval('PT15M'));
    echo "Waktu yang diinginkan: " . $waktuDiinginkan->format('H:i:s') . "<br>";
    $waktuSebenarnya = new \DateTime($waktumasuk);
    if ($waktuSebenarnya > $waktuDiinginkan) {
        return false;
    } elseif ($waktuSebenarnya == $waktuDiinginkan) {
        return true;
    } else {
        return true;
    }
}

function pulang($waktupasti, $waktumasuk)
{
    $waktuDipastikan = new DateTime($waktumasuk); // Misalnya, waktu sekarang adalah jam 17:00
    $waktuPulang = new DateTime($waktupasti); // Waktu pulang, misalnya jam 16:00
    if ($waktuDipastikan == $waktuPulang || $waktuDipastikan > $waktuPulang) {
        return false;
    } else {
        return true;
    }
}
?>