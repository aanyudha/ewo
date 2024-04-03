/*
SQLyog Professional v10.42 
MySQL - 5.5.62-log : Database - ewohotel_tntrm
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ewohotel_tntrm` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ewohotel_tntrm`;

/*Table structure for table `audios` */

DROP TABLE IF EXISTS `audios`;

CREATE TABLE `audios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `audio_path` varchar(255) DEFAULT NULL,
  `audio_name` varchar(500) DEFAULT NULL,
  `musician` varchar(500) DEFAULT NULL,
  `download_button` tinyint(1) DEFAULT '1',
  `user_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `audios` */

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `name_slug` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `block_type` varchar(255) DEFAULT NULL,
  `category_order` int(11) DEFAULT '0',
  `show_at_homepage` tinyint(1) DEFAULT '1',
  `show_on_menu` tinyint(1) DEFAULT '1',
  `visibility` int(10) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

insert  into `categories`(`id`,`lang_id`,`name`,`name_slug`,`parent_id`,`description`,`keywords`,`color`,`block_type`,`category_order`,`show_at_homepage`,`show_on_menu`,`visibility`,`created_at`) values (1,1,'New','new',0,'','','#c9aa08','block-1',1,0,0,2,'2019-12-04 16:07:39'),(2,1,'In Progress','in-progress',0,'','','#000000','block-1',2,0,0,1,'2019-12-04 16:08:19'),(3,1,'Waiting','waiting',0,'','','#bf0000','block-1',3,0,0,1,'2019-12-04 16:12:00'),(4,1,'Closed','closed',0,'','','#00ad1b','block-1',4,0,0,1,'2019-12-04 16:12:19'),(5,1,'Pending','pending',0,'','','#9f00c6','block-1',5,0,0,1,'2019-12-11 08:52:42'),(6,1,'Re-Open','re-open',0,NULL,NULL,'#0426d8',NULL,6,NULL,NULL,0,'2019-12-20 09:57:42');

/*Table structure for table `corps` */

DROP TABLE IF EXISTS `corps`;

