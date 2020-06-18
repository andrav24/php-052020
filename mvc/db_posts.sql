/*
 Navicat MySQL Data Transfer

 Source Server         : conn3
 Source Server Type    : MySQL
 Source Server Version : 50729
 Source Host           : 192.168.10.10:3306
 Source Schema         : db_posts

 Target Server Type    : MySQL
 Target Server Version : 50729
 File Encoding         : 65001

 Date: 15/06/2020 19:41:37
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`author_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------
BEGIN;
INSERT INTO `posts` VALUES (16, 1, 'sdfsdfsfd', '2020-06-15 11:09:11', 'e0125ece717de78e8ce83870310d2d810b700168.png');
INSERT INTO `posts` VALUES (17, 4, 'sadgdgvsadfsd', '2020-06-15 12:38:00', '');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `date_reg` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Andrey', 'test@test.ru', 'f78ea24268686a3997cfc942f2522774be1ba3ba', '2020-06-14 15:18:00');
INSERT INTO `users` VALUES (4, 'Андрей', 'test2@test.ru', '2151303dbaf4c474ddbe54832050ae3062448186', '2020-06-14 16:53:46');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
