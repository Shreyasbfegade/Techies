-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2018 at 06:07 PM
-- Server version: 5.7.19-log
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fts_5`
--
CREATE DATABASE IF NOT EXISTS `fts_5` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fts_5`;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `hardid` varchar(500) NOT NULL,
  `filename` varchar(500) NOT NULL,
  `attachment` LONGBLOB DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--



-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

DROP TABLE IF EXISTS `movements`;
CREATE TABLE IF NOT EXISTS `movements` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `from_id` int(255) DEFAULT NULL,
  `file_id` int(255) DEFAULT NULL,
  `to_id` int(255) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

ALTER TABLE files
ADD attachment_type VARCHAR(255) AFTER attachment;


--


-- Dumping data for table `movements`
--



-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `usertype` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;




-- Create the 'users' table
-- CREATE TABLE IF NOT EXISTS `users` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `name` varchar(200) NOT NULL,
--   `email` varchar(200) NOT NULL,
--   `password` varchar(200) NOT NULL,
--   `is_admin` tinyint(1) NOT NULL DEFAULT '0',
--   `usertype` int(11), -- Add a foreign key reference to 'usertype'
--   PRIMARY KEY (`id`),
--   FOREIGN KEY (`usertype`) REFERENCES `usertype`(`id`) -- Define the foreign key relationship
-- );


ALTER TABLE movements
ADD count VARCHAR(255) AFTER updated_at;
--
-- Dumping data for table `users`
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- INSERT INTO `usertype`(`id`, `usertype`) VALUES ('1','Principal');
-- INSERT INTO `usertype`(`id`, `usertype`) VALUES ('2','Staff');
-- INSERT INTO `usertype`(`id`, `usertype`) VALUES ('3','Admin');
-- INSERT INTO `usertype`(`id`, `usertype`) VALUES ('4','Student');

INSERT INTO users (id, name, email, password, is_admin, usertype) VALUES (, 'admin', 'admin@gmail.com','admin' ,'1', '3');


CREATE TABLE Date (
    date DATE PRIMARY KEY
);

CREATE TABLE Venue (
    venue_name VARCHAR(100),
    date DATE,
    FOREIGN KEY (date) REFERENCES Date(date)
);
CREATE TABLE Time (
    index_column INT PRIMARY KEY,
    time_slot VARCHAR(100)
);
ALTER TABLE Venue
ADD COLUMN index INT AUTO_INCREMENT PRIMARY KEY;

CREATE TABLE Booked (
    index_column INT PRIMARY KEY,
    date DATE,
    venue_id INT,
    time_index INT
);


ALTER TABLE `booked` ADD FOREIGN KEY (`date`) REFERENCES `date`(`date`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `booked` ADD FOREIGN KEY (`time_index`) REFERENCES `time`(`index_column`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `booked` ADD FOREIGN KEY (`venue_id`) REFERENCES `venue`(`index`) ON DELETE RESTRICT ON UPDATE RESTRICT;

INSERT INTO time (index_column, time_slot) VALUES ('1', '9.00-10.00');
INSERT INTO time (index_column, time_slot) VALUES ('2', '10.00-11.00');
INSERT INTO time (index_column, time_slot) VALUES ('3', '11.00-12.00');
INSERT INTO time (index_column, time_slot) VALUES ('4', '12.00-13.00');
INSERT INTO time (index_column, time_slot) VALUES ('5', '13.00-14.00');
INSERT INTO time (index_column, time_slot) VALUES ('6', '14.00-15.00');
INSERT INTO time (index_column, time_slot) VALUES ('7', '15.00-16.00');
INSERT INTO time (index_column, time_slot) VALUES ('8', '16.00-17.00');