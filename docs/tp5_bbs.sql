/*
Navicat MySQL Data Transfer

Target Server Type    : MYSQL
Target Server Version : 50637
File Encoding         : 65001

Date: 2019-11-08 13:29:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tpt_banner
-- ----------------------------
DROP TABLE IF EXISTS `tpt_banner`;
CREATE TABLE `tpt_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(100) DEFAULT NULL COMMENT '图片',
  `time` varchar(32) NOT NULL COMMENT '时间',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `links` varchar(100) DEFAULT NULL COMMENT '连接',
  `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tpt_category
-- ----------------------------
DROP TABLE IF EXISTS `tpt_category`;
CREATE TABLE `tpt_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT '上级',
  `name` varchar(32) NOT NULL COMMENT '名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型',
  `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示',
  `sidebar` tinyint(1) NOT NULL DEFAULT '1' COMMENT '侧栏',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `pic` varchar(100) DEFAULT NULL COMMENT '图片',
  `time` varchar(32) NOT NULL COMMENT '时间',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键词',
  `description` varchar(200) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tpt_comment
-- ----------------------------
DROP TABLE IF EXISTS `tpt_comment`;
CREATE TABLE `tpt_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT '上级评论',
  `uid` int(11) NOT NULL COMMENT '所属会员',
  `fid` int(11) NOT NULL COMMENT '所属帖子',
  `mid` int(11) NOT NULL DEFAULT '0',
  `time` varchar(11) NOT NULL COMMENT '时间',
  `praise` varchar(11) NOT NULL DEFAULT '0' COMMENT '赞',
  `reply` varchar(11) NOT NULL DEFAULT '0' COMMENT '回复',
  `mes` tinyint(1) NOT NULL DEFAULT '1' COMMENT '清理',
  `content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tpt_forum
-- ----------------------------
DROP TABLE IF EXISTS `tpt_forum`;
CREATE TABLE `tpt_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT '上级',
  `uid` int(11) NOT NULL COMMENT '用户',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `open` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示',
  `choice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '精贴',
  `settop` tinyint(1) NOT NULL DEFAULT '0' COMMENT '顶置',
  `praise` varchar(11) NOT NULL DEFAULT '0' COMMENT '赞',
  `view` varchar(11) NOT NULL COMMENT '浏览量',
  `time` varchar(11) NOT NULL COMMENT '时间',
  `reply` varchar(11) NOT NULL DEFAULT '0' COMMENT '回复',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键词',
  `description` varchar(200) DEFAULT NULL COMMENT '描述',
  `content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tpt_links
-- ----------------------------
DROP TABLE IF EXISTS `tpt_links`;
CREATE TABLE `tpt_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '名称',
  `links` varchar(100) DEFAULT NULL COMMENT '连接',
  `time` varchar(32) NOT NULL COMMENT '时间',
  `pic` varchar(100) DEFAULT NULL COMMENT '图片',
  `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tpt_member
-- ----------------------------
DROP TABLE IF EXISTS `tpt_member`;
CREATE TABLE `tpt_member` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `userip` varchar(32) NOT NULL COMMENT 'IP',
  `username` varchar(32) NOT NULL COMMENT '名称',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `kouling` varchar(32) DEFAULT NULL COMMENT '口令',
  `userhead` varchar(100) NOT NULL COMMENT '头像',
  `usermail` varchar(32) NOT NULL COMMENT '邮箱',
  `regtime` varchar(32) NOT NULL COMMENT '注册时间',
  `grades` tinyint(1) NOT NULL DEFAULT '0' COMMENT '等级',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '验证',
  `reply` int(11) NOT NULL DEFAULT '0' COMMENT '回复',
  `userhome` varchar(32) DEFAULT NULL COMMENT '家乡',
  `description` varchar(200) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tpt_navtop
-- ----------------------------
DROP TABLE IF EXISTS `tpt_navtop`;
CREATE TABLE `tpt_navtop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT '上级导航',
  `link` varchar(100) DEFAULT NULL COMMENT '连接',
  `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示',
  `sort` int(11) NOT NULL COMMENT '排序',
  `name` varchar(32) NOT NULL COMMENT '名称',
  `time` varchar(32) NOT NULL COMMENT '时间',
  `blank` tinyint(1) NOT NULL DEFAULT '0' COMMENT '窗口',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
