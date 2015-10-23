/*
SQLyog Ultimate v11.42 (64 bit)
MySQL - 5.6.25-1~dotdeb+7.1 : Database - jiajiayoupin_loc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `eav_attribute` */

DROP TABLE IF EXISTS `eav_attribute`;

CREATE TABLE `eav_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entityId` int(11) DEFAULT NULL,
  `typeId` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `defaultValue` varchar(255) DEFAULT NULL,
  `defaultOptionId` int(11) DEFAULT NULL,
  `required` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_Attribute_typeId` (`typeId`),
  KEY `FK_EntityId` (`entityId`),
  CONSTRAINT `FK_Attribute_defaultOptionId` FOREIGN KEY (`defaultOptionId`) REFERENCES `eav_attribute_option` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_Attribute_typeId` FOREIGN KEY (`typeId`) REFERENCES `eav_attribute_type` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_EntityId` FOREIGN KEY (`entityId`) REFERENCES `eav_entity` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `eav_attribute` */

insert  into `eav_attribute`(`id`,`entityId`,`typeId`,`name`,`label`,`defaultValue`,`defaultOptionId`,`required`) values (6,1,3,'test','Тест','0',0,0),(7,1,1,'test1','EAV поле','0',0,0),(8,1,2,'test2','EAV поле 2','0',0,0),(9,1,6,'test3','EAV поле 3','0',0,0),(10,1,5,'test4','EAV поле 4','0',0,0),(11,1,4,'test5','EAV поле 5','0',0,0);

/*Table structure for table `eav_attribute_option` */

DROP TABLE IF EXISTS `eav_attribute_option`;

CREATE TABLE `eav_attribute_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attributeId` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Option_attributeId` (`attributeId`),
  CONSTRAINT `FK_Option_attributeId` FOREIGN KEY (`attributeId`) REFERENCES `eav_attribute` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `eav_attribute_option` */

insert  into `eav_attribute_option`(`id`,`attributeId`,`value`) values (3,6,'Парам 1'),(4,6,'Парам 2'),(5,8,'45'),(6,8,'78'),(7,10,'5'),(8,10,'Парам парам'),(9,10,'Парам 2');

/*Table structure for table `eav_attribute_type` */

DROP TABLE IF EXISTS `eav_attribute_type`;

CREATE TABLE `eav_attribute_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `handlerClass` varchar(255) DEFAULT NULL,
  `storeType` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `eav_attribute_type` */

insert  into `eav_attribute_type`(`id`,`name`,`handlerClass`,`storeType`) values (1,'raw','\\mirocow\\eav\\widgets\\TextInput',0),(2,'option','\\mirocow\\eav\\widgets\\DropDownList',1),(3,'multiple','\\mirocow\\eav\\widgets\\CheckBoxList',2),(4,'array','\\mirocow\\eav\\widgets\\EncodedTextInput',3),(5,'radio','\\mirocow\\eav\\widgets\\RadioList',1),(6,'area','\\mirocow\\eav\\widgets\\Textarea',2);

/*Table structure for table `eav_attribute_value` */

DROP TABLE IF EXISTS `eav_attribute_value`;

CREATE TABLE `eav_attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entityId` int(11) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `optionId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Value_entityId` (`entityId`),
  KEY `FK_Value_attributeId` (`attributeId`),
  KEY `FK_Value_optionId` (`optionId`),
  CONSTRAINT `FK_Value_attributeId` FOREIGN KEY (`attributeId`) REFERENCES `eav_attribute` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_Value_optionId` FOREIGN KEY (`optionId`) REFERENCES `eav_attribute_option` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `eav_attribute_value` */

insert  into `eav_attribute_value`(`id`,`entityId`,`attributeId`,`value`,`optionId`) values (28,16,6,NULL,3),(30,16,7,'Текстовое поле Текстовое поле 2',NULL),(31,16,8,NULL,6),(32,16,9,'Текстовое поле Текстовое поле Текстовое поле Текстовое поле Текстовое поле Текстовое поле Текстовое поле Текстовое поле Текстовое поле Текстовое поле 2',NULL),(33,16,10,NULL,9),(40,16,6,NULL,4),(41,16,11,'\"{\\r\\n \\\"field1\\\": \\\"\\u041e\\u043f\\u0438\\u0441\\u0430\\u043d\\u0438\\u0435 1\\\",\\r\\n \\\"field2\\\": \\\"\\u041e\\u043f\\u0438\\u0441\\u0430\\u043d\\u0438\\u0435 2\\\",\\r\\n}\"',NULL);

/*Table structure for table `eav_entity` */

DROP TABLE IF EXISTS `eav_entity`;

CREATE TABLE `eav_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entityName` varchar(50) DEFAULT NULL COMMENT 'Наименование',
  `entityModel` varchar(100) DEFAULT NULL COMMENT 'ID Модели',
  `categoryId` int(11) DEFAULT NULL COMMENT 'ID Category',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `eav_entity` */

insert  into `eav_entity`(`id`,`entityName`,`entityModel`,`categoryId`) values (1,'Продукт','common\\models\\Product',15);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