CREATE TABLE `corps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `corp_code` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `corp_order` smallint(6) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `corps` */

insert  into `corps`(`id`,`name`,`corp_code`,`status`,`corp_order`,`created_at`) values (1,'Hotel Tentrem Yogyakarta','JOGHTY',1,1,NULL),(2,'Hotel Tentrem Semarang','SMGHTS',1,2,NULL),(3,'Hotel Chanti Semarang','SMGHCS',1,3,NULL);

/*Table structure for table `general_settings` */

DROP TABLE IF EXISTS `general_settings`;

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_lang` int(11) NOT NULL DEFAULT '1',
  `multilingual_system` tinyint(1) DEFAULT '1',
  `site_color` varchar(100) DEFAULT 'default',
  `show_hits` tinyint(1) DEFAULT '1',
  `show_rss` tinyint(1) DEFAULT '1',
  `show_newsticker` tinyint(1) DEFAULT '1',
  `pagination_per_page` smallint(6) DEFAULT '10',
  `google_analytics` text,
  `primary_font` varchar(255) DEFAULT NULL,
  `secondary_font` varchar(255) DEFAULT NULL,
  `tertiary_font` varchar(255) DEFAULT NULL,
  `mail_library` varchar(100) DEFAULT 'swift',
  `mail_protocol` varchar(100) DEFAULT 'smtp',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT '587',
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_title` varchar(255) DEFAULT NULL,
  `google_client_id` varchar(500) DEFAULT NULL,
  `google_client_secret` varchar(500) DEFAULT NULL,
  `vk_app_id` varchar(500) DEFAULT NULL,
  `vk_secure_key` varchar(500) DEFAULT NULL,
  `facebook_app_id` varchar(500) DEFAULT NULL,
  `facebook_app_secret` varchar(500) DEFAULT NULL,
  `facebook_comment` text,
  `facebook_comment_active` tinyint(1) DEFAULT '1',
  `show_featured_section` tinyint(1) DEFAULT '1',
  `show_latest_posts` tinyint(1) DEFAULT '1',
  `registration_system` tinyint(1) DEFAULT '1',
  `comment_system` tinyint(1) DEFAULT '1',
  `show_post_author` tinyint(1) DEFAULT '1',
  `show_post_date` tinyint(1) DEFAULT '1',
  `menu_limit` tinyint(4) DEFAULT '8',
  `head_code` text,
  `recaptcha_site_key` varchar(255) DEFAULT NULL,
  `recaptcha_secret_key` varchar(255) DEFAULT NULL,
  `recaptcha_lang` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `emoji_reactions` tinyint(1) DEFAULT '1',
  `mail_contact_status` tinyint(1) DEFAULT '0',
  `mail_contact` varchar(255) DEFAULT NULL,
  `cache_system` tinyint(1) DEFAULT '0',
  `cache_refresh_time` int(11) DEFAULT '1800',
  `refresh_cache_database_changes` tinyint(1) DEFAULT '0',
  `email_verification` tinyint(1) DEFAULT '0',
  `file_manager_show_files` tinyint(1) DEFAULT '1',
  `approve_added_user_posts` tinyint(1) DEFAULT '1',
  `approve_updated_user_posts` tinyint(1) DEFAULT '1',
  `timezone` varchar(255) DEFAULT 'America/New_York',
  `sort_slider_posts` varchar(100) DEFAULT 'by_slider_order',
  `sort_featured_posts` varchar(100) DEFAULT 'by_featured_order',
  `newsletter` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `general_settings` */

insert  into `general_settings`(`id`,`site_lang`,`multilingual_system`,`site_color`,`show_hits`,`show_rss`,`show_newsticker`,`pagination_per_page`,`google_analytics`,`primary_font`,`secondary_font`,`tertiary_font`,`mail_library`,`mail_protocol`,`mail_host`,`mail_port`,`mail_username`,`mail_password`,`mail_title`,`google_client_id`,`google_client_secret`,`vk_app_id`,`vk_secure_key`,`facebook_app_id`,`facebook_app_secret`,`facebook_comment`,`facebook_comment_active`,`show_featured_section`,`show_latest_posts`,`registration_system`,`comment_system`,`show_post_author`,`show_post_date`,`menu_limit`,`head_code`,`recaptcha_site_key`,`recaptcha_secret_key`,`recaptcha_lang`,`created_at`,`emoji_reactions`,`mail_contact_status`,`mail_contact`,`cache_system`,`cache_refresh_time`,`refresh_cache_database_changes`,`email_verification`,`file_manager_show_files`,`approve_added_user_posts`,`approve_updated_user_posts`,`timezone`,`sort_slider_posts`,`sort_featured_posts`,`newsletter`) values (1,1,0,'default',1,1,1,16,NULL,'open_sans','roboto','verdana','swift','smtp',NULL,'587',NULL,NULL,'Hotel Tentrem',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,1,1,1,1,1,8,NULL,NULL,NULL,NULL,'2019-05-25 07:11:07',1,0,NULL,1,1500,1,0,1,1,1,'Asia/Jakarta','by_slider_order','by_featured_order',1);

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT '1',
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_mime` varchar(50) DEFAULT 'jpg',
  `user_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `images` */

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_form` varchar(255) NOT NULL,
  `language_code` varchar(100) NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `text_direction` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `language_order` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `languages` */

