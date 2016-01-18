# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: library.cfbzubasbndu.us-west-2.rds.amazonaws.com (MySQL 5.6.23)
# Database: computer_availability
# Generation Time: 2016-01-18 20:18:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table compstatus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `compstatus`;

CREATE TABLE `compstatus` (
  `computer_number` int(11) NOT NULL DEFAULT '0',
  `computer_name` varchar(250) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `top_pos` int(11) DEFAULT '0',
  `left_pos` int(11) DEFAULT '0',
  PRIMARY KEY (`computer_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Dump of table statushistory
# ------------------------------------------------------------

DROP TABLE IF EXISTS `statushistory`;

CREATE TABLE `statushistory` (
  `computer_number` int(11) NOT NULL DEFAULT '0',
  `computer_name` varchar(250) NOT NULL DEFAULT '',
  `to_status` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `statushistory_idx1` (`computer_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
