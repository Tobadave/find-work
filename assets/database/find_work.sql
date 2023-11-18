-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 11:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_work`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `SN` int(11) NOT NULL,
  `applicant_first_name` varchar(255) NOT NULL,
  `applicant_last_name` varchar(255) NOT NULL,
  `applicant_email` varchar(255) NOT NULL,
  `applicant_phone_number` varchar(255) NOT NULL,
  `applicant_skills` varchar(255) NOT NULL,
  `applicant_education_history` varchar(255) NOT NULL,
  `applicant_id` varchar(255) NOT NULL,
  `applicant_resume_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `SN` int(11) NOT NULL,
  `application_id` varchar(255) NOT NULL,
  `applicant_id` varchar(255) NOT NULL,
  `job_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_submited` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `SN` int(11) NOT NULL,
  `employer_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `employer_email` varchar(255) NOT NULL,
  `employer_feild` varchar(255) NOT NULL,
  `employer_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `SN` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_description` varchar(255) NOT NULL,
  `job_skills` varchar(255) NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `job_salary` varchar(255) NOT NULL,
  `job_id` varchar(255) NOT NULL,
  `job_author_id` varchar(255) NOT NULL,
  `job_posted_date` datetime NOT NULL DEFAULT current_timestamp(),
  `job_end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `SN` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`SN`),
  ADD UNIQUE KEY `applicant_id` (`applicant_id`),
  ADD KEY `applicant_email` (`applicant_email`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`SN`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`SN`),
  ADD UNIQUE KEY `employer_id` (`employer_id`),
  ADD KEY `employee_email` (`employer_email`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`SN`),
  ADD UNIQUE KEY `job_id` (`job_id`),
  ADD KEY `employee_id` (`job_author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`SN`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicant_email` FOREIGN KEY (`applicant_email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_id` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `employers`
--
ALTER TABLE `employers`
  ADD CONSTRAINT `employee_email` FOREIGN KEY (`employer_email`) REFERENCES `users` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `employee_id` FOREIGN KEY (`job_author_id`) REFERENCES `employers` (`employer_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
