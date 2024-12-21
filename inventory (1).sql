-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 11:36 AM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinic_staffs`
--

CREATE TABLE `clinic_staffs` (
  `id` int(20) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `role` char(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_no` bigint(100) NOT NULL,
  `specialization` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinic_staffs`
--

INSERT INTO `clinic_staffs` (`id`, `fullname`, `role`, `address`, `contact_no`, `specialization`) VALUES
(10, 'Megan H. Loreal', 'Nurse', 'Purok 2, Tubod, Jagna, Bohol', 639943024563, 'Midwifery Assisstance'),
(11, 'Mark V. Membrano', 'Dentist', 'Purok 10, Holawan, Bood, Bohol', 639463582405, 'Dental Services'),
(12, 'Jaymarie M. Magbanua', 'Nurse', 'Purok 3, Hinlayagan, Mabini, Bohol', 639934521354, 'Dental Assistance'),
(13, 'Chesterfield B. Martida', 'Doctor', '143 St. Talisay, Tagbilaran, Bohol', 639214578902, 'General Consultation'),
(14, 'Zenaicha C. Mordasa', 'Psychiatrist', '783 St. Palasan, Hunkaan, Bohol', 639482341256, 'Mental Health'),
(17, 'Junre Gamutan', 'Nurse', 'Catungawan Norte, Guindulman, Bohol', 9937884223, 'Pediatrician');

-- --------------------------------------------------------

--
-- Table structure for table `incident_report`
--

CREATE TABLE `incident_report` (
  `id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `bp_mmhg` varchar(20) NOT NULL,
  `pr_bpm` int(11) NOT NULL,
  `temp_celcious` int(11) NOT NULL,
  `oxygen_saturation` int(11) NOT NULL,
  `complaint` varchar(60) NOT NULL,
  `treatment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incident_report`
--

INSERT INTO `incident_report` (`id`, `personal_id`, `staff_id`, `date`, `time`, `bp_mmhg`, `pr_bpm`, `temp_celcious`, `oxygen_saturation`, `complaint`, `treatment`) VALUES
(150, 5, 13, '2024-01-07', '10:32:00', '90/70', 78, 35, 92, 'Headache', 'Prescribed to hydrate and drink paracetamol.'),
(151, 4, 11, '2024-03-24', '12:00:00', '110/80', 81, 37, 102, 'Toothache', 'Reserved for tooth extraction. Mefenamic is prescribed.'),
(152, 3, 12, '2024-08-01', '01:09:00', '100/90', 94, 38, 89, 'Fever', 'Required to get some rest and prescribed by paracetamol.'),
(153, 2, 14, '2024-03-01', '12:34:00', '90/60', 82, 35, 107, 'Period Cramps', 'Heat compress is given. Prescribed to drink Hyosaph.'),
(154, 1, 10, '2023-09-01', '10:30:00', '120/80', 90, 37, 106, 'Dry Cough', 'Salbutamol is prescribed.'),
(177, 25, 10, '2024-05-07', '09:31:00', '120/100', 85, 37, 78, 'Headache', 'Adviced to take a rest then drink paracetamol '),
(178, 26, 14, '2024-05-01', '10:46:00', '120/80', 82, 34, 71, 'LBM', 'Drink Diatabs'),
(179, 29, 14, '2024-12-07', '14:50:00', '120/80', 50, 34, 2343, 'toothache', 'Rest and take mefenamic'),
(181, 2, 11, '2003-02-09', '22:00:00', '120/80', 67, 35, 89, 'headache', 'drink paracetamol');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(150) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `description`, `manufacturer`, `expiry_date`) VALUES
(80, 'Mefenamic', 'Anti-inflammatory painkiller used to treat painful condition', 'Sapphire Lifesciences', '2024-04-28'),
(81, 'Salbutamol', 'Used to relieve symptoms of asthma and Chronic Obstructive P', 'Ventolin', '2026-04-15'),
(82, 'Paracetamol', 'A medicine used used to treat mild to moderate pain. Also used to treat fever and body pains.', 'Unilab', '2025-12-11'),
(83, 'Scopolamine', 'Drug use to treat cramps of the stomach, intestines, kidneys and bladder.', 'Healing Pharma', '2024-05-09'),
(84, 'Amoxicillin', 'An antibiotic that treats infections caused by bacteria. Also used to treat bacterial infections such as chest infections. ', 'P&G', '2027-07-04'),
(96, 'Metroprolol', 'For high blood pressure', 'Mercury ', '2024-05-07'),
(99, 'Diatabs', 'Indicated for the treatment of acute diarrhea ', 'UNILAB, Inc', '2024-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_prescription`
--

CREATE TABLE `medicine_prescription` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `dosage` varchar(20) NOT NULL,
  `frequency` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_prescription`
--

INSERT INTO `medicine_prescription` (`id`, `report_id`, `medicine_id`, `dosage`, `frequency`, `start_date`, `end_date`) VALUES
(200, 150, 82, '1g', '3 times a day', '2024-09-02', '2024-09-09'),
(201, 153, 80, '500mg', '3 times a day', '2024-03-01', '2024-03-04'),
(202, 152, 82, '1g', '3 times a day', '2023-01-09', '2023-01-16'),
(207, 150, 80, '4444444', '3333333333', '2024-04-03', '2024-04-19'),
(218, 151, 84, '50', '3 times a day', '2024-05-02', '2024-06-29'),
(224, 177, 82, '250mg', '3 times a day', '2024-05-08', '2024-05-09'),
(225, 154, 96, '250mg', '3 times a day', '2024-05-08', '2024-05-09'),
(226, 178, 99, '30mg', '3 times a day', '2024-05-02', '2024-05-04'),
(227, 179, 80, '30mg', '3 times a day', '2024-05-08', '2024-05-14'),
(228, 152, 84, '30mg', '3 times a day', '2024-05-01', '2024-05-22'),
(229, 152, 82, '250mg', '3 times a day', '2024-05-16', '2024-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(25) NOT NULL,
  `role` char(20) NOT NULL,
  `fullname` varchar(80) NOT NULL,
  `status` char(20) NOT NULL,
  `gender` char(20) NOT NULL,
  `course` varchar(80) DEFAULT NULL,
  `yr_level` int(11) DEFAULT NULL,
  `department` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `emergency_number` varchar(30) NOT NULL,
  `emergency_contact` varchar(50) NOT NULL,
  `height_cm` int(11) NOT NULL,
  `weight_kg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `role`, `fullname`, `status`, `gender`, `course`, `yr_level`, `department`, `birthdate`, `address`, `email`, `contact_number`, `emergency_number`, `emergency_contact`, `height_cm`, `weight_kg`) VALUES
