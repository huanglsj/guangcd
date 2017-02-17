/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : guangcd

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-02-17 17:23:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for gc_link
-- ----------------------------
DROP TABLE IF EXISTS `gc_link`;
CREATE TABLE `gc_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `sort` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gc_link
-- ----------------------------
INSERT INTO `gc_link` VALUES ('1', '淘宝', 'www.taobao.com', '1_taobao.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('2', '阿里巴巴', null, '2_ali.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('3', '支付宝', null, '3_alipay.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('4', '拍拍', null, '4_paipai.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('5', '京东', null, '5_jd.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('6', '聚划算', null, '6_juhuasuan.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('7', '聚分宝', null, '7_jifenbao.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('8', '爱淘网', null, '8_1tao.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('9', '拉手网', null, '9_lashou.jpg', '1', null);
INSERT INTO `gc_link` VALUES ('10', '淘宝大学', null, '10_tbdx.jpg', '1', null);

-- ----------------------------
-- Table structure for gc_material
-- ----------------------------
DROP TABLE IF EXISTS `gc_material`;
CREATE TABLE `gc_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL COMMENT '素材类型',
  `relevance_id` int(11) DEFAULT NULL COMMENT '关联的id',
  `survey` varchar(255) DEFAULT NULL COMMENT '概况',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `alt` varchar(255) DEFAULT NULL COMMENT '图片alt属性描述',
  `img_url` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `url` varchar(255) DEFAULT NULL COMMENT '链接',
  `sort` varchar(255) DEFAULT NULL COMMENT '排序',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `width` double DEFAULT NULL COMMENT '图片宽度',
  `height` double DEFAULT NULL COMMENT '图片高度',
  `status` int(1) DEFAULT '1' COMMENT '1可用0不可用',
  `details` longtext COMMENT '详情',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gc_material
-- ----------------------------

