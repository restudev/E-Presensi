-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2023 pada 04.13
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblabsen`
--

CREATE TABLE `tblabsen` (
  `id` int(8) NOT NULL,
  `nama_siswa` text NOT NULL,
  `nis` varchar(27) NOT NULL,
  `kelas` int(4) NOT NULL,
  `masuk1` time(1) NOT NULL,
  `masuk2` time(1) NOT NULL,
  `masuk3` time(1) NOT NULL,
  `tgl_absen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tblabsen`
--

INSERT INTO `tblabsen` (`id`, `nama_siswa`, `nis`, `kelas`, `masuk1`, `masuk2`, `masuk3`, `tgl_absen`) VALUES
(87, 'Restu Lestari', '001', 12, '07:22:00.0', '09:45:13.4', '13:02:13.7', '2023-05-05'),
(89, 'Naura', '004', 12, '07:22:00.0', '09:06:13.2', '13:02:13.2', '2023-05-05'),
(91, 'Rakha', '002', 12, '07:27:00.0', '09:11:13.3', '13:05:13.6', '2023-05-05'),
(138, 'Restu Lestari', '003', 12, '00:00:00.0', '00:00:00.0', '00:00:00.0', '2023-05-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(8) NOT NULL,
  `nama` text NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `nama`, `username`, `password`) VALUES
(10, 'Restu Lestari', 'admin', '$2y$10$JI5tHQczEJEjgZBSbIJBEO7JN8IWIpzLjfsyymfFdzgOn/GZoGZji');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblguru`
--

CREATE TABLE `tblguru` (
  `id` int(8) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `tlahir` date NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tblguru`
--

INSERT INTO `tblguru` (`id`, `nama`, `nip`, `tlahir`, `email`) VALUES
(1, 'Budi', '101', '2023-04-17', 'budi@gmail.com'),
(3, 'Agus', '102', '2023-04-10', 'agustinus@gmail.com'),
(4, 'Alana', '103', '2023-04-11', 'alana@gmail.com'),
(5, 'Agustinus', '104', '2023-05-03', 'agustinus3@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblizin`
--

CREATE TABLE `tblizin` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `nis` varchar(11) NOT NULL,
  `kelas` int(8) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `alasan` text NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tblizin`
--

INSERT INTO `tblizin` (`id`, `nama`, `nis`, `kelas`, `tanggal`, `keterangan`, `alasan`, `status`) VALUES
(25, 'Restu', '003', 12, '2023-05-05', 'Sakit', 'Sakit kepala', 'P'),
(29, 'Varin', '001', 12, '2023-05-03', 'Sakit', 'Sakit', 'P'),
(30, 'Rakha', '002', 12, '2023-05-04', 'Izin', 'Pergi ', 'P'),
(39, 'Naura', '004', 12, '2023-05-01', 'Sakit', 'sakit', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbljadwal`
--

CREATE TABLE `tbljadwal` (
  `id` int(8) NOT NULL,
  `hari` text NOT NULL,
  `mulai` time(1) NOT NULL,
  `selesai` time(1) NOT NULL,
  `kelas` varchar(128) NOT NULL,
  `mapel` text NOT NULL,
  `ruang` varchar(12) NOT NULL,
  `guru` varchar(27) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbljadwal`
--

INSERT INTO `tbljadwal` (`id`, `hari`, `mulai`, `selesai`, `kelas`, `mapel`, `ruang`, `guru`) VALUES
(2, 'Senin', '07:00:00.0', '09:00:00.0', '12', 'Fisika', '4', 'Agustinus'),
(3, 'Senin', '09:45:00.0', '11:45:00.0', '12', 'Biologi', '6', 'Alana'),
(4, 'Senin', '13:00:00.0', '15:00:00.0', '12', 'Matematika', '8', 'Budi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblkelas`
--

CREATE TABLE `tblkelas` (
  `id` int(8) NOT NULL,
  `kelas` varchar(8) NOT NULL,
  `jurusan` text NOT NULL,
  `tajaran` varchar(128) NOT NULL,
  `semester` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tblkelas`
--

INSERT INTO `tblkelas` (`id`, `kelas`, `jurusan`, `tajaran`, `semester`) VALUES
(3, '12', 'MIPA', '2021/2022', 2),
(5, '11', 'MIPA', '2022/2023', 2),
(6, '10', 'MIPA', '2022/2023', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblmapel`
--

CREATE TABLE `tblmapel` (
  `id` int(8) NOT NULL,
  `mapel` text NOT NULL,
  `guru` varchar(27) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tblmapel`
--

INSERT INTO `tblmapel` (`id`, `mapel`, `guru`) VALUES
(2, 'Matematika', 'Budi'),
(4, 'Biologi', 'Alana'),
(7, 'Fisika', 'Agustinus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsiswa`
--

CREATE TABLE `tblsiswa` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `nis` varchar(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(10) NOT NULL,
  `walikelas` varchar(128) NOT NULL,
  `kelas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tblsiswa`
--

INSERT INTO `tblsiswa` (`id`, `nama`, `nis`, `username`, `password`, `walikelas`, `kelas`) VALUES
(39, 'Naura', '004', '004', '123', 'Alana', '12'),
(41, 'Restu', '003', '003', '03-06-2004', 'Agus', '12'),
(47, 'Rakha', '002', '002', '123', 'Budi', '12'),
(48, 'Varin', '001', '001', '123', 'Agus', '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(8) NOT NULL,
  `nama` text NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbluser`
--

INSERT INTO `tbluser` (`id`, `nama`, `username`, `password`) VALUES
(12, 'Randi', 'randi', '$2y$10$z'),
(13, 'Nazwa', 'nazwa', '$2y$10$l');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tblabsen`
--
ALTER TABLE `tblabsen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblguru`
--
ALTER TABLE `tblguru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblizin`
--
ALTER TABLE `tblizin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbljadwal`
--
ALTER TABLE `tbljadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblkelas`
--
ALTER TABLE `tblkelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblmapel`
--
ALTER TABLE `tblmapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblsiswa`
--
ALTER TABLE `tblsiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tblabsen`
--
ALTER TABLE `tblabsen`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT untuk tabel `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tblguru`
--
ALTER TABLE `tblguru`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tblizin`
--
ALTER TABLE `tblizin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `tbljadwal`
--
ALTER TABLE `tbljadwal`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tblkelas`
--
ALTER TABLE `tblkelas`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tblmapel`
--
ALTER TABLE `tblmapel`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tblsiswa`
--
ALTER TABLE `tblsiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
