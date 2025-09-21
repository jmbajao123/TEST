-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2025 at 07:39 AM
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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ad_usertype` varchar(255) NOT NULL DEFAULT 'Registrar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `email`, `password`, `date`, `ad_usertype`) VALUES
(1, 'stiiadmin@gmail.com', 'admin123', '2025-09-09 10:08:54', 'Registrar Account');

-- --------------------------------------------------------

--
-- Table structure for table `ad_users`
--

CREATE TABLE `ad_users` (
  `ads_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `cash_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ad_usertype` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active Account',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ad_users`
--

INSERT INTO `ad_users` (`ads_id`, `a_id`, `cash_id`, `email`, `password`, `ad_usertype`, `status`, `date`) VALUES
(1, 1, 0, 'stiiadmin@gmail.com', 'admin123', 'Registrar Account', 'Active Account', '2025-09-10 02:01:05'),
(2, 0, 1, 'stiicashier@gmail.com', 'cashier123', 'Cashier Account', 'Active Account', '2025-09-10 02:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `cash_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Available Cashier',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ad_usertype` varchar(255) NOT NULL DEFAULT 'Cashier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`cash_id`, `email`, `password`, `status`, `date`, `ad_usertype`) VALUES
(1, 'stiicashier@gmail.com', 'cashier123', 'Available Cashier', '2025-09-10 02:05:51', 'Cashier Account');

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
(1, 1, 1, 'Bachelor of Science in Business Administration', 'Active', '2025-07-18 15:39:49'),
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
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `documents_name` varchar(255) NOT NULL,
  `doc_price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Available Document',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`doc_id`, `a_id`, `documents_name`, `doc_price`, `status`, `date`) VALUES
(1, 1, 'Transcript of Record', '250', 'Available Document', '2025-09-09 03:58:25'),
(2, 1, 'Diploma', '150', 'Available Document', '2025-09-09 03:28:07'),
(3, 1, 'Certificate of Graduation', '50', 'Available Document', '2025-09-09 03:28:33'),
(4, 1, 'Honorable Dismissal', '50', 'Available Document', '2025-09-09 03:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `req_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `cash_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Request Documents',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ad_id` int(11) NOT NULL,
  `c_date` varchar(255) NOT NULL,
  `req_referrence` varchar(255) NOT NULL,
  `documents` varchar(255) NOT NULL,
  `total_payment` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `year_graduated` varchar(255) NOT NULL,
  `elementary` varchar(255) NOT NULL,
  `e_sy` varchar(255) NOT NULL,
  `high_school` varchar(255) NOT NULL,
  `hs_sy` varchar(255) NOT NULL,
  `parents_fname` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `course_year` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_birth` varchar(255) NOT NULL,
  `date_place` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `cashier_number` varchar(255) NOT NULL,
  `pay_day` varchar(255) NOT NULL,
  `pay_time` varchar(255) NOT NULL,
  `pay_date` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `or_number` varchar(255) NOT NULL,
  `c_is_read` tinyint(1) NOT NULL,
  `release_date` varchar(255) NOT NULL,
  `release_time` varchar(255) NOT NULL,
  `st_is_read` tinyint(1) NOT NULL,
  `or_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `r_is_read` tinyint(1) NOT NULL,
  `rs_is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`req_id`, `u_id`, `a_id`, `cash_id`, `doc_id`, `s_id`, `status`, `date`, `ad_id`, `c_date`, `req_referrence`, `documents`, `total_payment`, `semester`, `year_graduated`, `elementary`, `e_sy`, `high_school`, `hs_sy`, `parents_fname`, `full_name`, `course_year`, `address`, `date_birth`, `date_place`, `civil_status`, `cashier_number`, `pay_day`, `pay_time`, `pay_date`, `payment_status`, `or_number`, `c_is_read`, `release_date`, `release_time`, `st_is_read`, `or_date`, `r_is_read`, `rs_is_read`) VALUES
(1, 1, 1, 0, 0, 1, 'Release Documents', '2025-09-16 07:08:27', 0, 'September 16, 2025', 'UDGJ0H7E', 'Transcript of Record, Diploma, Certificate of Graduation, Honorable Dismissal', '500', '2nd Semester', '2021-2022', 'kjujytrewd', '2017-06-13', 'loiuyjthrgf', '2022-07-20', 'sadsadasdasdasdas', 'Reycil Vergara Templado', 'Bachelor of Science in Information Technology &amp; Graduate Student', 'Purok 4, Poblacion Ipil, Ipil, Zamboangay Sibugay', 'June 14, 1995', 'Ipil, Zamboanga Sibugay', 'Single', 'MPHIKU', 'Wednesday', '08:00 AM - 08:20 AM', '2025-09-17', 'Paid', '31069724', 0, '2025-09-16 15:08:01', '', 1, '2025-09-16 01:06:55', 1, 1),
(2, 2, 1, 0, 0, 2, 'Release Documents', '2025-09-16 07:38:30', 0, 'September 16, 2025', 'VP9O3O50', 'Transcript of Record, Diploma, Certificate of Graduation, Honorable Dismissal', '500', 'Summer', '2021-2022', 'DFGHNJMNBV', '2016-02-21', 'ZXCVFDS', '2022-04-23', 'ASDFVCXSDFD', 'Normina Innaja Saing', 'Bachelor of Science in Midwifery &amp; Graduate Student', 'Purok 1, Sta. Maria, Siocon, Zamboanga Del Norte', 'June 12, 1996', 'Siocon, Zamboanga Del Norte', 'Single', '5YJUTF', 'Wednesday', '08:20 AM - 08:40 AM', '2025-09-17', 'Paid', '85933756', 0, '2025-09-16 15:38:30', '', 1, '2025-09-16 01:16:45', 1, 0),
(3, 3, 1, 0, 0, 3, 'Release Documents', '2025-09-16 07:38:03', 0, 'September 16, 2025', '8N4QJD40', 'Transcript of Record, Diploma, Certificate of Graduation, Honorable Dismissal', '500', 'Summer', '2021-2022', 'asdfghjk', '2011-10-10', 'asdfghj', '2016-10-10', 'wfghjkm,lmnb', 'Leonard Dablo Advincula', 'Bachelor of Science in Criminology &amp; Graduate Student', 'Purok 1, Sta. Maria, Siocon, Zamboanga Del Norte', 'October 19, 1997', 'Siocon, Zamboanga Del Norte', 'Single', '93TCN7', 'Wednesday', '08:40 AM - 09:00 AM', '2025-09-17', 'Paid', '92185796', 0, '2025-09-16 15:38:03', '', 0, '2025-09-16 01:36:42', 1, 0);

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `b_place` varchar(255) NOT NULL,
  `s_gmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `con_pass` varchar(255) NOT NULL,
  `sc_is_read` tinyint(1) NOT NULL,
  `sg` varchar(255) NOT NULL DEFAULT 'Graduate Student',
  `a_is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `date_birth`, `age`, `gender`, `civil_status`, `province`, `municipality`, `barangay`, `street`, `student_id`, `student_vcode`, `student_status`, `year_graduated`, `date_graduation`, `a_id`, `profile`, `diploma`, `graduation`, `tor`, `honors`, `c_id`, `d_id`, `date`, `b_place`, `s_gmail`, `password`, `con_pass`, `sc_is_read`, `sg`, `a_is_read`) VALUES
