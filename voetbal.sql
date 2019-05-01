/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50723
Source Host           : localhost:3306
Source Database       : voetbal

Target Server Type    : MYSQL
Target Server Version : 50723
File Encoding         : 65001

Date: 2019-04-30 00:09:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `spelers`
-- ----------------------------
DROP TABLE IF EXISTS `spelers`;
CREATE TABLE `spelers` (
  `spe_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `spe_naam` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`spe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spelers
-- ----------------------------
INSERT INTO `spelers` VALUES ('2', 'Eden Hazard');
INSERT INTO `spelers` VALUES ('3', 'Vincent Kompany');
INSERT INTO `spelers` VALUES ('4', 'Kevin De Bruyne');
