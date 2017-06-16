/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : shop_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-06-06 20:20:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for 0201_goods
-- ----------------------------
DROP TABLE IF EXISTS `0201_goods`;
CREATE TABLE `0201_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` char(60) NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `market_price` decimal(10,2) unsigned zerofill NOT NULL DEFAULT '00000000.00',
  `shop_price` decimal(10,2) unsigned zerofill NOT NULL DEFAULT '00000000.00',
  `brand_id` int(10) unsigned zerofill NOT NULL,
  `image` char(255) NOT NULL,
  `category_id` int(10) unsigned zerofill NOT NULL DEFAULT '0000000001',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `image_UNIQUE` (`image`),
  KEY `fk_0201_goods_brand1_idx` (`brand_id`),
  KEY `fk_0201_goods_category1_idx` (`category_id`),
  CONSTRAINT `fk_0201_goods_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_0201_goods_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 0201_goods
-- ----------------------------
INSERT INTO `0201_goods` VALUES ('4', 'pp', '0', '00000000.00', '00000000.00', '0000000009', '', '0000000014');

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(18) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `admin` VALUES ('2', '123', '202cb962ac59075b964b07152d234b70');
INSERT INTO `admin` VALUES ('4', '456', '250cf8b51c773f3f8dc8b4be867a9a02');
INSERT INTO `admin` VALUES ('5', '369', '0c74b7f78409a4022a2c4c5a5ca3ee19');

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `drand_name_UNIQUE` (`brand_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('12', 'hshhh');
INSERT INTO `brand` VALUES ('9', 'oppo');
INSERT INTO `brand` VALUES ('10', '华为');
INSERT INTO `brand` VALUES ('8', '小米');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` char(10) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('13', '手机', '0');
INSERT INTO `category` VALUES ('14', '华为', '13');
INSERT INTO `category` VALUES ('15', '男装', '0');
INSERT INTO `category` VALUES ('16', '上衣', '15');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` char(255) NOT NULL,
  `level` tinyint(3) unsigned zerofill NOT NULL DEFAULT '005',
  `user_id` int(10) unsigned zerofill NOT NULL,
  `0201_goods_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_comment_user1_idx` (`user_id`),
  KEY `fk_comment_0201_goods1_idx` (`0201_goods_id`),
  CONSTRAINT `fk_comment_0201_goods1` FOREIGN KEY (`0201_goods_id`) REFERENCES `0201_goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for goods_desc
-- ----------------------------
DROP TABLE IF EXISTS `goods_desc`;
CREATE TABLE `goods_desc` (
  `content` int(11) NOT NULL,
  `0201_goods_id` int(10) unsigned NOT NULL,
  `brand` varchar(20) NOT NULL,
  `market_price` varchar(20) NOT NULL,
  `shop_price` varchar(20) NOT NULL,
  PRIMARY KEY (`0201_goods_id`),
  CONSTRAINT `fk_goods_details_0201_goods` FOREIGN KEY (`0201_goods_id`) REFERENCES `0201_goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_desc
-- ----------------------------

-- ----------------------------
-- Table structure for goods_img
-- ----------------------------
DROP TABLE IF EXISTS `goods_img`;
CREATE TABLE `goods_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `0201_goods_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_goods_img_0201_goods1_idx` (`0201_goods_id`),
  CONSTRAINT `fk_goods_img_0201_goods1` FOREIGN KEY (`0201_goods_id`) REFERENCES `0201_goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_img
-- ----------------------------

-- ----------------------------
-- Table structure for goods_type
-- ----------------------------
DROP TABLE IF EXISTS `goods_type`;
CREATE TABLE `goods_type` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_type
-- ----------------------------
INSERT INTO `goods_type` VALUES ('1', '1234');
INSERT INTO `goods_type` VALUES ('4', '999');
INSERT INTO `goods_type` VALUES ('5', '000');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(45) NOT NULL,
  `user_id` int(10) unsigned zerofill NOT NULL,
  `order_price` decimal(10,2) unsigned zerofill NOT NULL DEFAULT '00000000.00',
  `numbel` smallint(5) unsigned zerofill NOT NULL DEFAULT '00000',
  `phone` bigint(19) unsigned NOT NULL,
  `address` char(45) NOT NULL,
  `order_status` tinyint(3) unsigned zerofill NOT NULL DEFAULT '000',
  `pay_status` tinyint(3) unsigned zerofill NOT NULL DEFAULT '000',
  `shipping_status` tinyint(3) unsigned zerofill NOT NULL DEFAULT '000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `order_sn_UNIQUE` (`order_sn`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  KEY `fk_order_user1_idx` (`user_id`),
  CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_goods
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods` (
  `0201_goods_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned zerofill NOT NULL,
  `number` smallint(5) unsigned zerofill NOT NULL DEFAULT '00000',
  `market_price` decimal(10,2) unsigned zerofill NOT NULL DEFAULT '00000000.00',
  `shop_price` decimal(10,2) unsigned zerofill NOT NULL DEFAULT '00000000.00',
  PRIMARY KEY (`0201_goods_id`,`order_id`),
  KEY `fk_0201_goods_has_order_order1_idx` (`order_id`),
  KEY `fk_0201_goods_has_order_0201_goods1_idx` (`0201_goods_id`),
  CONSTRAINT `fk_0201_goods_has_order_0201_goods1` FOREIGN KEY (`0201_goods_id`) REFERENCES `0201_goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_0201_goods_has_order_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_goods
-- ----------------------------

-- ----------------------------
-- Table structure for spec
-- ----------------------------
DROP TABLE IF EXISTS `spec`;
CREATE TABLE `spec` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `spec_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spec
-- ----------------------------
INSERT INTO `spec` VALUES ('1', '123');
INSERT INTO `spec` VALUES ('2', '2');

-- ----------------------------
-- Table structure for spec_items
-- ----------------------------
DROP TABLE IF EXISTS `spec_items`;
CREATE TABLE `spec_items` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `item` char(15) NOT NULL,
  `spec_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spec_items
-- ----------------------------
INSERT INTO `spec_items` VALUES ('1', '          123', '1');
INSERT INTO `spec_items` VALUES ('2', '99', '1');
INSERT INTO `spec_items` VALUES ('3', '55', '1');
INSERT INTO `spec_items` VALUES ('4', '66', '1');
INSERT INTO `spec_items` VALUES ('5', '33', '2');
INSERT INTO `spec_items` VALUES ('6', '44', '2');
INSERT INTO `spec_items` VALUES ('7', '55', '2');
INSERT INTO `spec_items` VALUES ('8', '66', '2');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(18) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(45) NOT NULL,
  `qq` bigint(19) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  UNIQUE KEY `password_UNIQUE` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` bigint(19) unsigned NOT NULL,
  `address` varchar(45) NOT NULL,
  `name` varchar(25) NOT NULL,
  `user_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  UNIQUE KEY `user_addresscol_UNIQUE` (`address`),
  KEY `fk_user_address_user1_idx` (`user_id`),
  CONSTRAINT `fk_user_address_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_address
-- ----------------------------
