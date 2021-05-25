/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.8-MariaDB : Database - hypothesis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hypothesis` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `hypothesis`;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `auth_logins` */

insert  into `auth_logins`(`id`,`user_id`,`firstname`,`lastname`,`role`,`ip_address`,`date`,`successfull`) values 
(1,1,'leo','eagle','2','127.0.0.1','2021-05-24 09:41:10',1),
(2,1,'leo','eagle','2','127.0.0.1','2021-05-24 11:39:55',1),
(3,1,'leo','eagle','2','127.0.0.1','2021-05-24 11:40:10',1),
(4,1,'leo','eagle','2','127.0.0.1','2021-05-24 18:27:49',1);

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
