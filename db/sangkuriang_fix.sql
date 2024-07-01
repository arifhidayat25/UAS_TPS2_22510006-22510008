-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 09:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sangkuriang_fix`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_harini`
--

CREATE TABLE `r_harini` (
  `tggl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `r_harini`
--

INSERT INTO `r_harini` (`tggl`) VALUES
('2024-07-01 09:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `nomor` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `penerimaan` decimal(10,2) DEFAULT NULL,
  `pengeluaran` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`nomor`, `tanggal`, `uraian`, `penerimaan`, `pengeluaran`) VALUES
(1, '2024-07-01', 'Gaji bulan July 2024 atasnama Ana Maria Sofiana', NULL, 560000.00),
(2, '2024-07-01', 'Gaji bulan July 2024 atasnama Kadek Ayu Setiawati', NULL, 300000.00),
(3, '2024-07-01', 'Gaji bulan July 2024 atasnama Otong Supriyatna', NULL, 400000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t_gunor`
--

CREATE TABLE `t_gunor` (
  `idGuru` char(4) NOT NULL,
  `jenis` char(1) NOT NULL,
  `tgMasuk` date NOT NULL,
  `GaPok` int(11) NOT NULL,
  `idxHR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_gunor`
--

INSERT INTO `t_gunor` (`idGuru`, `jenis`, `tgMasuk`, `GaPok`, `idxHR`) VALUES
('AN01', 'F', '2023-06-25', 560000, 160000),
('KA01', 'F', '2023-06-25', 300000, 160000),
('LI01', 'P', '2023-06-25', 0, 160000),
('NU01', 'P', '2023-06-25', 0, 160000),
('OT01', 'F', '2023-06-25', 400000, 160000),
('TO01', 'P', '2023-06-25', 0, 160000);

-- --------------------------------------------------------

--
-- Table structure for table `t_guri`
--

CREATE TABLE `t_guri` (
  `idGuru` char(4) NOT NULL,
  `idTari` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_guri`
--

INSERT INTO `t_guri` (`idGuru`, `idTari`) VALUES
('GU01', 'TA01'),
('TA01', ''),
('FU01', 'TA01'),
('FU02', 'TA01'),
('DI01', 'TA02'),
('PA01', 'TA03'),
('YO01', 'TA02'),
('PR01', 'TA03'),
('AN01', 'BA01'),
('AN01', 'BR01'),
('KA01', 'DA01'),
('KA01', 'DI01'),
('LI01', 'GA01'),
('LI01', 'HI01'),
('NU01', 'JA01'),
('NU01', 'JA02'),
('OT01', 'KE01'),
('OT01', 'LE01'),
('TO01', 'PE01'),
('TO01', 'RE01');

-- --------------------------------------------------------

--
-- Table structure for table `t_guru`
--

CREATE TABLE `t_guru` (
  `ID` char(4) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `JK` char(1) NOT NULL,
  `tpLahir` varchar(15) NOT NULL,
  `tgLahir` date NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `noHP` varchar(14) NOT NULL,
  `aktif` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_guru`
--

INSERT INTO `t_guru` (`ID`, `nama`, `JK`, `tpLahir`, `tgLahir`, `alamat`, `noHP`, `aktif`) VALUES
('AN01', 'Ana Maria Sofiana', 'W', 'Bandung', '2023-03-15', 'Jl. Aceh 80 Bandung', '089293112', 'Y'),
('KA01', 'Kadek Ayu Setiawati', 'W', 'Bandung', '2023-06-27', 'Jl. Pulau Lombok 18 Bandung', '081637281', 'Y'),
('LI01', 'Linda Sylvia', 'W', 'Bandung', '2023-06-27', 'Jl. Lebaksari 3 Bandung', '09172723', 'Y'),
('NU01', 'Nuni Nuraeni', 'W', 'Bandung', '2023-06-19', 'Jl. Halmahera 14a Bandung', '081627831', 'T'),
('OT01', 'Otong Supriyatna', 'P', 'Bandung', '2023-06-22', 'Bojongkoneng Iv/18 Bandung', '081272311', 'Y'),
('TO01', 'Totok Adisaputra', 'P', 'Malang', '2023-06-26', 'Jl. Niaga 49', '087126252', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `t_sista`
--

CREATE TABLE `t_sista` (
  `no_regis` char(11) NOT NULL,
  `nama_siswa` varchar(20) NOT NULL,
  `kode_tari` char(4) NOT NULL,
  `metode_latihan` char(1) NOT NULL,
  `kelas` varchar(4) NOT NULL,
  `periode` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_sista`
--

INSERT INTO `t_sista` (`no_regis`, `nama_siswa`, `kode_tari`, `metode_latihan`, `kelas`, `periode`) VALUES
('-', 'Rini Widyastuti', 'BR01', 'K', '-', '0000-00-00'),
('230001', 'Rini Widyastuti', 'GA01', 'K', 'K001', '2023-07-01'),
('230002', 'Ni Putu Desi', 'GA01', 'K', 'K001', '2023-07-02'),
('230003', 'Yogi Pratama', 'HI01', 'K', 'K001', '2023-07-03'),
('230004', 'Yoga Pratama', 'HI01', 'K', 'K001', '2023-07-04'),
('230005', 'Mita Rahmani', 'HI01', 'K', 'K001', '2023-07-05'),
('230006', 'Nira Kaniasari', 'HI01', 'K', 'K001', '2023-07-06'),
('230007', 'Desi Kumalasari', 'JA01', 'K', 'K001', '2023-07-07'),
('230008', 'Dinda Pratiwi', 'JA01', 'K', 'K001', '2023-07-08'),
('230009', 'Helinda Septiany', 'JA01', 'K', 'K001', '2023-07-09'),
('230010', 'Haryanti', 'JA01', 'K', 'K001', '2023-07-10'),
('230011', 'Lusiana Prasetya', 'JA01', 'K', 'K001', '2023-07-11'),
('230012', 'Nancy Yulia', 'JA01', 'K', 'K001', '2023-07-12'),
('230013', 'Chrismono Himawan', 'JA02', 'P', 'P001', '2023-07-13'),
('230014', 'Yuliana Tirta', 'PE01', 'K', 'K001', '2023-07-20'),
('230015', 'Jerry Hendrik', 'RE01', 'P', 'P001', '2023-07-20'),
('230016', 'Ika Andini Farida', 'RE01', 'K', 'K001', '2023-07-22'),
('230017', 'Andri Adi Susatyo', 'RE01', 'K', 'K001', '2023-07-21'),
('230018', 'Dinda Pratiwi', 'PE01', 'K', 'K001', '2023-07-17'),
('5399', 'Desi Kumalasari', 'GA01', 'K', '-', '0000-00-00'),
('9459', 'Jerry Hendrik', 'JA01', 'K', '-', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `t_siswa`
--

CREATE TABLE `t_siswa` (
  `ID` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `JK` char(1) NOT NULL,
  `tpLahir` varchar(15) NOT NULL,
  `tgLahir` date DEFAULT NULL,
  `alamat` varchar(30) NOT NULL,
  `noHP` varchar(14) NOT NULL,
  `tgMasuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_siswa`
--

INSERT INTO `t_siswa` (`ID`, `nama`, `JK`, `tpLahir`, `tgLahir`, `alamat`, `noHP`, `tgMasuk`) VALUES
(230001, 'Desi Kumalasari', 'W', 'Jombang', '2001-06-01', 'Jombang', '081208997319', '2023-06-25'),
(230002, 'Dinda Pratiwi', 'W', 'Malang', '2004-04-06', 'Malang', '08120892429', '2023-06-25'),
(230003, 'Rini Widyastuti', 'W', 'Tlogomas', '2001-10-10', 'Tlogomas', '6482792913', '2023-06-25'),
(230004, 'Yogi Pratama', 'P', 'Merjosari', '2005-11-09', 'Merjosari', '84208024082', '2023-06-25'),
(230005, 'Yoga Pratama', 'P', 'Lowokwaru', '2003-02-11', 'Lowokwaru', '7497294792', '2023-06-25'),
(230006, 'Meter Rahmasari', 'W', 'Lowokwaru', '2002-04-10', 'Lowokwaru', '28787482732', '2023-06-25'),
(230007, 'Helida Septiany', 'W', 'Ngantang', '2000-02-14', 'Ngantang', '8731738', '2023-06-25'),
(230008, 'Wahyu Bekti', 'W', 'Malang', '2014-02-01', 'Malang', '39139', '2023-06-25'),
(230009, 'Ika Andini Farida', 'W', 'Malang', '2004-03-01', 'Malang', '931937274', '2023-06-25'),
(230010, 'Andri Adi Susatyo', 'P', 'Kab.malang', '2001-06-01', 'Kab.malang', '9297429479', '2023-06-25'),
(230011, 'Jerry Hendrik', 'L', 'Merjosari', '2002-07-01', 'Merjosari', '973913719', '2023-06-25'),
(230012, 'Nira Kaniasari', 'W', 'Jomabag', '2006-03-11', 'Batu', '371373', '2023-06-25'),
(230013, 'Haryanti', 'W', 'Jogja', '2001-06-07', 'Merjosari', '792949273', '2023-06-25'),
(230014, 'Ni Putu Desi', 'W', 'Bali', '2005-06-01', 'Lslahakhdah', '39138938', '2023-06-25'),
(230015, 'Lusiana Prasetya', 'W', 'Gresik', '2001-03-15', 'Lowokwaru', '1818631836', '2023-06-25'),
(230016, 'Crismono Hirmawan', 'P', 'Jombang', '2000-08-16', 'Merjosari', '7792371379', '2023-06-25'),
(230017, 'Nancy Yulia', 'W', 'Malang', '2002-02-12', 'Sigura-gura', '893691639', '2023-06-25'),
(230018, 'Yuliana Tirta', 'W', 'Jombang', '2001-04-24', 'Malang Kota', '9194649', '2023-06-25'),
(240002, '1231', 'P', '1231', '2024-06-25', '1231', '084563746273', '2024-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `t_tari`
--

CREATE TABLE `t_tari` (
  `kode` char(4) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jenis` char(1) NOT NULL,
  `lama` tinyint(4) NOT NULL,
  `aktif` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_tari`
--

INSERT INTO `t_tari` (`kode`, `nama`, `jenis`, `lama`, `aktif`) VALUES
('BA01', 'Balet', 'M', 16, 'T'),
('BR01', 'Breakdance', 'M', 16, 'Y'),
('DA01', 'Dansa', 'M', 15, 'Y'),
('DI01', 'Disco', 'M', 8, 'Y'),
('GA01', 'Gambyong', 'D', 12, 'Y'),
('HI01', 'Hiphop', 'M', 12, 'Y'),
('JA01', 'Jaipong', 'D', 16, 'Y'),
('JA02', 'Jaranan', 'D', 8, 'Y'),
('KE01', 'Ketuk Tilu', 'D', 10, 'Y'),
('LE01', 'Legong', 'D', 12, 'Y'),
('PE01', 'Pendet', 'D', 12, 'Y'),
('RE01', 'Remo', 'D', 8, 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `t_gunor`
--
ALTER TABLE `t_gunor`
  ADD PRIMARY KEY (`idGuru`);

--
-- Indexes for table `t_guru`
--
ALTER TABLE `t_guru`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `t_sista`
--
ALTER TABLE `t_sista`
  ADD PRIMARY KEY (`no_regis`);

--
-- Indexes for table `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `t_tari`
--
ALTER TABLE `t_tari`
  ADD PRIMARY KEY (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
