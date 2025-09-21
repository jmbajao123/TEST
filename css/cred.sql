-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 04:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cred`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `email`, `password`, `date`) VALUES
(1, 'stiiadmin@gmail.com', 'admin123', '2025-03-25 19:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `c_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_id`, `d_id`, `a_id`, `course_name`, `course_status`, `date`) VALUES
(1, 1, 1, 'Bachelor of Science in Business Administration', 'Active', '2025-04-15 07:05:31'),
(2, 2, 1, 'Bachelor of Science in Criminology', 'Active', '2025-04-15 07:27:38'),
(3, 3, 1, 'Bachelor of Science in Information Technology', 'Active', '2025-04-15 07:39:08'),
(4, 4, 1, 'Bachelor of Science in Midwifery', 'Active', '2025-04-15 07:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `d_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_status` varchar(255) NOT NULL,
  `a_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`d_id`, `department_name`, `department_status`, `a_id`, `date`) VALUES
(1, 'College of Business Administration', 'Active', 1, '2025-04-15 07:05:18'),
(2, 'College of Criminology', 'Active', 1, '2025-04-15 07:27:27'),
(3, 'College of Computer Studies', 'Active', 1, '2025-04-15 07:38:57'),
(4, 'College of Midwifery', 'Active', 1, '2025-04-15 07:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix_name` varchar(255) NOT NULL,
  `date_birth` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `student_vcode` varchar(255) NOT NULL,
  `student_status` varchar(255) NOT NULL,
  `year_graduated` varchar(255) NOT NULL,
  `date_graduation` varchar(255) NOT NULL,
  `a_id` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `diploma` varchar(255) NOT NULL,
  `graduation` varchar(255) NOT NULL,
  `tor` varchar(255) NOT NULL,
  `honors` varchar(255) NOT NULL,
  `c_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `date_birth`, `age`, `gender`, `civil_status`, `province`, `municipality`, `barangay`, `street`, `student_id`, `student_vcode`, `student_status`, `year_graduated`, `date_graduation`, `a_id`, `profile`, `diploma`, `graduation`, `tor`, `honors`, `c_id`, `d_id`, `date`) VALUES
(1, 'Maygielou', 'A.', 'Aballe', 'None', '1996-07-10', '28', 'Female', 'Single', 'Zamboanga Sibugay', 'Tungawan', 'San Isidro', 'Purok 1', '117360', '300644', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Abegalle.jpg', '../diploma/Abegalle.jpg', '../Credentials/Abegalle.jpg', '../TOR/Abegalle.jpg', 'Cum Luade', 1, 1, '2025-04-14 16:00:00'),
(2, 'Kient', 'Francisco', 'Alvarado', 'None', '1996-08-16', '28', 'Male', 'Single', 'Zamboanga Sibugay', 'Ipil', 'Poblacion', 'Purok 1', '391487', '496536', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Alvarado.jpg', '../diploma/Alvarado.jpg', '../Credentials/Alvarado.jpg', '../TOR/Alvarado.jpg', 'Magna Cum Laude', 1, 1, '2025-04-14 16:00:00'),
(3, 'Nelrose', 'Herla', 'Ambos', 'None', '1998-11-02', '26', 'Female', 'Single', 'Zamboanga Sibugay', 'Titay', 'Magalandis', 'Purok 3', '311280', '728596', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Ambos.jpg', '../diploma/Ambos.jpg', '../Credentials/Ambos.jpg', '../TOR/Ambos.jpg', 'Suma Cum Laude', 1, 1, '2025-04-14 16:00:00'),
(4, 'George', 'Resvento', 'Atay', 'None', '1996-10-23', '28', 'Male', 'Single', 'Zamboanga Sibugay', 'Ipil', 'Sanito', 'Purok 2', '527875', '189687', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/atay.jpg', '../diploma/atay.jpg', '../Credentials/atay.jpg', '../TOR/atay.jpg', 'Cum Laude', 1, 1, '2025-04-16 01:57:13'),
(5, 'Jesse', 'Ladion', 'Aragon', 'None', '1996-08-20', '28', 'Male', 'Single', 'Zamboanga Sibugay', 'Ipil', 'Taway', 'Purok Bangkal', '921719', '714906', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Aragon.jpg', '../diploma/Aragon.jpg', '../Credentials/Aragon.jpg', '../TOR/Aragon.jpg', 'Cum Laude', 2, 2, '2025-04-14 16:00:00'),
(6, 'Leonard', 'Dablo', 'Advincula', 'None', '1997-10-19', '27', 'Male', 'Single', 'Zamboanga Sibugay', 'Naga', 'Manubo', 'Purok 4', '426465', '632007', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Advincula.jpg', '../diploma/Advincula.jpg', '../Credentials/Advincula.jpg', '../TOR/Advincula.jpg', 'Suma Cum Laude', 2, 2, '2025-04-14 16:00:00'),
(7, 'Mario', 'Villanueva', 'Bantingan', 'None', '1993-09-18', '31', 'Male', 'Single', 'Zamboanga Sibugay', 'Payao', 'Poblacion', 'Purok 1', '533138', '372800', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/bantingan.jpg', '../diploma/bantingan.jpg', '../Credentials/bantingan.jpg', '../TOR/bantingan.jpg', 'Cum Laude', 2, 2, '2025-04-14 16:00:00'),
(8, 'Mary Grace', 'Calipayan', 'Revantad', 'None', '1995-03-25', '30', 'Female', 'Single', 'Zamboanga Sibugay', 'Kabasalan', 'Poblacion', 'Purok 1', '978215', '836035', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Revantad.jpg', '../diploma/Revantad.jpg', '../Credentials/Revantad.jpg', '../TOR/Revantad.jpg', 'Magna Cum Laude', 2, 2, '2025-04-14 16:00:00'),
(9, 'Jessa', 'Francisco', 'Sanicolas', 'None', '1993-12-06', '31', 'Female', 'Single', 'Zamboanga Del Norte', 'Kalawit', 'Poblacion', 'Purok 2', '486965', '358486', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/sanicolas.jpg', '../diploma/sanicolas.jpg', '../Credentials/sanicolas.jpg', '../TOR/sanicolas.jpg', 'Magna Cum Laude', 3, 3, '2025-04-14 16:00:00'),
(10, 'Reycil', 'Vergara', 'Templado', 'None', '1992-12-28', '32', 'Female', 'Single', 'Zamboanga Sibugay', 'Ipil', 'Poblacion', 'Purok 4', '561603', '246631', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Templado.jpg', '../diploma/Templado.jpg', '../Credentials/Templado.jpg', '../TOR/Templado.jpg', 'Cum Laude', 3, 3, '2025-04-14 16:00:00'),
(11, 'Michael', 'Dela Rosa', 'Sultan', 'None', '1991-03-15', '34', 'Male', 'Single', 'Zamboanga Sibugay', 'R.T Lim', 'Poblacion', 'Purok 3', '311502', '104196', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/sultan.jpg', '../diploma/sultan.jpg', '../Credentials/sultan.jpg', '../TOR/sultan.jpg', 'Cum Laude', 3, 3, '2025-04-14 16:00:00'),
(12, 'Magdalena', 'Ayani', 'Solani', 'None', '1997-11-01', '27', 'Female', 'Single', 'Zamboanga Sibugay', 'Ipil', 'Poblacion', 'Purok 2', '171595', '591107', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/solani.jpg', '../diploma/solani.jpg', '../Credentials/solani.jpg', '../TOR/solani.jpg', 'Cum Laude', 3, 3, '2025-04-14 16:00:00'),
(13, 'Mary Grace', 'Dela Cruz', 'Geromo', 'None', '1989-12-18', '35', 'Female', 'Single', 'Zamboanga Sibugay', 'Tungawan', 'Upper Tungawan', 'Purok 1', '226398', '985861', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/geromo.jpg', '../diploma/geromo.jpg', '../Credentials/geromo.jpg', '../TOR/geromo.jpg', 'Suma Cum Laude', 4, 4, '2025-04-14 16:00:00'),
(14, 'Lilibeth', 'Hera', 'Libres', 'None', '1996-02-06', '29', 'Female', 'Single', 'Zamboanga Sibugay', 'Kabasalan', 'Dipala', 'Purok 3', '278125', '668575', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Libres.jpg', '../diploma/Libres.jpg', '../Credentials/Libres.jpg', '../TOR/Libres.jpg', 'Magna Cum Laude', 4, 4, '2025-04-14 16:00:00'),
(15, 'Normina', 'Innaja', 'Saing', 'None', '1996-06-13', '28', 'Female', 'Single', 'Zamboanga Del Norte', 'Siocon', 'Sta. Maria', 'Purok 1', '974763', '250904', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/saing.jpg', '../diploma/saing.jpg', '../Credentials/saing.jpg', '../TOR/saing.jpg', 'Suma Cum Laude', 4, 4, '2025-04-14 16:00:00'),
(16, 'Analy', 'Casas', 'Berondo', 'None', '2000-11-25', '24', 'Female', 'Single', 'Zamboanga Sibugay', 'Ipil', 'Timalang', 'Purok 1', '747857', '499600', 'Verified', '2020 - 2021', '2021-04-14', 1, '../uploads/Berondo.jpg', '../diploma/Berondo.jpg', '../Credentials/Berondo.jpg', '../TOR/Berondo.jpg', 'Magna Cum Laude', 4, 4, '2025-04-14 16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
