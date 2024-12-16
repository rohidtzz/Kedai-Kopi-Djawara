-- phpMyAdmin SQL Dump
-- version 5.2.1-dev+20220928.a4d273f5cf
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Des 2024 pada 04.14
-- Versi server: 8.0.30
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kedai_kopi_djawara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `stock`, `img`) VALUES
(1, 'capucino', 12000, 89, 'welcome/img/menu/capucino.jfif'),
(2, 'americano', 20000, 100, 'welcome/img/menu/americano.jfif'),
(3, 'espresso', 15000, 100, 'welcome/img/menu/espresso.jfif'),
(4, 'javanese', 11000, 100, 'welcome/img/menu/javanese.jfif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `uang` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `totals` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `product_id`, `no_order`, `jumlah`, `uang`, `status`, `name`, `email`, `phone`, `totals`, `user_id`, `created_at`) VALUES
(1, 1, 'INV-7105', 2, 0, 'waiting', 'asdasd', 'ajskldhkasd@gmail.com', '085156850530', 24000, 0, '0000-00-00'),
(2, 1, 'INV-7833', 2, 0, 'waiting', 'asdasd', 'ajskldhkasd@gmail.com', '085156850530', 24000, 0, '0000-00-00'),
(3, 1, 'INV-968', 2, 0, 'waiting', 'asdasd', 'ajskldhkasd@gmail.com', '085156850530', 24000, 0, '0000-00-00'),
(4, 1, 'INV-4543', 2, 0, 'waiting', 'asdasd', 'ajskldhkasd@gmail.com', '085156850530', 24000, 0, '0000-00-00'),
(5, 1, 'INV-3056', 2, 24000, 'paid', 'asdasd', 'ajskldhkasd@gmail.com', '085156850530', 24000, 0, '0000-00-00'),
(6, 1, 'INV-781', 1, 15000, 'paid', 'asdasd', 'ajskldhkasd@gmail.com', '085156850530', 12000, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `img`, `name`, `email`, `phone`, `username`, `password`, `roles`) VALUES
(1, 'welcome/img/user/logo-kedai.png', 'adminsss', 'rohidtzz@gmail.com', '085156850530', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