(1, 'Student', 'Maria Alona M. Maglinte', 'Single', 'F', 'BSCS', 2, 'CTE', '2002-01-25', 'Purok 2, Marinduque, Santa Anna', 'mariaalona.maglinte@gmail.com', '639456722374', '639094122389', 'Undayon V. Maglinte', 148, 46),
(2, 'Staff', 'Kristan D. Olaco', 'Married', 'M', 'BSCS', 4, 'CFMS', '2003-04-12', 'Purok 1, Mayana, Jagna, Bohol', 'kristan.olaco@gmail.com', '639454890433', '639803290213', 'Dianne Ann B. Olaco', 156, 51),
(3, 'Student', 'Vanross O. Olarita', 'Single', 'F', 'BSCS', 2, 'CTAS', '2003-11-25', 'Purok 2, Imelda, Ubay, Bohol', 'vanross.olarita@gmail.com', '093747384726', '093729375837', 'Mark O. Olarita', 170, 49),
(4, 'Staff', 'Salidumay R. Rosales', 'Single', 'F', 'BSCS', 4, 'COE', '2002-11-02', 'Purok 9, Demince, Kaytirna, Bohol', 'salidumay.rosales@gmail.com', '639904567450', '6393465448679', 'Hensman R. Rosales', 156, 46),
(5, 'Staff', 'Jarios B. Tadle', 'Married', 'M', 'BSOA', 1, 'CTAS', '2002-01-23', 'Purok 5, Hanoman, Gawdiay, Bohol', 'jarios.tadle@gmail.com', '639845673798', '639784566455', 'Merriam B. Tadle', 157, 41),
(25, 'Staff', 'Andrea Musong', 'Married', 'F', '', 0, 'CTE', '1992-01-25', 'Cogtong, Candijay, Bohol', 'andrea23@gmail.com', '09937485739', '09749294758', 'Pedro Musong', 143, 43),
(26, 'Student', 'Mark T. Lang', 'Single', 'M', 'BSOA', 4, 'CBM', '2001-03-15', 'Catungawan Norte, Guindulman, Bohol', 'Mark34@gmail.com', '09758483837', '09727384729', 'Dora M. Lang', 150, 53),
(29, 'Student', 'Samantha Simbajon', 'Single', 'f', 'BSCS', 2, 'CBM', '1998-07-06', 'Canawa , Candijay Bohol', 'samatha@kkk.com', '09634256782', '09652431675', '09854686536', 145, 34),
(32, 'Student', 'Diana', 'Single', 'f', 'BSCS', 2, 'CBM', '2024-05-25', 'Canawa , Candijay Bohol', 'samatha@kkk.com', '09634256782', '09652431675', '09854686536', 143, 34);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `password`, `email`) VALUES
(47, 'Angela', 'Mae Martinez', '$2y$10$Dtx1P04SKpXCEp52fkjF8.CgHm0LrPWB.z.nS/elU7l4GBUjsimvS', 'bernalesj28@gmail.com'),
(48, 'Diana ', 'Atuel', '$2y$10$6jhXsmqJIQ109L/8kovVAe5kRPXPAP3S.MSyCf/XKcCD2H.OOOjpS', 'dianaroseatuel@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinic_staffs`
--
ALTER TABLE `clinic_staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incident_report`
--
ALTER TABLE `incident_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientname_cons` (`personal_id`),
  ADD KEY `staffname_cons` (`staff_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_prescription`
--
ALTER TABLE `medicine_prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medname_cons` (`medicine_id`),
  ADD KEY `reportbasis_cons` (`report_id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fullname` (`fullname`),
  ADD UNIQUE KEY `birthdate` (`birthdate`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinic_staffs`
--
ALTER TABLE `clinic_staffs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `incident_report`
--
ALTER TABLE `incident_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `medicine_prescription`
--
ALTER TABLE `medicine_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incident_report`
--
ALTER TABLE `incident_report`
  ADD CONSTRAINT `patientname_cons` FOREIGN KEY (`personal_id`) REFERENCES `personal_info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staffname_cons` FOREIGN KEY (`staff_id`) REFERENCES `clinic_staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medicine_prescription`
--
ALTER TABLE `medicine_prescription`
  ADD CONSTRAINT `medname_cons` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reportbasis_cons` FOREIGN KEY (`report_id`) REFERENCES `incident_report` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
