- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2026 at 01:40 PM
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
-- Database: `running_event_registration_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `price`) VALUES
(1, '5KM', 400.00),
(2, '10KM', 550.00),
(3, '21KM', 700.00);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `emergency_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `emergency_name` varchar(150) NOT NULL,
  `emergency_contact` varchar(20) NOT NULL,
  `relationship_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`emergency_id`, `participant_id`, `emergency_name`, `emergency_contact`, `relationship_name`) VALUES
(1, 1, 'Dorinie dumana', '09708984742', 'Mother'),
(2, 2, 'Father  ni Cuizon', '09604682756', 'father'),
(3, 3, 'Maria Dela Cruz', '09181234567', 'Mother'),
(4, 4, 'Roberto Santos', '09181234502', 'Father');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participant_id` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `birthdate` date NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `team_name` varchar(100) DEFAULT NULL,
  `medical_conditions` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `blood_type` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participant_id`, `fullname`, `email`, `contact`, `gender`, `birthdate`, `nationality`, `address`, `team_name`, `medical_conditions`, `medications`, `blood_type`, `created_at`) VALUES
(1, 'Dumana Jasiel E.', 'jasieldumana@gmail.com', '09708984742', 'Male', '2005-06-18', 'FILIPINO', 'San Roque, Sumilao, Bukidnon', 'ManFort Runners', 'none', 'none', 'B+', '2026-05-29 05:02:07'),
(2, 'John Anderson Cuizon', 'johnanderson@gmail.com', '09708785782', 'Male', '2005-01-08', 'FILIPINO', 'Agusan, Canyon, Manolo Fortich, Bukidnon', 'Team Bukidnon Runners', 'none', 'none', 'B+', '2026-05-29 09:27:38'),
(3, 'Juan Dela Cruz', 'juan.delacruz25@gmail.com', '09171234567', 'Male', '1998-05-15', 'FILIPINO', 'Purok 5, Barangay Mahayahay, Manolo Fortich, Bukidnon', 'Team Bukidnon Runners', 'none', 'none', 'O+', '2026-05-30 01:20:16'),
(4, 'Maria Santos', 'maria.s01@gmail.com', '09171234502', 'Female', '2001-09-22', 'FILIPINO', 'Valencia City, Bukidnon', 'StrideX Runners', 'none', 'none', 'A+', '2026-05-30 07:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `registration_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `waiver_accepted` tinyint(1) DEFAULT 0,
  `bib_number` varchar(20) DEFAULT NULL,
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`registration_id`, `participant_id`, `category_id`, `waiver_accepted`, `bib_number`, `payment_status`, `registration_date`) VALUES
(1, 1, 3, 1, '21-001', 'Paid', '2026-05-29 05:02:07'),
(2, 2, 3, 1, '21-002', 'Pending', '2026-05-29 09:27:38'),
(3, 3, 1, 1, '5-001', 'Pending', '2026-05-30 01:20:16'),
(4, 4, 2, 1, '10-001', 'Pending', '2026-05-30 07:10:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`emergency_id`),
  ADD KEY `fk_emergency_participant` (`participant_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participant_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `fk_participant` (`participant_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `emergency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `fk_emergency_participant` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`participant_id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_participant` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`participant_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
