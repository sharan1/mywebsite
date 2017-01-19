# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.28)
# Database: SSDI_Project
# Generation Time: 2016-11-28 03:01:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Area
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Area`;

CREATE TABLE `Area` (
  `AreaID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(55) NOT NULL DEFAULT '',
  `Type` tinyint(2) DEFAULT NULL,
  `Num_Workspaces` int(11) DEFAULT NULL,
  `IsActive` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`AreaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Area` WRITE;
/*!40000 ALTER TABLE `Area` DISABLE KEYS */;

INSERT INTO `Area` (`AreaID`, `Name`, `Type`, `Num_Workspaces`, `IsActive`)
VALUES
	(1,'Woodward Hall',1,100,1),
	(2,'Cone Center',1,80,1),
	(3,'Student Union',2,60,1),
	(4,'Epic',1,70,1),
	(5,'Motorsports Building',1,50,1),
	(6,'Portal Building',3,55,1);

/*!40000 ALTER TABLE `Area` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table BookingRequest
# ------------------------------------------------------------

DROP TABLE IF EXISTS `BookingRequest`;

CREATE TABLE `BookingRequest` (
  `RequestID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `RequestedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `StartTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `EndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Reason` text,
  `Booking_Status` int(4) NOT NULL DEFAULT '1',
  `Additional_Info` text,
  `Last_Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`RequestID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `BookingRequest` WRITE;
/*!40000 ALTER TABLE `BookingRequest` DISABLE KEYS */;

INSERT INTO `BookingRequest` (`RequestID`, `UserID`, `RequestedOn`, `StartTime`, `EndTime`, `Reason`, `Booking_Status`, `Additional_Info`, `Last_Updated`)
VALUES
	(1,1,'2016-11-16 06:16:06','2016-12-23 07:00:00','2016-12-25 19:50:00','212',0,'131','2016-11-23 23:18:20'),
	(2,1,'2016-11-23 17:35:19','2016-11-30 17:15:18','2016-12-01 05:25:18','Event #1',0,'hbkfs','2016-11-27 21:58:11'),
	(4,2,'2016-11-23 17:44:37','2016-11-03 02:10:07','2016-11-03 06:55:07','Event #2',2,'nothing','2016-11-27 21:58:45'),
	(5,1,'2016-11-26 20:55:34','2016-11-26 02:10:29','2016-11-27 01:05:29','Event #3',0,'','2016-11-27 21:58:24'),
	(6,1,'2016-11-26 20:59:31','2016-11-02 02:10:34','2016-11-02 05:25:34','Checking 2',2,'Speaker, 2 mics','2016-11-27 02:55:21'),
	(7,1,'2016-11-26 21:20:28','2016-11-27 21:05:28','2016-11-27 22:55:28','Check 2',2,'woofers','2016-11-27 02:55:05'),
	(8,3,'2016-11-27 06:23:46','2016-11-29 05:50:59','2016-11-29 13:50:59','Bible Reading',0,'2 Mics, Round Table sitting','2016-11-27 20:55:38'),
	(9,3,'2016-11-27 08:20:38','2016-11-28 08:15:58','2016-11-29 08:15:58','Event #4\n',2,'','2016-11-27 21:58:30'),
	(10,3,'2016-11-27 20:57:44','2016-11-29 20:00:20','2016-11-29 23:00:20','Information Session',2,'2 Mics, 1 Projector','2016-11-27 21:12:43'),
	(11,3,'2016-11-27 21:00:29','2016-11-28 17:00:48','2016-11-28 20:00:48','Info Session #2',1,'Mics','2016-11-27 21:00:29'),
	(12,3,'2016-11-27 21:02:33','2016-11-28 22:00:00','2016-11-28 23:00:00','info session #3',0,'','2016-11-27 21:12:42'),
	(13,3,'2016-11-27 21:04:34','2016-11-29 13:00:02','2016-11-29 14:00:02','Final Info Session',2,'','2016-11-27 21:12:41'),
	(14,3,'2016-11-27 21:06:29','2016-12-01 21:00:45','2016-12-01 23:00:45','Info Session #4',0,'','2016-11-27 21:12:44'),
	(15,3,'2016-11-27 21:08:59','2016-11-30 02:00:05','2016-11-30 17:00:05','Event #5',0,'','2016-11-27 21:58:36'),
	(16,3,'2016-11-27 21:16:16','2016-12-02 21:00:49','2016-12-02 23:00:49','Information Session : SSDI Course',1,'','2016-11-27 21:16:16');

