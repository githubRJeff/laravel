/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-07-31 15:54:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('4', 'cool', '33', null, null, null);
INSERT INTO `student` VALUES ('11', 'name1', '14', '1', null, null);
INSERT INTO `student` VALUES ('13', 'name1', '14', '1', null, null);
INSERT INTO `student` VALUES ('15', 'ormName', '55', null, null, null);
INSERT INTO `student` VALUES ('18', 'ormName', '55', null, null, null);
INSERT INTO `student` VALUES ('19', 'ormName', '55', null, '1530178378', '1530178378');
INSERT INTO `student` VALUES ('20', 'old jeff', '22', null, '1530178946', '1530179513');
INSERT INTO `student` VALUES ('21', 'old jeff', null, null, '1530179166', '1530179513');