insert  into `languages`(`id`,`name`,`short_form`,`language_code`,`folder_name`,`text_direction`,`status`,`language_order`) values (1,'English','en','en-US','default','ltr',1,1);

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `name_slug` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `block_type` varchar(255) DEFAULT NULL,
  `location_order` int(11) DEFAULT '0',
  `show_at_homepage` tinyint(1) DEFAULT '1',
  `show_on_menu` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `corp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `locations` */

insert  into `locations`(`id`,`lang_id`,`name`,`name_slug`,`parent_id`,`description`,`keywords`,`color`,`block_type`,`location_order`,`show_at_homepage`,`show_on_menu`,`created_at`,`corp_id`) values (1,1,'Room','room',0,NULL,NULL,'#af1818',NULL,1,NULL,NULL,'2020-01-29 09:13:52',1),(2,1,'Sub Room','sub-room',1,NULL,NULL,'#af1818',NULL,NULL,NULL,NULL,'2020-01-29 09:14:03',NULL);

/*Table structure for table `post_audios` */

DROP TABLE IF EXISTS `post_audios`;

CREATE TABLE `post_audios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `audio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `post_audios` */

/*Table structure for table `post_images` */

DROP TABLE IF EXISTS `post_images`;

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `post_images` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT '1',
  `title` varchar(500) DEFAULT NULL,
  `title_slug` varchar(500) DEFAULT NULL,
  `title_hash` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `summary` varchar(5000) DEFAULT NULL,
  `content` longtext,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `sublocation_id` int(11) DEFAULT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_mime` varchar(20) DEFAULT 'jpg',
  `hit` int(11) DEFAULT '0',
  `optional_url` varchar(1000) DEFAULT NULL,
  `need_auth` tinyint(1) DEFAULT '0',
  `visibility` tinyint(1) DEFAULT '1',
  `show_right_column` tinyint(1) DEFAULT '1',
  `post_type` varchar(50) DEFAULT 'post',
  `video_path` varchar(255) DEFAULT NULL,
  `image_url` varchar(2000) DEFAULT NULL,
  `video_embed_code` varchar(2000) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `assign_to` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `feed_id` int(11) DEFAULT NULL,
  `post_url` varchar(1000) DEFAULT NULL,
  `show_post_url` tinyint(1) DEFAULT '1',
  `image_description` varchar(500) DEFAULT NULL,
  `show_item_numbers` tinyint(1) DEFAULT '1',
  `edited_by` int(11) DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

/*Table structure for table `posts_logs` */

DROP TABLE IF EXISTS `posts_logs`;

CREATE TABLE `posts_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT '1',
  `title` varchar(500) DEFAULT NULL,
  `title_slug` varchar(500) DEFAULT NULL,
  `title_hash` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `summary` varchar(5000) DEFAULT NULL,
  `content` longtext,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `sublocation_id` int(11) DEFAULT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_mime` varchar(20) DEFAULT 'jpg',
  `hit` int(11) DEFAULT '0',
  `optional_url` varchar(1000) DEFAULT NULL,
  `need_auth` tinyint(1) DEFAULT '0',
  `visibility` tinyint(1) DEFAULT '1',
  `show_right_column` tinyint(1) DEFAULT '1',
  `post_type` varchar(50) DEFAULT 'post',
  `video_path` varchar(255) DEFAULT NULL,
  `image_url` varchar(2000) DEFAULT NULL,
  `video_embed_code` varchar(2000) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `assign_to` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `feed_id` int(11) DEFAULT NULL,
  `post_url` varchar(1000) DEFAULT NULL,
  `show_post_url` tinyint(1) DEFAULT '1',
  `image_description` varchar(500) DEFAULT NULL,
  `show_item_numbers` tinyint(1) DEFAULT '1',
  `edited_by` int(11) DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `posts_logs` */

/*Table structure for table `roles_permissions` */

DROP TABLE IF EXISTS `roles_permissions`;