/*!40000 ALTER TABLE `BookingRequest` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Email
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Email`;

CREATE TABLE `Email` (
  `MailID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `Type` varchar(50) NOT NULL DEFAULT '',
  `ToEmail` varchar(25) NOT NULL DEFAULT '',
  `Body` text NOT NULL,
  `SentOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Subject` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`MailID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Email` WRITE;
/*!40000 ALTER TABLE `Email` DISABLE KEYS */;

INSERT INTO `Email` (`MailID`, `UserID`, `Type`, `ToEmail`, `Body`, `SentOn`, `Subject`)
VALUES
	(1,3,'StatusChange','hhaveliw@uncc.edu','Hi Hozefa,\n	 Congratulations!\n\n	Your Booking Request : \'suehfiu\' from 2016-11-28 08:15:58 to 2016-11-29 08:15:58 is Confirmed.\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 20:53:59','BookMyRoom Notification: Event Confirmed'),
	(2,3,'StatusChange','hhaveliw@uncc.edu','Hi Hozefa,\n	 We are sorry! Your Booking Request : \'Bible Reading\' from 2016-11-29 05:50:59 to 2016-11-29 13:50:59 has been cancelled due to unavoidable circumstances.\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 20:55:38','BookMyRoom Notification: Event Cancelled'),
	(3,3,'StatusChange','hhaveliw@uncc.edu','Hi Hozefa,\n	 Your Booking Request : \'Event #5\' from 2016-11-30 02:00:05 to 2016-11-30 17:00:05 has been cancelled on your request.\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 21:09:51','BookMyRoom Notification: Event Cancelled'),
	(4,3,'StatusChange','hhaveliw@uncc.edu','Hi Hozefa,\n	 Congratulations!\n\n	Your Booking Request : \'Final Info Session\' from 2016-11-29 13:00:02 to 2016-11-29 14:00:02 is Confirmed.\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 21:12:41','BookMyRoom Notification: Event Confirmed'),
	(5,3,'StatusChange','hhaveliw@uncc.edu','Hi Hozefa,\n	 We are sorry! Your Booking Request : \'info session #3\' from 2016-11-28 22:00:00 to 2016-11-28 23:00:00 has been cancelled due to unavoidable circumstances.\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 21:12:42','BookMyRoom Notification: Event Cancelled'),
	(6,3,'StatusChange','hhaveliw@uncc.edu','Hi Hozefa,\n	 Congratulations!\n\n	Your Booking Request : \'Information Session\' from 2016-11-29 20:00:20 to 2016-11-29 23:00:20 is Confirmed.\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 21:12:43','BookMyRoom Notification: Event Confirmed'),
	(7,3,'StatusChange','hhaveliw@uncc.edu','Hi Hozefa,\n	 We are sorry! Your Booking Request : \'Info Session #4\' from 2016-12-01 21:00:45 to 2016-12-01 23:00:45 has been cancelled due to unavoidable circumstances.\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 21:12:44','BookMyRoom Notification: Event Cancelled'),
	(8,3,'RequestRecieved','hhaveliw@uncc.edu','Hi Hozefa,\n	 Your Booking Request : \'Information Session : SSDI Course\' from 2016-12-02 21:00:49 to 2016-12-02 23:00:49 has been recieved. You will get another Email upon confirmation\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 21:16:16','BookMyRoom Notification: Request Recieved'),
	(9,1,'ForgotPassword','sgirdhan@uncc.edu','Hi Sharan,\n	 Please reset your password by clicking on this link:\n\n	http://localhost/SSDI_Project/web/index.php?r=site/reset-password&hash=iiit123&username=sgirdhan\n\nRegards,\nTeam BookMyRoom\n','2016-11-27 21:22:07','Reset Password: BookMyRoom');

/*!40000 ALTER TABLE `Email` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Privilege
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Privilege`;

CREATE TABLE `Privilege` (
  `PrivilegeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `PrivilegeName` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`PrivilegeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Privilege` WRITE;
/*!40000 ALTER TABLE `Privilege` DISABLE KEYS */;

