-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2020 at 02:48 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `assignment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) UNSIGNED NOT NULL,
  `privilege_id` int(11) UNSIGNED NOT NULL,
  `removable` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`assignment_id`),
  KEY `FK_ROLE_ASSIGNMENT` (`role_id`),
  KEY `FK_PRIVILEGE_ASSIGNMENT` (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `role_id`, `privilege_id`, `removable`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 1, 5, 0),
(6, 1, 6, 0),
(7, 1, 7, 0),
(8, 1, 8, 0),
(9, 1, 9, 0),
(10, 1, 10, 0),
(11, 1, 11, 0),
(12, 1, 12, 0),
(13, 3, 4, 1),
(14, 3, 5, 1),
(15, 4, 1, 1),
(16, 4, 8, 1),
(17, 4, 2, 1),
(18, 4, 3, 1),
(19, 5, 1, 1),
(20, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` blob NOT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `access` int(11) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `content`, `author`, `access`, `timestamp`) VALUES
(1, 'Homepage', 0xefbbbf3c6831207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c7370616e207374796c653d22666f6e742d66616d696c793a20417269616c3b20666f6e742d73697a653a20323470783b223e48656c6c6f20616e642077656c636f6d652c3c2f7370616e3e3c62723e3c2f68313e3c6831207374796c653d22746578742d616c69676e3a2063656e7465723b223e3c7370616e207374796c653d22636f6c6f723a20726762283235352c20302c2030293b20666f6e742d73697a653a20333670783b20666f6e742d66616d696c793a20417269616c3b223e3c753e3c7374726f6e673e4c6f67696e3a2061646d696e3c2f7374726f6e673e3c2f753e3c2f7370616e3e266e6273703b20266e6273703b20266e6273703b3c7370616e207374796c653d22636f6c6f723a20726762283235352c20302c2030293b20666f6e742d73697a653a20333670783b20666f6e742d66616d696c793a20417269616c3b223e3c753e3c7374726f6e673e50617373776f72643a2061646d696e3132333c2f7374726f6e673e3c2f753e3c2f7370616e3e3c62723e3c2f68313e3c70207374796c653d226d617267696e2d6c6566743a20353070783b223e546869732069732042434d53206d696e6920436f6e74656e74204d616e6167656d656e742053797374656d207769746820426f6f747374726170203521266e6273703b3c7374726f6e673e266e6273703b203c2f7374726f6e673e3c7370616e207374796c653d22666f6e742d73697a653a20313470783b223e3c7374726f6e673e4749544855423a3c2f7374726f6e673e3c2f7370616e3e3c7374726f6e673e266e6273703b3c2f7374726f6e673ee2808b3c6120687265663d2268747470733a2f2f6769746875622e636f6d2f567974656e69735261647a657669636975732f42434d53352e67697422207461726765743d225f626c616e6b223e3c7370616e207374796c653d22666f6e742d73697a653a20313870783b223e68747470733a2f2f6769746875622e636f6d2f567974656e69735261647a657669636975732f42434d53352e6769743c2f7370616e3e3c2f613e3c2f703e3c64697620636c6173733d2273652d636f6d706f6e656e742073652d696d6167652d636f6e7461696e6572205f5f73655f5f666c6f61742d6e6f6e652220636f6e74656e746564697461626c653d2266616c7365223e3c666967757265207374796c653d226d617267696e3a203070783b223e3c696d67207372633d2268747470733a2f2f692e6b796d2d63646e2e636f6d2f656e74726965732f69636f6e732f6f726967696e616c2f3030302f3033312f3638302f756e66696e69736865645f686f7273652e6a70672220616c743d222220646174612d726f746174653d222220646174612d70726f706f7274696f6e3d22747275652220646174612d726f74617465783d222220646174612d726f74617465793d222220646174612d73697a653d2234323870782c32353470782220646174612d616c69676e3d2263656e7465722220646174612d696e6465783d22312220646174612d66696c652d6e616d653d22756e66696e69736865645f686f7273652e6a70672220646174612d66696c652d73697a653d223022206f726967696e2d73697a653d223830302c3435302220646174612d6f726967696e3d222c22207374796c653d2277696474683a2034323870783b206865696768743a2032353470783b223e3c2f6669677572653e3c2f6469763e3c7461626c653e3c74626f64793e3c74723e3c74643e3c646976207374796c653d22746578742d616c69676e3a2072696768743b223e466f72206e6f772074686973207069637475726520706572666563746c7920656e63617073756c6174657320746869732070726f6a6563742c3c2f6469763e3c646976207374796c653d22746578742d616c69676e3a2072696768743b223e6275742066656172206e6f742c2069742077696c6c20737572656c79206765742062657474657220696e2074686520667574757265213c2f6469763e3c2f74643e3c2f74723e3c2f74626f64793e3c2f7461626c653e3c64697620636c6173733d2273652d636f6d706f6e656e742073652d766964656f2d636f6e7461696e6572205f5f73655f5f666c6f61742d63656e7465722220636f6e74656e746564697461626c653d2266616c736522207374796c653d22223e3c666967757265207374796c653d226865696768743a2034323970783b2070616464696e672d626f74746f6d3a2034323970783b206d617267696e3a206175746f3b2077696474683a2037363170783b223e3c696672616d65206672616d65626f726465723d22302220616c6c6f7766756c6c73637265656e3d2222207372633d2268747470733a2f2f7777772e796f75747562652e636f6d2f656d6265642f493743666144597a54564d2220646174612d70726f706f7274696f6e3d22747275652220646174612d616c69676e3d2263656e7465722220646174612d73697a653d2237363170782c343239707822207374796c653d2277696474683a2037363170783b206865696768743a2034323970783b2220646174612d696e6465783d22302220646174612d66696c652d6e616d653d22493743666144597a54564d2220646174612d66696c652d73697a653d22302220646174612d6f726967696e3d22313030252c35362e3235252220646174612d726f746174653d222220646174612d726f74617465783d222220646174612d726f74617465793d22223e3c2f696672616d653e3c2f6669677572653e3c2f6469763e, 4, 0, '2020-11-17 16:31:23'),
(2, 'Testpage1', 0x3c703e74657374313c2f703e, 4, 0, '2020-11-17 16:38:12'),
(3, 'FOR PUBLISHERS', 0x3c703e52756c65733a203c7370616e207374796c653d22666f6e742d73697a653a20323470783b223e3c7370616e207374796c653d22636f6c6f723a20726762283130322c20302c20323535293b223e3c7374726f6e673e6e6f6e653c2f7374726f6e673e3c2f7370616e3e3c2f7370616e3e3c2f703e, 4, 2, '2020-11-17 16:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `privilege_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `removable` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`privilege_id`),
  UNIQUE KEY `username` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`privilege_id`, `name`, `description`, `removable`) VALUES
