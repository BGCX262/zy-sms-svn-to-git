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

/*Table structure for table `zy_admin` */

DROP TABLE IF EXISTS `zy_admin`;

CREATE TABLE `zy_admin` (
  `admin_id` int(11) NOT NULL COMMENT '管理员编号',
  `admin_login_name` varchar(50) DEFAULT NULL COMMENT '管理员登录帐号',
  `admin_login_password` varchar(50) DEFAULT NULL COMMENT '管理员登录密码',
  `admin_real_name` varchar(50) DEFAULT NULL COMMENT '管理员真实姓名',
  `admin_remark` varchar(255) DEFAULT NULL COMMENT '管理员备注',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `zy_company` */

insert  into `zy_company`(`company_id`,`company_name`,`company_phone`,`company_address`,`user_id`,`company_remark`) values (1,'novatel',NULL,NULL,21,NULL);

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
  `user_id` int(11) DEFAULT NULL COMMENT '创建人',
  `contact_remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_contact` */

/*Table structure for table `zy_contact_list` */

DROP TABLE IF EXISTS `zy_contact_list`;

CREATE TABLE `zy_contact_list` (
  `contact_list_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '联系人列表编号',
  `contact_list_name` varchar(50) DEFAULT NULL COMMENT '列表名称',
  `contact_list_count` int(11) DEFAULT NULL COMMENT '列表数量',
  `department_id` int(11) DEFAULT NULL COMMENT '部门编号',
  `contact_id` text COMMENT '包含的联系人,以[id]|分割',
  `contact_list_create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `contact_list_update_time` datetime DEFAULT NULL COMMENT '修改时间',
  `contact_list_remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`contact_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_contact_list` */

/*Table structure for table `zy_credit` */

DROP TABLE IF EXISTS `zy_credit`;

CREATE TABLE `zy_credit` (
  `credit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '钱包编号',
  `credit_name` varchar(100) DEFAULT NULL COMMENT '钱包名称',
  `credit_volume` varchar(255) DEFAULT NULL COMMENT '钱包额度',
  `credit_price` decimal(11,2) DEFAULT NULL COMMENT '单价',
  `credit_currency` varchar(50) DEFAULT 'AUD' COMMENT '币种',
  `credit_create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `credit_update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `credit_sort` int(11) DEFAULT NULL COMMENT '排序',
  `credit_remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`credit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `zy_credit` */

/*Table structure for table `zy_department` */

DROP TABLE IF EXISTS `zy_department`;

CREATE TABLE `zy_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '部门编号',
  `company_id` int(11) DEFAULT NULL COMMENT '公司编号',
  `department_name` varchar(100) DEFAULT NULL COMMENT '部门名称',
  `department_parent_id` int(11) DEFAULT NULL COMMENT '上级部门编号(待用)',
  `remark` varchar(200) DEFAULT NULL COMMENT '部门备注',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `zy_department` */

insert  into `zy_department`(`department_id`,`company_id`,`department_name`,`department_parent_id`,`remark`) values (1,1,'manager',0,'the company admin group');

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
  `sender_api_id` varchar(50) DEFAULT NULL COMMENT '调用的api id',
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `zy_user` */

insert  into `zy_user`(`user_id`,`company_id`,`department_id`,`user_login_name`,`user_login_password`,`roleid`,`user_real_name`,`user_email`,`user_phone`,`user_mobile`,`user_remark`) values (21,1,1,'novatel','welcome','0','allen','zy.shulei@gmail.com','0555-3158843','8613855585327','this is a remark');

/*Table structure for table `zy_userapi` */

DROP TABLE IF EXISTS `zy_userapi`;

CREATE TABLE `zy_userapi` (
  `useapi_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户调用API方法编号',
  `company_id` int(11) DEFAULT NULL COMMENT '公司编号',
  `api_username` varchar(50) DEFAULT NULL COMMENT '调用API的用户名',
  `api_password` varchar(50) DEFAULT NULL COMMENT '调用API的密码',
  `api_id` varchar(50) DEFAULT NULL COMMENT '调用api的api id',
  `userapi_remark` varchar(255) DEFAULT NULL COMMENT '调用API 备注',
  PRIMARY KEY (`useapi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `zy_userapi` */

insert  into `zy_userapi`(`useapi_id`,`company_id`,`api_username`,`api_password`,`api_id`,`userapi_remark`) values (1,1,'test','test','123456',NULL);

/*Table structure for table `zy_send_message_with_userapi` */

DROP TABLE IF EXISTS `zy_send_message_with_userapi`;

/*!50001 DROP VIEW IF EXISTS `zy_send_message_with_userapi` */;
/*!50001 DROP TABLE IF EXISTS `zy_send_message_with_userapi` */;

/*!50001 CREATE TABLE  `zy_send_message_with_userapi`(
 `user_id` int(11) ,
 `user_login_name` varchar(50) ,
 `user_login_password` varchar(50) ,
 `useapi_id` int(11) ,
 `company_id` int(11) ,
 `api_username` varchar(50) ,
 `api_password` varchar(50) ,
 `api_id` varchar(50) ,
 `userapi_remark` varchar(255) 
)*/;

/*View structure for view zy_send_message_with_userapi */

/*!50001 DROP TABLE IF EXISTS `zy_send_message_with_userapi` */;
/*!50001 DROP VIEW IF EXISTS `zy_send_message_with_userapi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `zy_send_message_with_userapi` AS (select `a`.`user_id` AS `user_id`,`a`.`user_login_name` AS `user_login_name`,`a`.`user_login_password` AS `user_login_password`,`b`.`useapi_id` AS `useapi_id`,`b`.`company_id` AS `company_id`,`b`.`api_username` AS `api_username`,`b`.`api_password` AS `api_password`,`b`.`api_id` AS `api_id`,`b`.`userapi_remark` AS `userapi_remark` from (`zy_user` `a` join `zy_userapi` `b`) where (`a`.`company_id` = `b`.`company_id`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
