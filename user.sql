/*
SQLyog Professional v10.42 
MySQL - 5.5.62-log : Database - tntrm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tntrm` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tntrm`;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT 'name@domain.com',
  `email_status` tinyint(1) DEFAULT '0',
  `token` varchar(500) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `role` varchar(100) DEFAULT 'user',
  `user_type` varchar(50) DEFAULT 'registered',
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `vk_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `about_me` varchar(5000) DEFAULT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `telegram_url` varchar(500) DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `show_email_on_profile` tinyint(1) DEFAULT '1',
  `show_rss_feeds` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`first_name`,`last_name`,`slug`,`email`,`email_status`,`token`,`password`,`role_id`,`role`,`user_type`,`google_id`,`facebook_id`,`vk_id`,`avatar`,`status`,`about_me`,`facebook_url`,`twitter_url`,`instagram_url`,`pinterest_url`,`linkedin_url`,`vk_url`,`telegram_url`,`youtube_url`,`last_seen`,`show_email_on_profile`,`show_rss_feeds`,`created_at`,`ip_address`) values (1,'admin@gmail.com','Bang','Admin','admingmail.com','admin@gmail.com',1,'5dc4c44b3b546','$2a$08$jGTV3agNEZIVDjoYWFhvWOXocKNYti/p3ZTAtRn06awRkhwqLk8LG',1,'admin','registered',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-01-21 10:53:39',1,1,'2019-11-08 08:26:35','192.168.1.122'),(2,'aanyudha',NULL,NULL,'aanyudha','aanyudha@gmail.com',1,'5de73c45409fc8-11606049-20384826','$2a$08$atzRaSROXdYKPgUG1GrfTubL4XlhV770TR6j20ks2LIxg9xlUW5X.',4,'user','registered',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-01-17 11:09:07',1,1,'2019-12-04 11:55:33','192.168.1.122'),(3,'eng1',NULL,NULL,'eng1','eng@gmail.com',1,'5e04415e617d10-34106917-33774414','$2a$08$9MNDbY6Ph3iYsoExpEONxOZ8L08quLqjYNaOZ2yWdYGWUi4gnyilG',3,'author','registered',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-01-17 09:27:33',1,1,'2019-12-26 12:13:02','192.168.1.122'),(4,'abcdIT',NULL,NULL,'abcdit','abcd@gmail.com',1,'5e04797a45b769-84538833-57499389','$2a$08$.MYZFAwXu7oprfQaW6TquefDPMyeeehFc0WErTO8Qz/nNanN6qK6i',5,'author1','registered',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-01-17 09:27:19',1,1,'2019-12-26 16:12:26','192.168.1.122'),(5,'test',NULL,NULL,'test','test@gmail.com',1,'5e04855d1c07a3-73892772-50487365','$2a$08$EvysegmWXCSzsvPqsS5qYeL4lqN4PfKJ93MHXW8Oe31DleWzMRAoC',6,'author2','registered',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-01-02 10:19:14',1,1,'2019-12-26 17:03:09','192.168.1.122'),(6,'test2',NULL,NULL,'test2','tes2t@gmail.com',1,'5e04865ff39402-53976537-28748168','$2a$08$JCdBpBe8GOtWxtbOFzpai.eLgcgp5abw1GzrAU/5/SUXAQ4qXMvuC',6,'author2','registered',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-12-31 22:43:42',1,1,'2019-12-26 17:07:27','192.168.1.122'),(7,'aaaa','Ferdinandus','Yudha','aaaa','yudha@gmail.com',1,'5e2671b5cd98c7-37914843-42420654','$2a$08$dXcBc65lXzqIqEw6ILdF3.sSaxINP7O3lQOW2GbRTmqswTg1ecwc.',5,'author1','registered',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,'2020-01-21 10:36:21',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