(1, 'Admin Panel', 'View admin panel.', 0),
(2, 'Add User', 'Add user manualy.', 0),
(3, 'Delete User', 'Delete user.', 0),
(4, 'Add Page', 'Add page.', 0),
(5, 'Delete Page', 'Delete page.', 0),
(6, 'Add Role', 'Add role.', 0),
(7, 'Delete Role', 'Delete role.', 0),
(8, 'Assign Role', 'Assign user a role.', 0),
(9, 'Add Privilege', 'Add privilege.', 0),
(10, 'Delete Privilege', 'Delete a privilege.', 0),
(11, 'Assign Privilege', 'Add a privilege to a role.', 0),
(12, 'Remove Privilege', 'Remove privilege from a role.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `removable` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `username` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `name`, `description`, `removable`) VALUES
(1, 'Admin', 'System admin with highest privileges.', 0),
(2, 'User', 'Default registered user.', 0),
(3, 'Publisher', 'Publish content.', 1),
(4, 'Moderator', 'Moderate content, users and assign roles.', 1),
(5, 'Tester', 'For testing purposes.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) UNSIGNED NOT NULL DEFAULT 2,
  `joined` datetime NOT NULL,
  `login` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_USER_ROLE` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `joined`, `login`) VALUES
(1, 'admin', 'admin@adm.lt', '$2y$10$93eis2uC6uJkYcSHxBKq7eL1xwklbcCMcUTYN8cGsm.b18s2wNmr.', 1, '2020-11-17 16:02:50', '2020-11-17 16:10:17'),
(2, 'Testeris', 'test@test.lt', '$2y$10$uJFKMiZ9QdRypBwylYGzz.V7lL9WTzvhXciUqUZQCR5H3v8F6de5S', 5, '2020-11-17 16:04:36', NULL),
(3, 'Belekas', 'belekas@gmail.com', '$2y$10$NQGMerU/.pz.Ppun5k7ic.gD1e.h6AOpbABm1oBLRosU9dGNfNiA2', 2, '2020-11-17 16:05:32', NULL),
(4, 'VytenisR', 'nesakysiu@gmail.com', '$2y$10$IfLkNEYNYBueDJlBxoi56e4.wymAzl7bBzDIzxwS.V7sFkPVF1gfG', 3, '2020-11-17 16:12:01', '2020-11-17 16:41:10'),
(5, 'darvienas', 'darvienas@dar.lt', '$2y$10$7IcPG8hR4E1DunJuXaynzOUxvg7xZY6M3BDqNa19l48WvJakhr9se', 2, '2020-11-17 16:13:13', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `FK_PRIVILEGE_ASSIGNMENT` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`privilege_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ROLE_ASSIGNMENT` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
