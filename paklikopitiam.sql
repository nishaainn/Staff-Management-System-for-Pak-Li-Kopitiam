-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 07:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paklikopitiam`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceId` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `clockIn` time DEFAULT NULL,
  `clockOut` time DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'missing',
  `totalHours` double DEFAULT NULL,
  `totalSalary` double DEFAULT NULL,
  `staffId` varchar(12) DEFAULT NULL,
  `managerId` varchar(12) DEFAULT NULL,
  `payrollId` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceId`, `date`, `clockIn`, `clockOut`, `status`, `totalHours`, `totalSalary`, `staffId`, `managerId`, `payrollId`) VALUES
(3, '0000-00-00', '08:01:57', '16:01:05', 'attend', 7.98, 119.75, '021025123532', '910524106664', 'P1001'),
(4, '2024-01-06', '08:01:57', '16:01:05', 'attend', 7.98, 119.75, '021025123532', '910524106664', 'P1001'),
(5, '2024-01-10', '08:01:57', '16:00:57', 'attend', 7.98, 119.75, '021218010984', '910524106664', 'P1002'),
(10, '2024-01-17', '18:50:11', '18:59:43', 'attend', 7.98, 119.75, '980712140763', NULL, NULL),
(11, '2024-01-18', '20:26:04', '10:53:01', 'attend', 7.98, 119.75, '021025140804', NULL, NULL),
(12, '2024-01-06', '08:01:57', '16:01:05', 'missing', 0, 0, '021218010984', '910524106664', 'P1001'),
(13, '2024-01-22', '14:32:47', '14:33:06', 'attend', 7.98, 119.75, '010301014567', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `managerId` varchar(12) NOT NULL,
  `managerName` varchar(255) NOT NULL,
  `managerPnum` varchar(15) NOT NULL,
  `managerEmail` varchar(50) NOT NULL,
  `hireDate` date NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` varchar(6) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`managerId`, `managerName`, `managerPnum`, `managerEmail`, `hireDate`, `password`, `status`) VALUES
('910524106664', 'Nisa Adawiyan Binti Ahmad', '01110702455', 'nisaadawiyah@gmail.com', '2016-01-14', '$2y$10$8fiU4Fizb8cNF', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payrollId` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `bankName` varchar(30) NOT NULL,
  `accountBank` varchar(30) NOT NULL,
  `amount` decimal(11,0) NOT NULL,
  `status` varchar(10) NOT NULL,
  `staffId` varchar(12) NOT NULL,
  `managerId` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payrollId`, `date`, `bankName`, `accountBank`, `amount`, `status`, `staffId`, `managerId`) VALUES
('P1001', '2024-01-01', 'Maybank', '151101501067', '2000', 'success', '021025123532', '910524106664'),
('P1002', '2024-01-08', 'Maybank', '151101501087', '2500', 'success', '021218010984', '910524106664'),
('P1003', '2024-01-01', 'Maybank', '151101501077', '2000', 'success', '021025140804', '910524106664');

-- --------------------------------------------------------

--
-- Table structure for table `reportattendance`
--

