-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 21, 2020 at 12:41 PM
-- Server version: 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `eZsurvey`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--


-- --------------------------------------------------------

--
-- Table structure for table `accountsxcompany`
--

CREATE TABLE `accountsxcompany` (
  `id` int(11) NOT NULL,
  `company_code` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accountsxcompany`
--

INSERT INTO `accountsxcompany` (`id`, `company_code`) VALUES
(33, 'CSG'),
(34, 'JVR');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `state` varchar(2) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(45) NOT NULL,
  `timestamp` datetime NOT NULL,
  `message_id` varchar(2) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `company_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_code` varchar(45) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_code`, `company_name`, `address`, `address2`, `city`, `state`, `zipcode`) VALUES
('ABC', 'ABC Storeas', 'Cross St xsd', 'M Dr1 f', 'Los Alamos', 'GA', '78654'),
('CNN', 'CNN Company', '1867 Main St', '', 'Chicaho', 'IL', '45908'),
('CSG', 'Catapult Solution Group', '1953 CHampion  Cir', NULL, 'Lacrose', 'OH', '23897'),
('HHN', 'HHN Company', '1987 Champ Dr', '', 'Virginia Beach', 'VA', '23456'),
('JVR', 'JVR Tech LLC', '6789  Holland  Ave', NULL, 'Va Beach', 'VA', '23456');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `state` varchar(2) NOT NULL,
  `message_id` varchar(2) NOT NULL,
  `regulated` tinyint(1) NOT NULL,
  `message` varchar(200) NOT NULL,
  `company_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`state`, `message_id`, `regulated`, `message`, `company_code`) VALUES
('', 'M1', 1, 'Contact your provider', ''),
('', 'M2', 1, 'Contact your HR person', ''),
('', 'M3', 0, 'Don\'t come to work', 'CSG');

-- --------------------------------------------------------

--
-- Table structure for table `pwdReset`
--


-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `state` varchar(2) NOT NULL,
  `question_id` int(11) NOT NULL,
  `regulated` tinyint(1) NOT NULL,
  `question` varchar(250) NOT NULL,
  `options` varchar(45) NOT NULL,
  `goto_if_yes` varchar(3) DEFAULT NULL,
  `goto_if_no` varchar(3) DEFAULT NULL,
  `company_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`state`, `question_id`, `regulated`, `question`, `options`, `goto_if_yes`, `goto_if_no`, `company_code`) VALUES
('OH', 1, 1, 'Do you have: A fever of 100.4 degrees Fahrenheit or higher, A Cough, Shortness of breath or diffulty  breathig', 'binary', '2', '2', ''),
('OH', 2, 1, 'Have you traveled in the past 14 days to regions affected by COVID-19?', 'binary', 'M1', '3', ''),
('OH', 3, 0, 'Do you have lung desease, kidney desease, or diabetes?', 'binary', 'M2', '4', 'CSG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--

--
-- Indexes for table `accountsxcompany`
--
ALTER TABLE `accountsxcompany`
  ADD PRIMARY KEY (`id`,`company_code`),
  ADD KEY `company_code_idx` (`company_code`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`state`,`question_id`,`answer`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_code`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`state`,`message_id`);

--
-- Indexes for table `pwdReset`
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`state`,`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--

--
-- AUTO_INCREMENT for table `pwdReset`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountsxcompany`
--
ALTER TABLE `accountsxcompany`
  ADD CONSTRAINT `company_code` FOREIGN KEY (`company_code`) REFERENCES `company` (`company_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