CREATE TABLE `roles_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `admin_panel` tinyint(1) DEFAULT NULL,
  `add_post` tinyint(1) DEFAULT NULL,
  `manage_all_posts` tinyint(1) DEFAULT NULL,
  `pages` tinyint(1) DEFAULT NULL,
  `rss_feeds` tinyint(1) DEFAULT NULL,
  `categories` tinyint(1) DEFAULT NULL,
  `users` tinyint(1) DEFAULT NULL,
  `navigation` tinyint(1) DEFAULT NULL,
  `locations` tinyint(1) DEFAULT NULL,
  `corps` tinyint(1) DEFAULT NULL,
  `widgets` tinyint(1) DEFAULT NULL,
  `polls` tinyint(1) DEFAULT NULL,
  `gallery` tinyint(1) DEFAULT NULL,
  `comments_contact` tinyint(1) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `ad_spaces` tinyint(1) DEFAULT NULL,
  `seo_tools` tinyint(1) DEFAULT NULL,
  `settings` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `roles_permissions` */

insert  into `roles_permissions`(`id`,`role`,`role_name`,`admin_panel`,`add_post`,`manage_all_posts`,`pages`,`rss_feeds`,`categories`,`users`,`navigation`,`locations`,`corps`,`widgets`,`polls`,`gallery`,`comments_contact`,`newsletter`,`ad_spaces`,`seo_tools`,`settings`) values (1,'admin','Admin',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),(3,'author','Engineering',1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(4,'user','User',1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(5,'author1','IT',1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(6,'author2','Housekeeping',1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(7,'author3','Admin Corp',1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1);

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) NOT NULL DEFAULT '1',
  `site_title` varchar(255) DEFAULT NULL,
  `home_title` varchar(255) DEFAULT 'Index',
  `site_description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `application_name` varchar(255) DEFAULT NULL,
  `optional_url_button_name` varchar(500) DEFAULT 'Click Here To See More',
  `about_footer` varchar(1000) DEFAULT NULL,
  `contact_text` text,
  `contact_address` varchar(500) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `copyright` varchar(500) DEFAULT NULL,
  `cookies_warning` tinyint(1) DEFAULT '0',
  `cookies_warning_text` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `settings` */

insert  into `settings`(`id`,`lang_id`,`site_title`,`home_title`,`site_description`,`keywords`,`application_name`,`optional_url_button_name`,`about_footer`,`contact_text`,`contact_address`,`contact_email`,`contact_phone`,`copyright`,`cookies_warning`,`cookies_warning_text`,`created_at`) values (1,1,'Hotel Tentrem e-WO','Index','Tentrem Index Page','index, home, tentrem','Hotel Tentrem',NULL,NULL,NULL,NULL,NULL,NULL,'Copyright © 2019 Hotel Tentrem - All Rights Reserved.',NULL,NULL,'2019-05-26 13:48:34');

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
  `avatar` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `about_me` varchar(5000) DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(100) DEFAULT NULL,
  `corp_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`first_name`,`last_name`,`slug`,`email`,`email_status`,`token`,`password`,`role_id`,`role`,`user_type`,`avatar`,`status`,`about_me`,`last_seen`,`created_at`,`ip_address`,`corp_id`) values (1,'admin@gmail.com','Bang','Admin','admingmail.com','admin@gmail.com',1,'5dc4c44b3b546','$2a$08$jGTV3agNEZIVDjoYWFhvWOXocKNYti/p3ZTAtRn06awRkhwqLk8LG',1,'admin','registered','uploads/profile/avatar_1_5e26df07d4493.jpg',1,NULL,'2020-01-31 09:08:40','2019-11-08 08:26:35','192.168.1.122',NULL),(3,'hkgmailcom','Ari','Wibowo','hkgmailcom','hk@gmail.com',1,'5e26d6c40a1578-08685839-38405151','$2a$08$ZAPsC.QOU4NTbmMdpVk4Pebmy9jfsfg.oMXXBpffgpoQCCqhHbTSO',6,'author2','registered',NULL,1,NULL,NULL,'2020-01-21 17:47:32',NULL,'1'),(4,'enggmailcom','Bary','Prima','enggmailcom','eng@gmail.com',1,'5e26d6dd7bf6c7-95046017-94130554','$2a$08$M0cfr1/h4F0mvd4ikmd61u4mDXhUmX3UDQEv.XJJcrSPf.Y.MLjhK',3,'author','registered',NULL,1,NULL,'2020-01-23 18:37:44','2020-01-21 17:47:57','192.168.1.122','2'),(5,'aanyudha2gmailcom','Aans','Yudha','aanyudha2gmailcom','aanyudha2@gmail.com',1,'5e26d7013f0855-51217755-13043212','$2a$08$6QIr268SIHIgkLsvF0Ay/u7lH8ksIqI6n7XjXEYq0yjqZSIpW/HW.',5,'author1','registered',NULL,1,NULL,'2020-01-28 13:52:27','2020-01-21 17:48:33','192.168.1.122','1'),(6,'hasangmailcom','Hasan','Basri','hasangmailcom','hasan@gmail.com',1,'5e26d71f96ab81-37788367-74096984','$2a$08$lpQ2qMBS7uceZfLFH/Syw.pMTj21K2KWZ6.TJrULGT5m2nxPH1cmS',4,'user','registered',NULL,1,NULL,'2020-01-21 17:58:33','2020-01-21 17:49:03','192.168.13.247','2'),(7,'raisagmailcom','Raisa','Adriana','raisagmailcom','raisa@gmail.com',1,'5e298423251384-48985974-65857238','$2a$08$kLWK1V/hjoE.Bh0VoMTXzOtNUQrRCeBmms/xUoQs5fjVQKLaivXwK',4,'user','registered',NULL,1,NULL,'2020-01-29 09:13:16','2020-01-23 18:31:47','192.168.1.122','1'),(8,'isyanagmailcom','Isyana','Saraswati','isyanagmailcom','isyana@gmail.com',1,'5e29845c42b860-21601580-53143310','$2a$08$936UbdXbFa.YQbVUBqXhGOizavwheUa2LPXAhXjAAMRiSuXoA2GW.',4,'user','registered',NULL,1,NULL,'2020-01-25 15:51:13','2020-01-23 18:32:44','192.168.1.122','2'),(9,'admykgmailcom','Michael','Panjaitan','admykgmailcom','admyk@gmail.com',1,'5e2a71edf13a02-67640211-27737426','$2a$08$s8kAH8W.d.LzMp7IoCzHhOytlp8hGVke3p31ZJX2xQoB4GmytfKd.',7,'author3','registered',NULL,1,NULL,'2020-01-31 09:13:49','2020-01-24 11:26:21','192.168.1.122','1'),(10,'hanyagmailcom','Hanya','coba','hanyagmailcom','hanya@gmail.com',1,'5e2ad132cda896-54963853-60949096','$2a$08$El5wV/vMJS6n7GBoVgP8GeSOV7UAeh/x6zhWnqsNiVE6AkgYpaOiO',7,'author3','registered',NULL,1,NULL,'2020-01-25 16:03:47','2020-01-24 18:12:50','192.168.1.122','2');

/*Table structure for table `users_logs` */

DROP TABLE IF EXISTS `users_logs`;

CREATE TABLE `users_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `users_logs` */