CREATE TABLE `reportattendance` (
  `ra_id` int(11) NOT NULL,
  `attendDay` int(11) NOT NULL,
  `attendanceid` int(11) NOT NULL,
  `staffId` varchar(12) NOT NULL,
  `managerId` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reportpayroll`
--

CREATE TABLE `reportpayroll` (
  `reportId` varchar(10) NOT NULL,
  `repDate` date NOT NULL,
  `payrollId` varchar(10) NOT NULL,
  `subject` varchar(10) NOT NULL DEFAULT 'salary',
  `status` varchar(12) NOT NULL DEFAULT 'success' COMMENT 'success/failed',
  `managerId` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffId` varchar(12) NOT NULL,
  `staffName` varchar(255) NOT NULL,
  `staffPnum` varchar(15) NOT NULL,
  `staffEmail` varchar(50) NOT NULL,
  `position` varchar(20) NOT NULL,
  `hireDate` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `city` varchar(30) NOT NULL,
  `postcode` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'active',
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffId`, `staffName`, `staffPnum`, `staffEmail`, `position`, `hireDate`, `gender`, `dob`, `address`, `state`, `city`, `postcode`, `country`, `status`, `password`) VALUES
('010301014567', 'aiman', '0116747853', 'aiman@gmail.com', 'Chef', '2023-07-07', 'Male', '2001-03-01', 'no 14', 'Selangor', 'Shah Alam', 45000, 'Malaysia', 'active', 'aiman123'),
('021025123532', 'shalin', '01123563232', 'shalin@gmail.com', 'Cashier', '2024-01-30', '', '2024-01-18', 'Jalan Platinum seksyen 7', 'Selangor', 'Shah Alam', 47000, 'Malaysia', 'active', ''),
('021025140804', 'Ain', '0168542656', 'ain@gmail.com', 'Waiter', '2023-06-15', 'Female', '2002-10-25', '14 Jalan Puteri Bandar Kajang', 'Selangor', 'Kajang', 43000, 'Malaysia', 'active', '$2y$10$Qa8pSPGOD/1unCIL4xTMWu8NFfWLvfEZ/jO5Hqs23Rf2urnukmYJO'),
('021218010984', 'Nur Fatin Liyana', '01133687762', 'fatinliyana@gmail.com', 'Cashier', '2019-12-05', 'Female', '2002-12-18', '123 jalan pangsapuri danaumas 7', 'Selangor', 'Shah Alam', 47000, 'Malaysia', 'active', ''),
('980712140763', 'Hafiz Mahmud', '01111241235', 'hafizmahmud@gmail.com', 'Chef', '2023-03-16', '', NULL, NULL, NULL, '', 0, '', 'active', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceId`),
  ADD KEY `attendanceid_fk` (`attendanceId`),
  ADD KEY `fk_attendance_staffId` (`staffId`),
  ADD KEY `fk_attendance_managerId` (`managerId`),
  ADD KEY ` fk_attendance_payrollId` (`payrollId`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`managerId`),
  ADD UNIQUE KEY `managerPnum` (`managerPnum`),
  ADD UNIQUE KEY `managerEmail` (`managerEmail`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payrollId`),
  ADD KEY `fk_payroll_staffId` (`staffId`),
  ADD KEY `fk_payroll_managerId` (`managerId`);

--
-- Indexes for table `reportattendance`
--
ALTER TABLE `reportattendance`
  ADD PRIMARY KEY (`ra_id`),
  ADD KEY `fk_reportAttendance_attendanceId` (`attendanceid`),
  ADD KEY `fk_reportAttendance_staffId` (`staffId`),
  ADD KEY `fk_reportAttendance_managerId` (`managerId`);

--
-- Indexes for table `reportpayroll`
--
ALTER TABLE `reportpayroll`
  ADD PRIMARY KEY (`reportId`),
  ADD KEY `fk_reportPayroll_payrollId` (`payrollId`),
  ADD KEY `fk_reportPayroll_managerId` (`managerId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`),
  ADD UNIQUE KEY `staffPnum` (`staffPnum`),
  ADD UNIQUE KEY `staffEmail` (`staffEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reportattendance`
--
ALTER TABLE `reportattendance`
  MODIFY `ra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_managerId` FOREIGN KEY (`managerId`) REFERENCES `manager` (`managerId`),
  ADD CONSTRAINT `fk_attendance_payrollId` FOREIGN KEY (`payrollId`) REFERENCES `payroll` (`payrollId`),
  ADD CONSTRAINT `fk_attendance_staffId` FOREIGN KEY (`staffId`) REFERENCES `staff` (`staffId`);

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `fk_payroll_managerId` FOREIGN KEY (`managerId`) REFERENCES `manager` (`managerId`),
  ADD CONSTRAINT `fk_payroll_staffId` FOREIGN KEY (`staffId`) REFERENCES `staff` (`staffId`);

--
-- Constraints for table `reportattendance`
--
ALTER TABLE `reportattendance`
  ADD CONSTRAINT `fk_reportAttendance_attendanceId` FOREIGN KEY (`attendanceid`) REFERENCES `attendance` (`attendanceId`),
  ADD CONSTRAINT `fk_reportAttendance_managerId` FOREIGN KEY (`managerId`) REFERENCES `manager` (`managerId`),
  ADD CONSTRAINT `fk_reportAttendance_staffId` FOREIGN KEY (`staffId`) REFERENCES `staff` (`staffId`);

--
-- Constraints for table `reportpayroll`
--
ALTER TABLE `reportpayroll`
  ADD CONSTRAINT `fk_reportPayroll_managerId` FOREIGN KEY (`managerId`) REFERENCES `manager` (`managerId`),
  ADD CONSTRAINT `fk_reportPayroll_payrollId` FOREIGN KEY (`payrollId`) REFERENCES `payroll` (`payrollId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
