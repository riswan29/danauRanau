-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 01:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indah`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventt`
--

CREATE TABLE `eventt` (
  `id` int(11) NOT NULL,
  `nama_event` varchar(256) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventt`
--

INSERT INTO `eventt` (`id`, `nama_event`, `deskripsi`, `gambar`) VALUES
(2, 'kelapppaa', '<p>hhh</p>\r\n', 'uploads/wallpaper.png'),
(3, 'kkk', '<ol>\r\n	<li>asdfasdfjlkasf</li>\r\n</ol>\r\n', 'uploads/646deabe9116b_Picture1.png'),
(4, 'tor tor', '<p>dfafdlkja dfj kjfkljalkdf</p>\r\n', 'uploads/6482ab4c11ba7_ranau.jpg'),
(5, 'afkajdsk', '<p>dfafkladkf;a;df&nbsp;&nbsp;</p>\r\n', 'uploads/6482add3b4846_352355089_185566704468720_2069591777930661175_n.jpg'),
(6, 'dkakdfjka', '<p>fasdfkla a; ajdf jasdf ajfdlkjd fl</p>\r\n', '6482aeeacc655_7gyhux4r5sn41-153326592.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `penginapan`
--

CREATE TABLE `penginapan` (
  `id` int(11) NOT NULL,
  `nama_penginapan` varchar(256) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penginapan`
--

INSERT INTO `penginapan` (`id`, `nama_penginapan`, `deskripsi`, `gambar`) VALUES
(3, 'manguras tao', 'manguras tao toba', 'uploads/647ec33564585_Cuplikan layar 2023-05-31 190240.png'),
(4, 'hotel a', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up on', 'uploads/6482a4e38df17_352355089_185566704468720_2069591777930661175_n.jpg'),
(5, 'hotel b', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up on', 'uploads/6482a4f0f35d6_350140081_1323730908178338_1525103602832023461_n.jpg'),
(6, 'hotel c', '<p>jkasdjfkjdfjaklflkasdkf fjaksdfj</p>\r\n', 'uploads/6482aa59d32e7_350140081_1323730908178338_1525103602832023461_n.jpg'),
(7, 'penginapan 1', '<p>dasfasd afalkfd ljflkklsdcm</p>\r\n', '6482afb656a64_350140081_1323730908178338_1525103602832023461_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wahana`
--

CREATE TABLE `wahana` (
  `id` int(11) NOT NULL,
  `nama_wahana` varchar(256) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `longitude` varchar(256) NOT NULL,
  `latitude` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wahana`
--

INSERT INTO `wahana` (`id`, `nama_wahana`, `deskripsi`, `gambar`, `longitude`, `latitude`) VALUES
(11, 'simangunsong', '<ol>\r\n	<li>kjjksfd]</li>\r\n	<li>dsfasdf</li>\r\n	<li>sdfasdf</li>\r\n	<li>sadfsadf</li>\r\n</ol>\r\n', 'uploads/646de1fc83d83_rick.jpg', '', ''),
(12, 'Danau Toba ', '<p>ini contoh</p>\r\n', 'uploads/64818713d9eac_Cuplikan layar 2023-05-28 140757.png', '98.67539023588998', '2.6218534385569408'),
(13, 'wahana a', '<p>fajsfd a ddfka nlkjf a jdks</p>\r\n', 'uploads/6482b0aad1d2b_352355089_185566704468720_2069591777930661175_n.jpg', '98.69119102499475', '3.6096010716758142'),
(14, 'wahana b', '<p>fasdfkalkdf afjkd jfkjdfsadcf</p>\r\n', '6482b16bf0a20_7gyhux4r5sn41-153326592.jpeg', '98.70762760060857', '3.6156401108632363');

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id` int(11) NOT NULL,
  `nama_wisata` varchar(256) NOT NULL,
  `kategori` varchar(256) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `gambar2` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`id`, `nama_wisata`, `kategori`, `deskripsi`, `gambar`, `gambar2`) VALUES
(11, 'afkajdfkja', 'Wisata Kuliner', '<p>fadfadfasdfsdf</p>\r\n', '6482bfcda8f619.87558566_7gyhux4r5sn41-153326592.jpeg', '6482bfcda92c64.68601442_350140081_1323730908178338_1525103602832023461_n.jpg'),
(12, 'fkajsdkfjka sd', 'Wisata Budaya dan Agama', '<p>fadfadfasdfsdf</p>\r\n', '6482c001696690.62114403_Cuplikan layar 2023-05-31 190240.png', '6482c00169b598.72487539_350140081_1323730908178338_1525103602832023461_n.jpg'),
(13, 'dkfjlkajlfkjlkaf', 'Wisata Kuliner', '<p>fadfadfasdfsdf</p>\r\n', '6482c01d1c1445.74722845_Cuplikan layar 2023-05-29 125752.png', '6482c01d1c4959.52280803_350140081_1323730908178338_1525103602832023461_n.jpg'),
(14, 'dajfka dfhefdcnacnm', 'Wisata Alam', '<p>sdfadfadfakldkfjieudjffkldj fk</p>\r\n', '6482c03828daa0.12611418_Cuplikan layar 2023-05-31 212329.png', '6482c038291482.77764733_352355089_185566704468720_2069591777930661175_n.jpg'),
(15, 'dajfka dfhefdcnacnmajjdflkjaf', 'Wisata Budaya dan Agama', '<p>sdfadfadfakldkfjieudjffkldj fkdfafdk</p>\r\n', '6482c04fdae9b7.84959827_Cuplikan layar 2023-05-29 171650.png', '6482c04fdb1181.46299982_350140081_1323730908178338_1525103602832023461_n.jpg'),
(16, 'dajfka dfhefdcnacnmajdfjdjfdhhjdflkjaf', 'Wisata Budaya dan Agama', '<p>sdfadfadfakldkfjieudjffkldj fkdfafdadfasdf</p>\r\n', '6482c065021300.49747552_Cuplikan layar 2023-05-31 210958.png', '6482c0650412e8.72979413_350140081_1323730908178338_1525103602832023461_n.jpg'),
(17, 'ajdfkjadkf kdfkajs', 'Wisata Alam', '<p>sdfadfadfakldkfjieudjffkldj fkdfafdadfasdf</p>\r\n', '6482c089ca4894.09456645_Cuplikan layar 2023-06-02 202000.png', '6482c089ca7dd8.15616419_7gyhux4r5sn41-153326592.jpeg'),
(18, 'rumah', 'Wisata Budaya dan Agama', '<p>sdfadfadfakldkfjieudjffkldj fkdfafdadfasdf</p>\r\n', '6482c353dca458.57843891_Cuplikan layar 2023-05-31 084410.png', '6482c353dcd4d7.73070099_350140081_1323730908178338_1525103602832023461_n.jpg'),
(19, 'basecamp', 'Wisata Kuliner', '<p>dfadjafljalsdfj</p>\r\n', '64830eff380680.57515235_352355089_185566704468720_2069591777930661175_n.jpg', '64830eff384733.91257913_350140081_1323730908178338_1525103602832023461_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventt`
--
ALTER TABLE `eventt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penginapan`
--
ALTER TABLE `penginapan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wahana`
--
ALTER TABLE `wahana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventt`
--
ALTER TABLE `eventt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penginapan`
--
ALTER TABLE `penginapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wahana`
--
ALTER TABLE `wahana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