INSERT INTO `Privilege` (`PrivilegeID`, `PrivilegeName`)
VALUES
	(1,'Admin'),
	(2,'User');

/*!40000 ALTER TABLE `Privilege` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table RequestBookingPairing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `RequestBookingPairing`;

CREATE TABLE `RequestBookingPairing` (
  `PairingID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `RequestID` int(11) NOT NULL,
  `WorkspaceID` int(11) NOT NULL,
  `IsActive` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PairingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `RequestBookingPairing` WRITE;
/*!40000 ALTER TABLE `RequestBookingPairing` DISABLE KEYS */;

INSERT INTO `RequestBookingPairing` (`PairingID`, `RequestID`, `WorkspaceID`, `IsActive`)
VALUES
	(8,4,1,1),
	(9,4,2,1),
	(10,1,5,1),
	(15,2,1,1),
	(16,2,2,1),
	(17,7,4,1),
	(18,6,3,1),
	(19,5,1,1),
	(20,5,2,1),
	(21,7,6,1),
	(37,9,1,1),
	(38,9,2,1),
	(39,8,5,1),
	(42,11,4,1),
	(48,15,2,1),
	(49,13,6,1),
	(50,12,5,1),
	(51,10,1,1),
	(52,10,2,1),
	(53,14,1,1),
	(54,14,2,1),
	(55,16,1,1),
	(56,16,2,1);

/*!40000 ALTER TABLE `RequestBookingPairing` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `UserID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(55) NOT NULL DEFAULT '',
  `LastName` varchar(55) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT '',
  `UserName` varchar(50) NOT NULL DEFAULT '',
  `Password` varchar(75) NOT NULL DEFAULT '',
  `PasswordHash` varchar(75) NOT NULL DEFAULT '',
  `PhoneNum` varchar(15) DEFAULT NULL,
  `PrivilegeID` int(11) NOT NULL DEFAULT '1',
  `IsActive` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;

INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `Email`, `UserName`, `Password`, `PasswordHash`, `PhoneNum`, `PrivilegeID`, `IsActive`)
VALUES
	(1,'Sharan','Girdhani','sgirdhan@uncc.edu','sgirdhan','40be4e59b9a2a2b5dffb918c0e86b3d7','jefbuyebYmur9KdVGXLA1btnNaWwaWYl','9803377381',1,1),
	(2,'Aditya','Gupta','agupta42@uncc.edu','agupta42','40be4e59b9a2a2b5dffb918c0e86b3d7','fhwifnx0Ymur9KdVGXVA1btnNrWwrWYl','9803377381',1,1),
	(3,'Hozefa','Haveliwala','hhaveliw@uncc.edu','hozefa','e6e3be2d833cdf5d9d4c7bc2f85cd098','OhNCpdQ0Ymur9KdVGXLA1btnNaWwaWYl','7359810753',2,1),
	(4,'Akarsh','Gupta','agupta41@uncc.edu','akarsh','52118a428cf3b3cdb37658586f4fe659','IuSyYf33pB3TvzEp9-YJCh_d64HS-1DU','7049571815',2,1);

/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Workspace
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Workspace`;

CREATE TABLE `Workspace` (
  `WorkspaceID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `AreaID` int(11) NOT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `IsActive` tinyint(2) NOT NULL DEFAULT '1',
  `AdditionalInfo` text,
  PRIMARY KEY (`WorkspaceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Workspace` WRITE;
/*!40000 ALTER TABLE `Workspace` DISABLE KEYS */;

INSERT INTO `Workspace` (`WorkspaceID`, `Name`, `AreaID`, `Capacity`, `IsActive`, `AdditionalInfo`)
VALUES
	(1,'Woodward 130',1,60,1,'Academic Building'),
	(2,'Woodward 125',1,50,1,'Academic Building'),
	(3,'Student Union 340',3,200,1,''),
	(4,'Cone 251',2,180,1,'Meeting Room'),
	(5,'Epic 110',4,120,1,'Electronics Workshop'),
	(6,'Motorsports 201',5,30,1,'');

/*!40000 ALTER TABLE `Workspace` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
