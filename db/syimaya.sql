-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Jan 2023 pada 07.43
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE  = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syimaya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id`         int( 12 )                NOT NULL,
  `email`      varchar( 64 )            NOT NULL,
  `password`   varchar( 250 )           NOT NULL,
  `name`       varchar( 128 )           NOT NULL,
  `saldo`      int( 11 )                DEFAULT NULL,
  `address`    varchar( 28 )            NOT NULL,
  `sex`        varchar( 28 )            NOT NULL,
  `birth`      date                     NOT NULL,
  `photo`      varchar( 128 )           DEFAULT NULL,
  `role`       enum( 'member','admin' ) DEFAULT 'member',
  `created_at` datetime                 DEFAULT current_timestamp(),
  `updated_at` datetime                 DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` ( `id`, `email`, `password`, `name`, `saldo`, `address`, `sex`, `birth`, `photo`, `role`, `created_at`, `updated_at` ) VALUES
(1,  'syimaya@ketua.arisan.com',        'syimaya', 'Azizah al-Hasyimiyah',    18321662, 'Pulau Jawa',          'Wanita', '2023-01-03', '63cf7a2207d389.51952401.jpg', 'admin',  '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(2,  'hasyim@peserta.arisan.com',       '1832',    'Hasyim Asy\'ari',         NULL,     'Pulau Jawa',          'Pria',   '2001-12-28', '63cf7a474705e0.86090719.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(3,  'mayada@peserta.arisan.com',       '1662',    'Mayada Azizah',           NULL,     'Pulau Kalimantan',    'Wanita', '2002-06-03', '63cf7a636f1422.54859174.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(4,  'risgi@peserta.arisan.com',        '1653',    'Risgi Sri Rahayu',        NULL,     'Pulau Jawa',          'Wanita', '2001-12-28', '63cf7a8bd2d394.12941182.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(5,  'dwi@peserta.arisan.com',          '1629',    'Dwi Aldhi Setiawan',      NULL,     'Pulau Sulawesi',      'Pria',   '2001-12-28', '63cf7a9eb843e1.90623604.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(6,  'putri@peserta.arisan.com',        '1673',    'Putri Adetya Azhari',     NULL,     'Pulau Kalimantan',    'Wanita', '2001-12-28', '63cf7ab30ebab9.08768070.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(7,  'nashihuddin@peserta.arisan.com',  '1643',    'Nashihuddin Hakim',       NULL,     'Pulau Jawa',          'Pria',   '2001-12-28', '63cf7ac52088f1.17967192.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(8,  'syamsiyyatul@peserta.arisan.com', '1665',    'Syamsiyyatul Fithriyyah', NULL,     'Pulau Jawa',          'Wanita', '2001-12-28', '63cf7ad4c28a90.20353822.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(9,  'azrun@peserta.arisan.com',        '1635',    'Azrun',                   NULL,     'Pulau Nusa Tenggara', 'Pria',   '2001-12-28', '63cf7ae5ac0ac1.27893239.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(10, 'febrilia@peserta.arisan.com',     '1677',    'Febrilia Dinda Afriyani', NULL,     'Pulau Jawa',          'Wanita', '2001-12-28', '63cf7af6dc2206.98453416.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(11, 'muyassar@peserta.arisan.com',     '1633',    'Muyassar Raihan Mahdy',   NULL,     'Pulau Jawa',          'Pria',   '2001-12-28', '63cf7b08470837.93123328.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(12, 'alfina@peserta.arisan.com',       '1659',    'Alfina Nur Hidayah',      NULL,     'Pulau Kalimantan',    'Wanita', '2001-12-28', '63cf7b17c519c8.27217700.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00'),
(13, 'faiz@peserta.arisan.com',         '1649',    'Faiz Raihan',             NULL,     'Pulau Jawa',          'Pria',   '2001-12-28', '63cf7b282259d0.75998037.jpg', 'member', '2023-01-03 10:50:00', '2023-01-03 10:50:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY ( `id` ),
  ADD UNIQUE KEY `email` ( `email` );

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int( 12 ) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
