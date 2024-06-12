-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2024 at 08:57 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmsproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int NOT NULL,
  `id_doctor` int NOT NULL,
  `id_users` int NOT NULL,
  `appointmentdate` datetime NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `id_doctor`, `id_users`, `appointmentdate`, `details`) VALUES
(1, 2, 1, '2024-03-23 11:25:00', 'นัดหมายเพื่อมาล้างแผลตามกำหนด'),
(4, 1, 2, '2024-04-18 10:00:00', 'มาล้างแผลตามการนัดหมาย'),
(10, 3, 19, '2024-03-31 09:25:00', 'มาตรวจเช็คสุขภาพประจำปี'),
(11, 8, 2, '2024-04-06 10:10:00', 'มาตรวจเช็คสุขภาพประจำปีตามการนัดหมาย'),
(14, 9, 3, '2024-04-01 09:52:00', 'test'),
(15, 1, 1, '2024-03-31 22:50:00', 'มาตรวจเช็คสุขภาพประจำปีตามการนัดหมาย'),
(16, 8, 1, '2024-04-06 20:20:00', 'มาล้างแผลตามการนัดหมาย'),
(17, 2, 3, '2024-03-30 16:00:00', 'testrr'),
(18, 2, 2, '2024-04-19 15:43:00', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `specialization` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phoneno` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `firstname`, `lastname`, `gender`, `specialization`, `phoneno`, `birthdate`, `address`, `email`, `password`) VALUES
(1, 'Somchai', 'Kemtidma', 'female', 'วิสัญญีแพทย์', '0854568853', '1990-12-31', '286 หมู่ 5 ถ. น่าน-ทุ่งช้าง ต.ท่าวังผา อ.ท่าวังผา จ.น่าน55140', 'somchai@doctor.com', 'somchai123'),
(2, 'Ekkarin', 'Kongwai', 'male', 'กุมารเวช', '0985458520', '2014-03-05', '266 ถ.รอบเมืองนอก ต.ในเมือง อ.เมือง จ.ลำพูน 51000', 'ekkarin@doctor.com', 'ekkarin123'),
(3, 'Somying', 'Yingluk', 'female', 'นิติเวชศาสตร์', '0123456789', '2004-03-03', '557 หมู่ 11 ต.เด่นชัย อ.เด่นชัย จ.แพร่ 54110', 'somying@doctor.com', 'somying123'),
(8, 'Sathaporn', 'Ladda', 'male', 'แพทย์กระดูก', '0855544645', '1990-12-01', '403 ถ.ริมน่าน ต.ตะพานหิน อ.ตะพานหิน จ.เพชรบูรณ์ 66110', 'sathaporn@doctor.com', 'sathaporn123'),
(9, 'Paiboon', 'Somsup', 'male', 'ศัลยแพทย์ทั่วไป', '0894556996', '1983-02-16', '458 หมู่ 20 ถ.ประชา ต.- อ.สว่างแดนดิน จ.สกลนคร 47110', 'paiboon@doctor.com', 'paiboon123');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int NOT NULL,
  `drugname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `detail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `drugname`, `detail`) VALUES
(2, 'เบตาดีน', 'ใช้สำหรับทาแผล และฆ่าเชื้อโรค'),
(3, 'ผงน้ำตาลเกลือแร่', 'ทดแทนการเสียน้ำสำหรับคนที่มีอาการท้องร่วงหรืออาเจียนมาก และป้องกันการช็อกจากร่างกายขาดน้ำ'),
(5, 'ยาแก้ไอน้ำดำ', 'บรรเทาอาการไอ ขับเสมหะ'),
(6, 'ไดเมนไฮดริเนต', 'ป้องกันอาการเมารถ-เมาเรือ'),
(7, 'น้ำเกลือล้างแผล', 'ทำความสะอาดแผล'),
(8, 'ยาธาตุน้ำแดง', 'บรรเทาอาการปวดท้อง จุกเสียด ท้องขึ้น และท้องเฟ้อ'),
(9, 'โซดามินต์', 'ยาเม็ดแก้ท้องอืด ท้องเฟ้อ บรรเทาอาการจุกเสียด ลดอาการระคายเคือง เนื่องจากมีกรดมากในกระเพาะอาหาร');

-- --------------------------------------------------------

--
-- Table structure for table `has_drugs`
--

CREATE TABLE `has_drugs` (
  `id` int NOT NULL,
  `id_medicalhistory` int NOT NULL,
  `id_drugs` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `has_drugs`
--

INSERT INTO `has_drugs` (`id`, `id_medicalhistory`, `id_drugs`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicalhistory`
--

CREATE TABLE `medicalhistory` (
  `id` int NOT NULL,
  `id_doctor` int NOT NULL,
  `id_users` int NOT NULL,
  `id_drugs` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `height` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `weight` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `bloodpressure` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `medicalhistorydate` datetime NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicalhistory`
--

INSERT INTO `medicalhistory` (`id`, `id_doctor`, `id_users`, `id_drugs`, `height`, `weight`, `bloodpressure`, `medicalhistorydate`, `details`) VALUES
(52, 2, 3, '2,3', '150', '45', '121 / 89', '2024-04-04 17:00:00', 'คนไข้มีแผลถลอก จึงให้ยาเบตาดีนไปเพื่อฆ่าเชื้อและรักษาแผล'),
(53, 1, 3, '8,3', '181', '80', '120 / 90', '2024-04-13 20:10:00', 'คนไข้มีอาการท้องร่วง จึงให้ยาธาติน้ำแดงไปเพื่อรักษาอาการท้องร่วง'),
(55, 2, 1, '5,6', '170', '80', '120 / 90', '2024-04-28 20:50:00', 'คนไข้มีอาการไอ จึงให้ยาแก้ไอน้ำดำแก่คนไข้เพื่อบรรเทาอาการไอ'),
(57, 2, 19, '7,2', '170', '80', '114 / 90', '2024-04-11 03:12:00', 'คนไข้มีแผลถลอก จึงให้ยาเบตาดีนไปเพื่อฆ่าเชื้อและรักษาแผล'),
(58, 9, 18, '2,3,5,6,7,8', '170', '80', '120 / 90', '2024-04-19 04:47:00', 'ป่วย'),
(59, 2, 3, '2,5', '170', '80', '120 / 90', '2024-04-05 13:00:00', 'test5'),
(60, 2, 3, '5,2', '170', '80', '114 / 90', '2024-04-24 18:37:00', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phonenum` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `congenital` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `drugallergy` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `gender`, `phonenum`, `birthdate`, `address`, `congenital`, `drugallergy`, `email`, `password`) VALUES
(1, 'Phimploy', 'Phukphon', 'prefer not to say', '0844488756', '2020-01-06', '11/22 ต.บ้านสวน อ.เมือง จ.ชลบุรี 20000', '-', '-', 'phimploy@user.com', 'phimploy123'),
(3, 'Arthit', 'Sombat', 'prefer not to say', '0552588520', '2019-01-31', '118 หมู่5 ต.สำนักท้อน อ.บ้านฉาง จ.ระยอง 21130', '-', '-', 'arthit@user.com', 'arthit123'),
(18, 'Theetat', 'Pongnamloan', 'male', '0857891234', '2012-02-08', '440 ถ. พหลโยธิน ต.หัวเวียง อ.เมือง จ.ลำปาง 52000', '-', '-', 'theetat@user.com', 'theetat123'),
(19, 'Kantanat', 'Thairug', 'male', '0874124545', '2006-01-12', '41 ถนนเทศบาล 12 ต.ระโนด อ.ระโนด จ.สงขลา 90140', '-', '-', 'kantanat@user.com', 'kantanat123'),
(20, 'Theeraphap', 'Teerachot', 'male', '0895441234', '2001-01-28', '152 หมู่ 3 ถนนสุขุมวิท ต.บ้านสวน อ.เมืองชลบุรี จ.ชลบุรี 20000', '-', '-', 'theeraphap@user.com', 'theeraphap123'),
(21, 'Srisuwan', 'Supan', 'female', '086-455-2589', '1995-02-08', '215 หมู่ 9 ต.ทุ่งสุขลา อ.ศรีราชา จ.ชลบุรี 20230', '-', '-', 'srisuwan@user.com', 'srisuwan123'),
(28, 'Kanittin', 'Keeratisenee', 'female', '0857891234', '2024-03-27', 'BUU', '-', '-', 'kanittin5@user.com', '098f6bcd4621d373cade4e832627b4f6'),
(30, 'Kanittin', 'Keeratisenee', 'prefer not to say', '0857891234', '2024-03-27', 'BUU', '-', '-', 'test@user.com', 'test123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
