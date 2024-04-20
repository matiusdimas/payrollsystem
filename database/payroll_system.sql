-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2024 pada 12.11
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_system`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_hari` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `absen_masuk` time DEFAULT NULL,
  `absen_keluar` time DEFAULT NULL,
  `telat` enum('TELAT','TIDAK TELAT') NOT NULL DEFAULT 'TIDAK TELAT',
  `keluar` enum('BELUM WAKTUNYA','TEPAT WAKTU') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `nik`, `id_hari`, `date`, `absen_masuk`, `absen_keluar`, `telat`, `keluar`) VALUES
(12, '3175031506040041', 2, '2024-04-23 00:00:00', '03:18:00', '15:19:00', 'TIDAK TELAT', 'BELUM WAKTUNYA'),
(13, '3175031506040124', 2, '2024-04-30 00:00:00', '03:20:00', '16:00:00', 'TIDAK TELAT', 'TEPAT WAKTU'),
(14, '3175031506040041', 2, '2024-04-16 00:00:00', '03:21:00', '16:10:00', 'TIDAK TELAT', 'TEPAT WAKTU'),
(15, '3175031506040041', 2, '2024-04-02 00:00:00', '03:22:00', '15:59:00', 'TIDAK TELAT', 'BELUM WAKTUNYA'),
(16, '3175031506040041', 1, '2024-04-29 00:00:00', '22:23:00', '23:23:00', 'TELAT', 'TEPAT WAKTU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tunjangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id`, `nik`, `gaji_pokok`, `tunjangan`) VALUES
(4, '3175031506040041', 10000000, 2000000),
(6, '3175031506040124', 1000000, 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `status` enum('LIBUR','TIDAK LIBUR') NOT NULL DEFAULT 'TIDAK LIBUR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id`, `nama`, `jam_masuk`, `jam_keluar`, `status`) VALUES
(1, 'senin', '09:00:00', '15:00:00', 'TIDAK LIBUR'),
(2, 'selasa', '09:00:00', '16:00:00', 'TIDAK LIBUR'),
(3, 'rabu', '08:00:00', '17:00:00', 'TIDAK LIBUR'),
(4, 'kamis', '07:00:00', '14:00:00', 'TIDAK LIBUR'),
(5, 'jumat', '08:00:00', '16:00:00', 'TIDAK LIBUR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nik`, `nama`, `jabatan`) VALUES
('3175031506040041', 'matius', 'staff'),
('3175031506040124', 'prasetia', 'direktur');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pegawai` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
