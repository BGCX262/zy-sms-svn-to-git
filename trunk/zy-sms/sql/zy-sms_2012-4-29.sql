/*
SQLyog Trial v9.20 
MySQL - 5.5.15 : Database - zy-sms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`zy-sms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `zy-sms`;

/*Table structure for table `cc_info` */

DROP TABLE IF EXISTS `cc_info`;

CREATE TABLE `cc_info` (
  `company_id` int(11) DEFAULT NULL COMMENT '公司ID',
  `cc_type` int(11) DEFAULT NULL COMMENT '信用卡类型 1VISA 2mastercard',
  `cc_number` varchar(50) DEFAULT NULL COMMENT '信用卡帐号',
  `cc_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `cc_expirydate` varchar(50) DEFAULT NULL COMMENT '有效期',
  `cc_bsbnumber` varchar(50) DEFAULT NULL COMMENT '银行帐号',
  `cc_accountnumber` varchar(50) DEFAULT NULL COMMENT '银行卡号',
  `cc_accountname` varchar(100) DEFAULT NULL COMMENT '银行卡名称',
  `cc_defaultpay` char(1) DEFAULT '1' COMMENT '默认付款方式 1.bank tracnsfer 2:credit card 3:derect debit '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cc_info` */

/*Table structure for table `zy_admin` */

DROP TABLE IF EXISTS `zy_admin`;

CREATE TABLE `zy_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `admin_login_name` varchar(50) DEFAULT NULL COMMENT '管理员登录帐号',
  `admin_login_password` varchar(50) DEFAULT NULL COMMENT '管理员登录密码',
  `admin_real_name` varchar(50) DEFAULT NULL COMMENT '管理员真实姓名',
  `admin_remark` varchar(255) DEFAULT NULL COMMENT '管理员备注',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `zy_admin` */

insert  into `zy_admin`(`admin_id`,`admin_login_name`,`admin_login_password`,`admin_real_name`,`admin_remark`) values (1,'allen','2816843','束磊','测试账户');

/*Table structure for table `zy_charge` */

DROP TABLE IF EXISTS `zy_charge`;

CREATE TABLE `zy_charge` (
  `charge_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '付款记录',
  `credit_id` int(11) DEFAULT NULL COMMENT '钱包ID',
  `charge_quantity` int(11) DEFAULT NULL COMMENT '数量',
  `charge_price` int(11) DEFAULT NULL COMMENT '总价=单价*数量',
  `charge_time` datetime DEFAULT NULL COMMENT '付款时间',
  `payment_id` int(11) DEFAULT NULL COMMENT '付款方式',
  `user_id` int(11) DEFAULT NULL COMMENT '购买人',
  `charge_remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`charge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_charge` */

/*Table structure for table `zy_company` */

DROP TABLE IF EXISTS `zy_company`;

CREATE TABLE `zy_company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID编号',
  `company_name` varchar(100) DEFAULT NULL COMMENT '公司名称',
  `company_phone` varchar(100) DEFAULT NULL COMMENT '公司电话',
  `company_address` varchar(200) DEFAULT NULL COMMENT '公司地址',
  `user_id` int(11) DEFAULT NULL COMMENT '公司管理员ID',
  `company_remark` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `zy_company` */

insert  into `zy_company`(`company_id`,`company_name`,`company_phone`,`company_address`,`user_id`,`company_remark`) values (4,'Test Company','Test Company Phone','Test Company Address',25,'Test Company Remark'),(5,'Test Company','Test Company Phone','Test Company Address',NULL,'Test Company Remark'),(7,'啊啊啊啊','啊啊啊啊啊啊','啊啊啊啊啊啊',28,'啊啊啊啊啊啊'),(11,'Test Company','Test Company Phone','Test Company Address',32,'Test Company Phone'),(12,'WEBNOVA','','aaaa',33,'');

/*Table structure for table `zy_contact` */

DROP TABLE IF EXISTS `zy_contact`;

CREATE TABLE `zy_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '联系人编号',
  `contact_first_name` varchar(50) DEFAULT NULL COMMENT '名字',
  `contact_surname` varchar(50) DEFAULT NULL COMMENT '姓',
  `contact_email` varchar(50) DEFAULT NULL COMMENT '邮件',
  `contact_mobile` varchar(50) DEFAULT NULL COMMENT '手机',
  `contact_phone` varchar(50) DEFAULT '0' COMMENT '电话',
  `contact_title` varchar(50) DEFAULT NULL COMMENT 'Mr. Miss. Mrs.',
  `contact_create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `contact_update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `contact_birth_date` date DEFAULT NULL COMMENT '生日',
  `contact_country` int(11) DEFAULT '0' COMMENT '城市',
  `contact_state` int(11) DEFAULT '0' COMMENT '州/省',
  `contact_city` int(11) DEFAULT '0' COMMENT '城市',
  `contact_address` varchar(255) DEFAULT NULL COMMENT '地址',
  `company_id` int(11) DEFAULT NULL COMMENT '公司编号',
  `department_id` int(11) DEFAULT NULL COMMENT '部门编号',
  `user_id` int(11) DEFAULT NULL COMMENT '创建人',
  `contact_remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

/*Data for the table `zy_contact` */

insert  into `zy_contact`(`contact_id`,`contact_first_name`,`contact_surname`,`contact_email`,`contact_mobile`,`contact_phone`,`contact_title`,`contact_create_time`,`contact_update_time`,`contact_birth_date`,`contact_country`,`contact_state`,`contact_city`,`contact_address`,`company_id`,`department_id`,`user_id`,`contact_remark`) values (1,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(2,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(3,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(4,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(5,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(6,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(7,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(8,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(9,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(10,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(11,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(12,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(13,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(14,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(15,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(16,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(17,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(18,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(19,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(20,'feifei','zheng','arthurkingtoo@foxmail.com','13685855793','0555-2431111','Mr.','2012-04-22 13:36:50','2012-04-24 13:36:54','1988-08-28',0,0,0,'马鞍山',11,0,0,'remark'),(23,'s是','s谁','ss','ss','0','s说','2012-04-22 14:38:09','2012-04-22 15:10:04','2012-04-22',0,0,0,'sss',11,22,32,'ssasdasdssss'),(24,'sw','sw','sw','sw','0','sw','2012-04-22 15:19:06','2012-04-23 00:07:04','2012-04-22',0,0,0,'sw',11,22,32,'sssssw'),(25,'s','s','s','s','0','s','2012-04-23 21:11:32','2012-04-23 21:11:04','2012-04-23',0,0,0,'s',11,22,32,'s'),(26,'s','s','s','s','0','s','2012-04-23 21:21:40','2012-04-23 21:21:04','2012-04-23',0,0,0,'s',11,22,32,'s'),(27,'ss','ss','sss','ss','0','sss','2012-04-23 21:24:31','2012-04-23 21:25:04','2012-04-23',0,0,0,'ss',11,22,32,'ss'),(28,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:43:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(29,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:44:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(30,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:44:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(31,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:44:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(32,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:45:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(33,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:46:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(34,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:46:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(35,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:46:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(36,'www','www','www','www','0','www','2012-04-23 21:42:42','2012-04-23 21:46:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(37,'www','www','www','www','0','www','2012-04-23 21:46:59','2012-04-23 21:47:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(38,'www','www','www','www','0','www','2012-04-23 21:47:56','2012-04-23 21:48:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(39,'www','www','www','www','0','www','2012-04-23 21:47:56','2012-04-23 21:48:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(40,'www','www','www','www','0','www','2012-04-23 21:47:56','2012-04-23 21:48:04','2012-04-23',0,0,0,'www',11,22,32,'www'),(41,'ss','ss','ss','ss','0','ss','2012-04-23 21:50:00','2012-04-23 21:50:04','2012-04-23',0,0,0,'ss',11,22,32,'ss'),(42,'ss','ss','ss','ss','0','ss','2012-04-23 21:50:00','2012-04-23 21:50:04','2012-04-23',0,0,0,'ss',11,22,32,'ss'),(43,'ss','ss','ss','ss','0','ss','2012-04-23 21:50:00','2012-04-23 21:51:04','2012-04-23',0,0,0,'ss',11,22,32,'ss'),(44,'ss','ss','ss','ss','0','ss','2012-04-23 21:50:00','2012-04-23 21:52:04','2012-04-23',0,0,0,'ss',11,22,32,'ss'),(45,'sssssssssssss','sssssssssssss','sssssssssssss','sssssssssssss','0','sssssssssssss','2012-04-23 21:52:51','2012-04-23 21:53:04','2012-04-23',0,0,0,'sssssssssssss',11,22,32,'sssssssssssss'),(46,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 21:54:32','2012-04-23 21:55:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(47,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 21:54:32','2012-04-23 21:57:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(48,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 21:54:32','2012-04-23 21:58:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(49,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 21:54:32','2012-04-23 22:02:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(50,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 21:54:32','2012-04-23 22:03:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(51,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 21:54:32','2012-04-23 22:05:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(52,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 22:06:34','2012-04-23 22:06:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(53,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 22:08:55','2012-04-23 22:09:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(54,'ssss','ssss','ssss','ssss','0','ssss','2012-04-23 22:11:22','2012-04-23 22:11:04','2012-04-23',0,0,0,'ssss',11,22,32,'ssss'),(55,'wwwwww','wwwwww','wwwwww','wwwwww','0','wwwwww','2012-04-23 22:13:35','2012-04-23 22:13:04','2012-04-23',0,0,0,'wwwwww',11,22,32,'wwwwww'),(56,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 22:15:49','2012-04-23 22:17:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(57,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 22:15:49','2012-04-23 22:18:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(58,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 22:15:49','2012-04-23 22:18:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(59,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 22:15:49','2012-04-23 22:18:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(60,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 22:15:49','2012-04-23 22:18:04','2012-04-23',0,0,0,'arthur',11,22,32,'arthur'),(61,'1','1','1','1','0','1','2012-04-23 22:19:00','2012-04-23 22:19:04','2012-04-23',0,0,0,'1',11,22,32,'1'),(62,'ssss','ssss','ssss','ssss','0','ssss','2012-04-23 23:01:39','2012-04-23 23:01:04','2012-04-23',0,0,0,'ssss',0,0,0,'ssss'),(63,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:02:34','2012-04-23 23:02:04','2012-04-23',0,0,0,'arthur',0,0,0,'2012-04-23 23:02:34'),(64,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:04:19','2012-04-23 23:04:04','2012-04-23',0,0,0,'arthur',0,0,0,'arthur'),(65,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:05:53','2012-04-23 23:06:04','2012-04-23',0,0,0,'arthur',0,0,0,'arthur'),(66,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:06:49','2012-04-23 23:07:04','2012-04-23',0,0,0,'arthur',0,0,0,'arthur'),(67,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:07:33','2012-04-23 23:08:04','2012-04-23',0,0,0,'arthur',0,0,0,'arthur'),(68,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:09:27','2012-04-23 23:09:04','2012-04-23',0,0,0,'arthur',0,0,0,'arthur'),(69,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:09:45','2012-04-23 23:10:04','2012-04-23',0,0,0,'arthur',0,0,0,'arthur'),(70,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:11:32','2012-04-23 23:11:04','2012-04-23',0,0,0,'arthur',0,0,0,'arthur'),(71,'arthur','arthur','arthur','arthur','0','arthur','2012-04-23 23:16:11','2012-04-23 23:16:04','2012-04-23',0,0,0,'arthur',0,0,0,'arthur');

/*Table structure for table `zy_contact_list` */

DROP TABLE IF EXISTS `zy_contact_list`;

CREATE TABLE `zy_contact_list` (
  `contact_list_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '联系人列表编号',
  `contact_list_name` varchar(50) DEFAULT NULL COMMENT '列表名称',
  `contact_list_count` int(11) DEFAULT NULL COMMENT '列表数量',
  `company_id` int(11) DEFAULT NULL COMMENT '公司编号',
  `department_id` int(11) DEFAULT NULL COMMENT '部门编号',
  `user_id` int(11) DEFAULT NULL COMMENT '用户编号',
  `angent_id` int(11) DEFAULT '0' COMMENT '代理商编号.为0时.不是代理商的联系人列表',
  `contact_id` longtext COMMENT '包含的联系人,以[id]|分割',
  `contact_list_create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `contact_list_update_time` datetime DEFAULT NULL COMMENT '修改时间',
  `contact_list_remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`contact_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `zy_contact_list` */

insert  into `zy_contact_list`(`contact_list_id`,`contact_list_name`,`contact_list_count`,`company_id`,`department_id`,`user_id`,`angent_id`,`contact_id`,`contact_list_create_time`,`contact_list_update_time`,`contact_list_remark`) values (1,'未分组',0,0,0,0,0,NULL,'2012-04-22 01:35:45','2012-04-22 01:35:54','UserListssss111'),(3,'List2',8,0,0,0,0,'[0]|[70]|[71]','2012-04-22 03:16:17','2012-04-22 03:16:04','UserListssss111'),(4,'UserLists',0,0,0,0,0,'0','2012-04-22 03:19:32','2012-04-22 03:21:04','UserLists'),(5,'UserList',7,11,22,32,0,'[0]|[53]|[61]','2012-04-22 03:34:02','2012-04-22 03:35:04','UserList'),(7,'List',2,11,22,32,0,'[0]|[55]|[1]|[1]|[1]|[56]|[57]|[58]|[59]|[60]','2012-04-22 21:51:44','2012-04-22 21:51:04','List');

/*Table structure for table `zy_credit` */

DROP TABLE IF EXISTS `zy_credit`;

CREATE TABLE `zy_credit` (
  `credit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '钱包编号',
  `credit_name` varchar(100) DEFAULT NULL COMMENT '钱包名称',
  `credit_volume` varchar(255) DEFAULT NULL COMMENT '钱包额度',
  `credit_price` decimal(11,2) DEFAULT NULL COMMENT '单价',
  `credit_currency` varchar(50) DEFAULT 'AUD' COMMENT '币种',
  `credit_status` int(1) DEFAULT '0' COMMENT '钱包状态:1.停用;2.启用;3.删除',
  `credit_sort` int(11) DEFAULT '0' COMMENT '排序',
  `credit_remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`credit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `zy_credit` */

insert  into `zy_credit`(`credit_id`,`credit_name`,`credit_volume`,`credit_price`,`credit_currency`,`credit_status`,`credit_sort`,`credit_remark`) values (1,'a','1-4999','0.80','AUD',1,0,'r'),(2,'b','5000-9999','0.60','AUD',1,0,'s'),(3,'1','1','1.00','1',3,1,'1'),(27,'555','55','555.00','555',3,5555,'5555'),(28,'2','2','2.00','2',3,2,'2'),(29,'2','2','2.00','2',3,2,'2');

/*Table structure for table `zy_department` */

DROP TABLE IF EXISTS `zy_department`;

CREATE TABLE `zy_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '部门编号',
  `company_id` int(11) DEFAULT NULL COMMENT '公司编号',
  `department_name` varchar(100) DEFAULT NULL COMMENT '部门名称',
  `department_parent_id` int(11) DEFAULT NULL COMMENT '上级部门编号(待用)',
  `remark` varchar(200) DEFAULT NULL COMMENT '部门备注',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `zy_department` */

insert  into `zy_department`(`department_id`,`company_id`,`department_name`,`department_parent_id`,`remark`) values (1,1,'manager',0,'the company admin group'),(21,11,'manager',0,NULL),(22,11,'销售部',0,'Add Department'),(23,12,'manager',0,NULL);

/*Table structure for table `zy_payment_gateway` */

DROP TABLE IF EXISTS `zy_payment_gateway`;

CREATE TABLE `zy_payment_gateway` (
  `payment_id` int(11) DEFAULT NULL COMMENT '付款方式编号',
  `payment_gateway_key` varchar(255) DEFAULT NULL COMMENT '付款方式关键字',
  `payment_gateway_value` varchar(255) DEFAULT NULL COMMENT '付款方式值',
  `payment_gateway_remark` varchar(255) DEFAULT NULL COMMENT '备注.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_payment_gateway` */

/*Table structure for table `zy_peyment` */

DROP TABLE IF EXISTS `zy_peyment`;

CREATE TABLE `zy_peyment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '付款方式ID',
  `payment_name` varchar(100) DEFAULT NULL COMMENT '付款方式名称',
  `payment_status` int(1) DEFAULT NULL COMMENT '状态,0:停用,1:启用,2:删除',
  `payment_remark` varchar(255) DEFAULT NULL COMMENT '付款方式备注',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_peyment` */

/*Table structure for table `zy_role` */

DROP TABLE IF EXISTS `zy_role`;

CREATE TABLE `zy_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `department_id` int(11) DEFAULT NULL COMMENT '部门表',
  `contct_list_id` int(11) DEFAULT NULL COMMENT '联系人列表',
  `role_remark` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_role` */

/*Table structure for table `zy_sender` */

DROP TABLE IF EXISTS `zy_sender`;

CREATE TABLE `zy_sender` (
  `sender_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '发送人编号',
  `sender_name` varchar(255) DEFAULT NULL COMMENT '发送人名称',
  `company_id` int(11) DEFAULT NULL COMMENT '所属公司',
  `sender_status` int(1) DEFAULT NULL COMMENT '发送人状态0:停用,1:启动,2:删除;3:申请',
  `userapi_id` varchar(50) DEFAULT NULL COMMENT '调用的api id',
  `sender_remark` varchar(255) DEFAULT NULL COMMENT '发件人备注',
  PRIMARY KEY (`sender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_sender` */

/*Table structure for table `zy_sms_record` */

DROP TABLE IF EXISTS `zy_sms_record`;

CREATE TABLE `zy_sms_record` (
  `sms_record_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '短信发送ID',
  `api_id` varchar(50) DEFAULT NULL COMMENT '调用的接口ID',
  `sms_record_time` datetime DEFAULT NULL COMMENT '发送时间',
  `sms_success_list` text COMMENT '发送成功,[id]|分割',
  `sms_fail_list` text COMMENT '发送失败,[id]|分割',
  `sms_success_count` int(11) DEFAULT NULL COMMENT '发送成功数',
  `sms_fail_count` int(11) DEFAULT NULL COMMENT '发送失败数',
  `sms_cost` decimal(11,2) DEFAULT NULL COMMENT '产生费用',
  `user_id` int(11) DEFAULT NULL COMMENT '发送人',
  `sms_record_remark` varchar(255) DEFAULT NULL COMMENT '发送备注',
  PRIMARY KEY (`sms_record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_sms_record` */

/*Table structure for table `zy_user` */

DROP TABLE IF EXISTS `zy_user`;

CREATE TABLE `zy_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `company_id` int(11) DEFAULT NULL COMMENT '公司编号',
  `department_id` int(11) DEFAULT NULL COMMENT '部门编号',
  `user_login_name` varchar(50) DEFAULT NULL COMMENT '登录帐号',
  `user_login_password` varchar(50) DEFAULT NULL COMMENT '登录密码',
  `roleid` varchar(300) DEFAULT NULL COMMENT 'role表里的ID连接，连接符号|暂时不使用',
  `user_real_name` varchar(50) DEFAULT NULL COMMENT '用户真实姓名',
  `user_email` varchar(50) DEFAULT NULL COMMENT '用户邮件',
  `user_phone` varchar(50) DEFAULT NULL COMMENT '用户电话',
  `user_mobile` varchar(50) DEFAULT NULL COMMENT '用户手机号',
  `user_remark` varchar(200) DEFAULT NULL COMMENT '用户备注',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Data for the table `zy_user` */

insert  into `zy_user`(`user_id`,`company_id`,`department_id`,`user_login_name`,`user_login_password`,`roleid`,`user_real_name`,`user_email`,`user_phone`,`user_mobile`,`user_remark`) values (23,11,22,'arthur','arthur','0','arthur','arthurkingtoo@foxmail.com','0555-2432111','15215557835','arthur'),(32,11,22,'user','users','0','0','0','0','0','0'),(33,12,0,'allen','123456','0','','','','','');

/*Table structure for table `zy_userapi` */

DROP TABLE IF EXISTS `zy_userapi`;

CREATE TABLE `zy_userapi` (
  `userapi_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户调用API方法编号',
  `company_id` int(11) DEFAULT NULL COMMENT '公司编号',
  `api_username` varchar(50) DEFAULT NULL COMMENT '调用API的用户名',
  `api_password` varchar(50) DEFAULT NULL COMMENT '调用API的密码',
  `api_id` varchar(50) DEFAULT NULL COMMENT '调用api的api id',
  `api_status` int(1) DEFAULT '0' COMMENT 'API状态,1:停用,2:启用,3:删除',
  `sender_name` varchar(50) DEFAULT NULL COMMENT '发件人名称',
  `sender_status` int(1) DEFAULT NULL COMMENT '发件人状态 1:停用;2:启用;3:删除;4:待审核;',
  `userapi_remark` varchar(255) DEFAULT NULL COMMENT '调用API 备注',
  PRIMARY KEY (`userapi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `zy_userapi` */

insert  into `zy_userapi`(`userapi_id`,`company_id`,`api_username`,`api_password`,`api_id`,`api_status`,`sender_name`,`sender_status`,`userapi_remark`) values (1,1,'2','2','2',3,'arthur',1,'2'),(2,1,'test2','test2','654321',1,'allen',2,'remark2'),(3,2,'test3','test3','43234234',1,'arthur',3,'remark3'),(4,1,'9','9','9',1,'arthur',4,'9'),(5,1,'a','a','a',1,'arthur',1,'a'),(6,1,'a','a','a',1,'arthur',2,'a'),(7,11,'1111','aaaa','123123ddd',3,'asdasd',2,'ssssssss');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