(1, 'Reycil', 'Vergara', 'Templado', 'None', '1995-06-14', '30', 'Male', 'Single', 'Zamboangay Sibugay', 'Ipil', 'Poblacion Ipil', 'Purok 4', '467364', 'XNOQ2WGV', 'Verified', '2020-2021', '2020-04-14', 1, '../uploads/Templado.jpg', '../diploma/Templado.jpg', '../Credentials/Templado.jpg', '../TOR/Templado.jpg', 'Cum Laude', 3, 3, '2025-09-16 07:10:17', 'Ipil, Zamboanga Sibugay', 'reyciltemplado@gmail.com', '$2y$10$UGrz8blXwk97OLsZb9JYQ.fOezlSj25Eamp5nAf1OgDuAjFwmx/uG', 'qwerty123', 1, 'Graduate Student', 1),
(2, 'Normina', 'Innaja', 'Saing', 'None', '1996-06-12', '29', 'Female', 'Single', 'Zamboanga Del Norte', 'Siocon', 'Sta. Maria', 'Purok 1', '766570', '9XO2ZM8G', 'Verified', '2020-2021', '2021-04-14', 1, '../uploads/saing.jpg', '../diploma/saing.jpg', '../Credentials/saing.jpg', '../TOR/saing.jpg', 'Suma Cum Laude', 4, 4, '2025-09-16 06:58:10', 'Siocon, Zamboanga Del Norte', 'norminasaing@gmail.com', '$2y$10$zGV39K/0rB0STNwSROX3o.urBzZ5Ei/XhpqYvtSsGoR785pQP2yAC', 'qwerty123', 1, 'Graduate Student', 1),
(3, 'Leonard', 'Dablo', 'Advincula', 'None', '1997-10-19', '27', 'Male', 'Single', 'Zamboanga Del Norte', 'Siocon', 'Sta. Maria', 'Purok 1', '209583', 'BR85NX4I', 'Verified', '2020-2021', '2021-04-14', 1, '../uploads/Advincula.jpg', '../diploma/Advincula.jpg', '../Credentials/Advincula.jpg', '../TOR/Advincula.jpg', 'Suma Cum Laude', 2, 2, '2025-09-16 07:39:31', 'Siocon, Zamboanga Del Norte', 'leonarddalo@gmail.com', '$2y$10$JBDz0cKy5E90qNd9neHBSePrAYzwLGKq.x795RUdVHJcr0JoN.v2O', '123456', 0, 'Graduate Student', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `u_status` varchar(255) NOT NULL DEFAULT 'Active Account',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_is_read` tinyint(1) NOT NULL,
  `status` varchar(255) NOT NULL,
  `s_gmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `con_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `s_id`, `a_id`, `u_status`, `date`, `u_is_read`, `status`, `s_gmail`, `password`, `con_pass`) VALUES
(1, 1, 1, 'Active Account', '2025-09-04 16:03:39', 0, 'Verified', 'reyciltemplado@gmail.com', '$2y$10$UGrz8blXwk97OLsZb9JYQ.fOezlSj25Eamp5nAf1OgDuAjFwmx/uG', 'qwerty123'),
(2, 2, 1, 'Active Account', '2025-09-16 02:28:20', 0, 'Verified', 'norminasaing@gmail.com', '$2y$10$zGV39K/0rB0STNwSROX3o.urBzZ5Ei/XhpqYvtSsGoR785pQP2yAC', 'qwerty123'),
(3, 3, 1, 'Active Account', '2025-09-16 07:32:33', 0, 'Verified', 'leonarddalo@gmail.com', '$2y$10$JBDz0cKy5E90qNd9neHBSePrAYzwLGKq.x795RUdVHJcr0JoN.v2O', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `ad_users`
--
ALTER TABLE `ad_users`
  ADD PRIMARY KEY (`ads_id`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`cash_id`);

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
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ad_users`
--
ALTER TABLE `ad_users`
  MODIFY `ads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `cash_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