insert  into `users_logs`(`id`,`user_id`,`last_seen`,`ip_address`) values (1,1,'2020-01-31 09:07:59','192.168.1.122'),(2,1,'2020-01-31 09:08:02','192.168.1.122'),(3,1,'2020-01-31 09:08:07','192.168.1.122'),(4,1,'2020-01-31 09:08:07','192.168.1.122'),(5,1,'2020-01-31 09:08:13','192.168.1.122'),(6,1,'2020-01-31 09:08:17','192.168.1.122'),(7,1,'2020-01-31 09:08:20','192.168.1.122'),(8,1,'2020-01-31 09:08:28','192.168.1.122'),(9,1,'2020-01-31 09:08:34','192.168.1.122'),(10,1,'2020-01-31 09:08:40','192.168.1.122'),(11,9,'2020-01-31 09:08:47','192.168.1.122'),(12,9,'2020-01-31 09:09:57','192.168.1.122'),(13,9,'2020-01-31 09:10:27','192.168.1.122'),(14,9,'2020-01-31 09:10:51','192.168.1.122'),(15,9,'2020-01-31 09:10:53','192.168.1.122'),(16,9,'2020-01-31 09:13:15','192.168.1.122'),(17,9,'2020-01-31 09:13:42','192.168.1.122'),(18,9,'2020-01-31 09:13:49','192.168.1.122');

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_name` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `videos` */

/*Table structure for table `visual_settings` */

DROP TABLE IF EXISTS `visual_settings`;

CREATE TABLE `visual_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_color` varchar(100) NOT NULL DEFAULT 'default',
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `visual_settings` */

insert  into `visual_settings`(`id`,`site_color`,`logo`,`favicon`) values (1,'default','uploads/logo/logo_5e2fff2ceac13.png','uploads/logo/logo_5e2ffe808dfb3.png');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
