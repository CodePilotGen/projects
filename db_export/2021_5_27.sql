/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.8-MariaDB : Database - thinkframe
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`thinkframe` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `thinkframe`;

/*Table structure for table `advice` */

DROP TABLE IF EXISTS `advice`;

CREATE TABLE `advice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `advice` */

/*Table structure for table `auth_logins` */

DROP TABLE IF EXISTS `auth_logins`;

CREATE TABLE `auth_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `successfull` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `auth_logins` */

insert  into `auth_logins`(`id`,`user_id`,`firstname`,`lastname`,`role`,`ip_address`,`date`,`successfull`) values 
(1,1,'leo','eagle','2','127.0.0.1','2021-05-24 09:41:10',1),
(2,1,'leo','eagle','2','127.0.0.1','2021-05-24 11:39:55',1),
(3,1,'leo','eagle','2','127.0.0.1','2021-05-24 11:40:10',1),
(4,1,'leo','eagle','2','127.0.0.1','2021-05-24 18:27:49',1),
(5,1,'leo','eagle','2','127.0.0.1','2021-05-24 20:17:17',1),
(6,1,'leo','eagle','2','::1','2021-05-26 08:31:03',1),
(7,1,'leo','eagle','2','127.0.0.1','2021-05-26 08:31:18',1),
(8,1,'leo','eagle','2','127.0.0.1','2021-05-26 10:52:59',1),
(9,1,'leo','eagle','2','127.0.0.1','2021-05-26 10:53:37',1),
(10,1,'leo','eagle','2','127.0.0.1','2021-05-26 11:03:34',1),
(11,1,'leo','eagle','2','127.0.0.1','2021-05-26 15:52:34',1),
(12,1,'leo','eagle','2','127.0.0.1','2021-05-26 16:30:27',1),
(13,1,'leo','eagle','2','127.0.0.1','2021-05-26 16:42:37',1);

/*Table structure for table `auth_tokens` */

DROP TABLE IF EXISTS `auth_tokens`;

CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedvalidator` varchar(255) NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `auth_tokens` */

/*Table structure for table `combo` */

DROP TABLE IF EXISTS `combo`;

CREATE TABLE `combo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `combo` */

/*Table structure for table `combo_hypo` */

DROP TABLE IF EXISTS `combo_hypo`;

CREATE TABLE `combo_hypo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `combo_id` int(11) NOT NULL,
  `hypo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `combo_id` (`combo_id`),
  KEY `hypo_id` (`hypo_id`),
  CONSTRAINT `combo_hypo_ibfk_1` FOREIGN KEY (`combo_id`) REFERENCES `combo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `combo_hypo_ibfk_2` FOREIGN KEY (`hypo_id`) REFERENCES `hypothesis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `combo_hypo` */

/*Table structure for table `expert` */

DROP TABLE IF EXISTS `expert`;

CREATE TABLE `expert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `expert` */

/*Table structure for table `hypothesis` */

DROP TABLE IF EXISTS `hypothesis`;

CREATE TABLE `hypothesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `hypothesis` */

/*Table structure for table `option` */

DROP TABLE IF EXISTS `option`;

CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'option id',
  `content` text NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `option_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `option` */

/*Table structure for table `option_hypo` */

DROP TABLE IF EXISTS `option_hypo`;

CREATE TABLE `option_hypo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `hypo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `option_id` (`option_id`),
  KEY `hypo_id` (`hypo_id`),
  CONSTRAINT `option_hypo_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `option_hypo_ibfk_2` FOREIGN KEY (`hypo_id`) REFERENCES `hypothesis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `option_hypo` */

/*Table structure for table `question` */

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'question id',
  `content` text NOT NULL COMMENT 'question content',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `question` */

/*Table structure for table `quizlist` */

DROP TABLE IF EXISTS `quizlist`;

CREATE TABLE `quizlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `option_id` (`option_id`),
  CONSTRAINT `quizlist_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `quizlist_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `quizlist` */

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_roles` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(250) NOT NULL,
  `reset_expire` datetime DEFAULT NULL,
  `activated` tinyint(1) NOT NULL,
  `activate_token` varchar(250) DEFAULT NULL,
  `activate_expire` varchar(250) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`firstname`,`lastname`,`email`,`password`,`reset_token`,`reset_expire`,`activated`,`activate_token`,`activate_expire`,`role`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'leo','eagle','leoeagle12@mail.com','$argon2id$v=19$m=65536,t=4,p=1$WEF0eWE3bzVKZjVNVE1sSQ$PIAGrOyyEti6YP1AI9VFBZinmM+n5m1yS9SSmadI9sg','',NULL,1,NULL,NULL,2,'2021-05-24 07:41:04','2021-05-24 07:41:04',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
