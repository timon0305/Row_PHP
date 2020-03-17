-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 30, 2020 at 08:37 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `systemp1_aaronttms`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `admin_id` int(32) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'aaron', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `customers_info`
--

CREATE TABLE `customers_info` (
  `customer_id` int(32) NOT NULL,
  `Customer_fname` varchar(50) DEFAULT NULL,
  `Customer_lname` varchar(50) DEFAULT NULL,
  `Customer_phone` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `payment_id` int(32) NOT NULL,
  `customer_id` int(32) DEFAULT NULL,
  `ticket_id` varchar(32) DEFAULT NULL,
  `payment_type` int(10) DEFAULT NULL,
  `total_payment` varchar(15) DEFAULT NULL,
  `total_deposit` varchar(15) DEFAULT NULL,
  `total_balance` varchar(15) DEFAULT NULL,
  `ticket_paid` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_tickets`
--

CREATE TABLE `customer_tickets` (
  `customer_id` int(32) DEFAULT NULL,
  `ticket_id` varchar(32) NOT NULL DEFAULT '',
  `ticket_num` varchar(255) DEFAULT NULL,
  `ticket_courtdate` date DEFAULT NULL,
  `ticket_trialdate` date DEFAULT NULL,
  `ticket_comment` varchar(255) DEFAULT NULL,
  `ticket_date` datetime NOT NULL,
  `ticket_entered_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ttms_registration`
--

CREATE TABLE `ttms_registration` (
  `company_reg_name` varchar(55) NOT NULL,
  `company_reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ttms_registration`
--

INSERT INTO `ttms_registration` (`company_reg_name`, `company_reg_date`) VALUES
('Aaron Traffic Tickets', '2014-11-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customers_info`
--
ALTER TABLE `customers_info`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `Payments_fk1` (`customer_id`);

--
-- Indexes for table `customer_tickets`
--
ALTER TABLE `customer_tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `Tickets_fk1` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administration`
--
ALTER TABLE `administration`
  MODIFY `admin_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers_info`
--
ALTER TABLE `customers_info`
  MODIFY `customer_id` int(32) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `payment_id` int(32) NOT NULL AUTO_INCREMENT;
