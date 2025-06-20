-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2025 pada 11.48
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
-- Database: `mahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$ghMunNmMmF1WIOKNrab9M.N0G4WFkdTxgoMYPxYEwH7hzGwIufx6q', '1', '2025-05-03 04:27:23', '2025-06-14 02:30:26'),
(2, 'mhs', '$2y$10$ghMunNmMmF1WIOKNrab9M.N0G4WFkdTxgoMYPxYEwH7hzGwIufx6q', '2', '2025-05-03 04:29:53', '2025-06-14 02:30:20'),
(3, 'dosen', '$2y$10$ghMunNmMmF1WIOKNrab9M.N0G4WFkdTxgoMYPxYEwH7hzGwIufx6q', '3', '2025-05-03 04:32:53', '2025-06-14 02:30:11'),
(4, 'admin1', '$2y$10$hE2sOVdLv289Vf98qzLaaOXKXRPjTc/lAeuWjWKIDPU3IO5nIVxX.', '1', '2025-06-14 03:58:48', NULL),
(6, 'mhs1', '$2y$10$vVY//B79iKlm01mn148Ya.P4wINymEThP2oAHBuSdr1k56Gcvvz.u', '2', '2025-06-14 04:00:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
