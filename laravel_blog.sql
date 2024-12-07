/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : laravel_blog

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2024-11-28 17:24:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT ,
  `post_id` int(11) NOT NULL COMMENT ,
  `message` text COMMENT ,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('8', '6', '2', 'This article is very good', '2024-11-27 16:22:32', '2024-11-27 16:22:32');
INSERT INTO `comments` VALUES ('10', '1', '4', '非常好', '2024-11-27 17:43:40', '2024-11-27 17:43:40');
INSERT INTO `comments` VALUES ('13', '6', '1', '今天天气非常好', '2024-11-28 03:12:13', '2024-11-28 03:12:13');
INSERT INTO `comments` VALUES ('16', '6', '1', 'hi', '2024-11-28 03:20:01', '2024-11-28 03:20:01');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT,
  `img` varchar(255) DEFAULT NULL COMMENT,
  `content` text NOT NULL COMMENT,
  `author` varchar(255) DEFAULT NULL COMMENT,
  `published_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT,
  `comment_count` int(11) DEFAULT '0' COMMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT=;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', 'How to Create Template', '/images/1.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas voluptatem et minima quo amet ducimus. Voluptatum soluta tenetur ducimus fugiat, sint voluptate eveniet adipisci nulla asperiores distinctio laudantium eos. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident tenetur, consectetur dolores nostrum, numquam facere a dicta eum nam suscipit consequuntur dolorem aspernatur molestias vero quo id tempore vel possimus.</p>\r\n                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas voluptatem et minima quo amet ducimus. Voluptatum soluta tenetur ducimus fugiat, sint voluptate eveniet adipisci nulla asperiores distinctio laudantium eos. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident tenetur, consectetur dolores nostrum, numquam facere a dicta eum nam suscipit consequuntur dolorem aspernatur molestias vero quo id tempore vel possimus.</p>\r\n                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas voluptatem et minima quo amet ducimus. Voluptatum soluta tenetur ducimus fugiat, sint voluptate eveniet adipisci nulla asperiores distinctio laudantium eos. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident tenetur, consectetur dolores nostrum, numquam facere a dicta eum nam suscipit consequuntur dolorem aspernatur molestias vero quo id tempore vel possimus.</p>\r\n                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas voluptatem et minima quo amet ducimus. Voluptatum soluta tenetur ducimus fugiat, sint voluptate eveniet adipisci nulla asperiores.</p>', 'John Doe', '2024-11-28 11:20:01', '6', null, '2024-11-28 03:20:01');
INSERT INTO `posts` VALUES ('2', 'Clean Personal Blog Template', '/images/2.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas voluptatem et minima quo amet ducimus. Voluptatum soluta tenetur ducimus fugiat, sint voluptate eveniet adipisci nulla asperiores distinctio laudantium eos. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident tenetur, consectetur dolores nostrum, numquam facere a dicta eum nam suscipit consequuntur dolorem aspernatur molestias vero quo id tempore vel possimus.</p>', 'John Doe', '2024-11-28 01:56:28', '2', null, '2024-11-27 16:23:03');
INSERT INTO `posts` VALUES ('3', 'Blackor - Responsive HTML5 Theme', '/images/3.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas voluptatem et minima quo amet ducimus. Voluptatum soluta tenetur ducimus fugiat, sint voluptate eveniet adipisci nulla asperiores distinctio laudantium eos. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident tenetur, consectetur dolores nostrum, numquam facere a dicta eum nam suscipit consequuntur dolorem aspernatur molestias vero quo id tempore vel possimus.</p>', 'John Doe', '2024-11-27 20:12:11', '0', null, null);
INSERT INTO `posts` VALUES ('4', 'How to Create Template', '/images/4.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas voluptatem et minima quo amet ducimus. Voluptatum soluta tenetur ducimus fugiat, sint voluptate eveniet adipisci nulla asperiores distinctio laudantium eos. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident tenetur, consectetur dolores nostrum, numquam facere a dicta eum nam suscipit consequuntur dolorem aspernatur molestias vero quo id tempore vel possimus.</p>', 'John Doe', '2024-11-28 01:43:40', '1', null, '2024-11-27 17:43:40');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT '0' COMMENT '1的时候为管理员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Jerry', 'jerrt@uws.com', '$2y$10$0HcExwWDAOMp/w7m3XusZ.UQFwcTQvk6gmKjmGVILAx7YrjSs/gRq', '2024-11-27 09:47:35', '2024-11-27 09:47:35', '0');
INSERT INTO `users` VALUES ('6', 'Peter', 'peter@uws.com', '$2y$10$0HcExwWDAOMp/w7m3XusZ.UQFwcTQvk6gmKjmGVILAx7YrjSs/gRq', '2024-11-27 10:52:12', '2024-11-27 10:52:12', '1');
INSERT INTO `users` VALUES ('8', 'Jenny', 'jenny@uws.com', '$2y$10$fIVQKNWWC6pHXA8ui9QTiOvrRE0pbO8foXdoTZBFKrQsyYmP7jt..', '2024-11-28 03:18:42', '2024-11-28 03:18:42', '0');
