-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2015 at 12:25 AM
-- Server version: 5.5.41-MariaDB-1ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sscomms`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `fingerprint` varchar(255) NOT NULL,
  `pin` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `duty_role`
--

DROP TABLE IF EXISTS `duty_role`;
CREATE TABLE IF NOT EXISTS `duty_role` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `duty_role_person`
--

DROP TABLE IF EXISTS `duty_role_person`;
CREATE TABLE IF NOT EXISTS `duty_role_person` (
`id` int(11) NOT NULL,
  `duty_role` int(11) NOT NULL,
  `person` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL DEFAULT '0',
  `in_service` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=800 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_category`
--

DROP TABLE IF EXISTS `equipment_category`;
CREATE TABLE IF NOT EXISTS `equipment_category` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_checkout`
--

DROP TABLE IF EXISTS `equipment_checkout`;
CREATE TABLE IF NOT EXISTS `equipment_checkout` (
`id` int(11) NOT NULL,
  `equipment` int(11) NOT NULL,
  `person` int(11) NOT NULL,
  `checkout` int(11) NOT NULL,
  `checkin` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
`id` int(11) NOT NULL,
  `wristband_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT 'Unnamed',
  `last_name` varchar(255) NOT NULL DEFAULT 'Unnamed',
  `phone_number` varchar(20) NOT NULL,
  `call_sign` varchar(255) NOT NULL,
  `team` int(11) NOT NULL DEFAULT '0',
  `barcode` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `verify` int(11) NOT NULL,
  `verify_time` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=810 ;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Unnamed'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `duty_role`
--
ALTER TABLE `duty_role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duty_role_person`
--
ALTER TABLE `duty_role_person`
 ADD PRIMARY KEY (`id`), ADD KEY `duty_role` (`duty_role`), ADD KEY `person` (`person`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
 ADD PRIMARY KEY (`id`), ADD KEY `category` (`category`);

--
-- Indexes for table `equipment_category`
--
ALTER TABLE `equipment_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_checkout`
--
ALTER TABLE `equipment_checkout`
 ADD PRIMARY KEY (`id`), ADD KEY `equipment` (`equipment`), ADD KEY `person` (`person`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
 ADD PRIMARY KEY (`id`), ADD KEY `team` (`team`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `duty_role`
--
ALTER TABLE `duty_role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `duty_role_person`
--
ALTER TABLE `duty_role_person`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=800;
--
-- AUTO_INCREMENT for table `equipment_category`
--
ALTER TABLE `equipment_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `equipment_checkout`
--
ALTER TABLE `equipment_checkout`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=810;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `duty_role_person`
--
ALTER TABLE `duty_role_person`
ADD CONSTRAINT `duty_role_person_ibfk_1` FOREIGN KEY (`duty_role`) REFERENCES `duty_role` (`id`),
ADD CONSTRAINT `duty_role_person_ibfk_2` FOREIGN KEY (`person`) REFERENCES `person` (`id`);

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`category`) REFERENCES `equipment_category` (`id`);

--
-- Constraints for table `equipment_checkout`
--
ALTER TABLE `equipment_checkout`
ADD CONSTRAINT `equipment_checkout_ibfk_1` FOREIGN KEY (`equipment`) REFERENCES `equipment` (`id`),
ADD CONSTRAINT `equipment_checkout_ibfk_2` FOREIGN KEY (`person`) REFERENCES `person` (`id`);

--
-- Constraints for table `person`
--
ALTER TABLE `person`
ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`);
