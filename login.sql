-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2024 pada 00.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_datawarga`
--

CREATE TABLE `tb_datawarga` (
  `id_warga` int(11) NOT NULL,
  `nama_warga` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_datawarga`
--

INSERT INTO `tb_datawarga` (`id_warga`, `nama_warga`, `jenis_kelamin`, `pekerjaan`, `no_telpon`, `email`) VALUES
(1, 'Dika Maulana Putra Pratama', 'Laki-Laki', 'Mahasiswa', '081256973412', 'dpratama397@gmail.com'),
(2, 'Karina Dinda Artanti', 'Perempuan', 'Mahasiswa', '012373267891', 'karindawartanti@gmail.com'),
(3, 'Nabilah Sahda Firjatullah', 'Perempuan', 'Mahasiswa', '081234567891', 'nabilahsahdaf@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_warga` int(11) NOT NULL,
  `nama_warga` varchar(50) NOT NULL,
  `tanggal_pembayaran` date NOT NULL DEFAULT current_timestamp(),
  `status_pembayaran` text NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `jumlah_pembayaran` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_warga`, `nama_warga`, `tanggal_pembayaran`, `status_pembayaran`, `bukti_pembayaran`, `jumlah_pembayaran`) VALUES
(1, 'Dika Maulana Putra Pratama', '2024-05-01', 'Lunas', 'Screenshot 2024-05-04 132510.png', '200.000'),
(2, 'Karina Dinda Artanti', '2024-05-02', 'Belum Lunas', 'Screenshot 2024-05-02 092520.png', '100.000'),
(3, 'Nabilah Sahda Firjatullah', '2024-05-09', 'Lunas', 'Screenshot 2024-05-02 091045.png', '200.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `jumlah_pengeluaran` varchar(20) NOT NULL,
  `saldo` varchar(20) NOT NULL,
  `tanggal_pengeluaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `jumlah_pengeluaran`, `saldo`, `tanggal_pengeluaran`) VALUES
(1, '100.000', '15.000.000', '2024-04-17'),
(2, '250.000', '15.750.000', '2024-05-08'),
(3, '300.000', '15.450.000', '2024-05-09'),
(4, '500.000', '14.950.000', '2024-05-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'dpratama397@gmail.com', '123', '2024-04-29 11:54:56'),
(2, 'dikapratama397@gmail.com', '123', '2024-04-29 13:20:02'),
(3, 'karindawartanti@gmail.com', '123', '2024-05-01 23:14:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_datawarga`
--
ALTER TABLE `tb_datawarga`
  ADD PRIMARY KEY (`id_warga`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_warga`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_datawarga`
--
ALTER TABLE `tb_datawarga`
  MODIFY `id_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