-- ----------------------------
-- Table structure for gc_menu
-- ----------------------------
DROP TABLE IF EXISTS `gc_menu`;
CREATE TABLE `gc_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '0不可用 1可用',
  `sort` int(255) DEFAULT NULL,
  `type` int(1) DEFAULT '0' COMMENT '0前台菜单1后台菜单',
  `img` varchar(255) DEFAULT NULL COMMENT '二级菜单下的图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gc_menu
-- ----------------------------
INSERT INTO `gc_menu` VALUES ('1', '0', '走进广川', null, '1', null, '0', '1.png');
INSERT INTO `gc_menu` VALUES ('2', '1', '公司介绍', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('3', '1', '公司文化', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('4', '0', '广川咨询', null, '1', null, '0', '2.png');
INSERT INTO `gc_menu` VALUES ('5', '1', '核心团队', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('6', '1', '发展历程', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('7', '1', '服务优势', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('8', '1', '团队风采', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('9', '1', '公司荣誉', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('10', '4', '公司新闻', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('11', '4', '行业新闻', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('12', '0', '产品与服务', null, '1', null, '0', '3.png');
INSERT INTO `gc_menu` VALUES ('13', '12', '电商代运营', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('14', '12', '全网营销', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('15', '12', '基础运营', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('16', '12', '跨境电商运营', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('17', '12', '定制研发产品', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('18', '12', '基本应用产品', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('19', '12', '电商培训', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('20', '12', '网店装修', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('21', '0', '解决方案', null, '1', null, '0', '5.png');
INSERT INTO `gc_menu` VALUES ('22', '21', '定制研发产品解决方案', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('23', '21', '阿里巴巴电商解决方案', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('24', '21', '全网网络营销解决方案', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('25', '21', '全网电商代运营解决方案', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('26', '21', '广川商学院电商人才解决方案', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('27', '0', '成功案例', null, '1', null, '0', '14.png');
INSERT INTO `gc_menu` VALUES ('28', '27', '电商案例', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('29', '27', '阿里案例', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('30', '27', '网站案例', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('31', '27', '移动案例', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('32', '27', '营销案例', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('33', '27', '研发案例', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('34', '0', '广川商学院', null, '1', null, '0', '15.png');
INSERT INTO `gc_menu` VALUES ('35', '34', '校企合作', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('36', '34', '岗位需求', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('37', '34', '商学院介绍', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('38', '0', '加入我们', null, '1', null, '0', null);
INSERT INTO `gc_menu` VALUES ('39', '0', '联系我们', null, '1', null, '0', null);

-- ----------------------------
-- Table structure for gc_role
-- ----------------------------
DROP TABLE IF EXISTS `gc_role`;
CREATE TABLE `gc_role` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `power` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gc_role
-- ----------------------------

-- ----------------------------
-- Table structure for gc_site
-- ----------------------------
DROP TABLE IF EXISTS `gc_site`;
CREATE TABLE `gc_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` int(255) DEFAULT '0' COMMENT '0集团旗下其他网站1其他网站',
  `sort` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '0不可用1可用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gc_site
-- ----------------------------
INSERT INTO `gc_site` VALUES ('1', '广川移动互联网', 'http://www.guangckj.com/', '0', null, '1');
INSERT INTO `gc_site` VALUES ('2', '盛世博创', 'http://www.shengshibc.com/', '0', null, '1');
INSERT INTO `gc_site` VALUES ('3', '指点精鹰', 'http://zhidianjingying.com/', '0', null, '1');
INSERT INTO `gc_site` VALUES ('4', '腾讯网', 'http://www.qq.com/', '1', null, '1');
INSERT INTO `gc_site` VALUES ('5', '奇虎360', 'http://www.360.com/', '1', null, '1');
INSERT INTO `gc_site` VALUES ('6', '小米科技', 'http://www.mi.com/', '1', null, '1');
INSERT INTO `gc_site` VALUES ('7', '优酷网', 'http://www.youku.com/', '1', null, '1');

-- ----------------------------
-- Table structure for gc_site_set
-- ----------------------------
DROP TABLE IF EXISTS `gc_site_set`;
CREATE TABLE `gc_site_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `address` varchar(255) DEFAULT NULL COMMENT '公司地址',
  `acronym` varchar(255) DEFAULT NULL COMMENT '公司简称',
  `icp` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL COMMENT '服务电话',
  `time` varchar(255) DEFAULT NULL COMMENT '服务时间',
  `description` varchar(255) DEFAULT NULL COMMENT '网站简介',
  `keywords` varchar(255) DEFAULT NULL COMMENT '网站关键词',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gc_site_set
-- ----------------------------
INSERT INTO `gc_site_set` VALUES ('1', '天津广川科技有限公司', '天津市 南开区 南泥湾路 世贸电商城 A座408', '广川科技', '津ICP备13000335号', '022-27158289', '周一 到 周五(8:45--18:00)', '天津广川科技-是一家拥有多渠道运营团队的第三方服务公司，提供全网营销一体化管理系统。主要提供：淘宝、天猫、京东店铺托管，店铺装修，产品拍摄，视觉设计，微信代运营等服务。服务热线：022-27158289', '天津代运营，天津网店代运营，天津淘宝托管，天猫店铺托管，京东店铺代运营，天津微信代运营，淘宝店铺装修，淘宝产品拍摄，天津企业网站建设');

-- ----------------------------
-- Table structure for gc_user
-- ----------------------------
DROP TABLE IF EXISTS `gc_user`;
CREATE TABLE `gc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `real_name` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `nick_name` varchar(255) DEFAULT NULL COMMENT '昵称',
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL COMMENT '角色',
  `add_time` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1可用0不可用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gc_user
-- ----------------------------
INSERT INTO `gc_user` VALUES ('1', null, '123456', null, 'e10adc3949ba59abbe56e057f20f883e', null, null, null, '1');
INSERT INTO `gc_user` VALUES ('2', null, '1234567', null, 'e10adc3949ba59abbe56e057f20f883e', null, null, null, '0');
INSERT INTO `gc_user` VALUES ('3', '', '12345678', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '0000-00-00 00:00:00', '1');
