PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE `eav` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	`categoryId` integer
);
INSERT INTO "eav" VALUES(1, 1);
INSERT INTO "eav" VALUES(2, 2);
INSERT INTO "eav" VALUES(3, 1);
INSERT INTO "eav" VALUES(4, 3);
CREATE TABLE `eav_category` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	`name` varchar(255)
);
INSERT INTO "eav_category" VALUES(1, 'Category 1');
INSERT INTO "eav_category" VALUES(2, 'Category 2');
INSERT INTO "eav_category" VALUES(3, 'Category 3');
CREATE TABLE `eav_attribute` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	'entityModel' varchar(255),
	`categoryId` integer,
	`typeId` integer,
	`name` varchar(255),
	`label` varchar(255),
	`defaultValue` varchar(255),
	`defaultOptionId` integer,
	`required` boolean DEFAULT 1
);
CREATE TABLE `eav_attribute_type` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	`name` varchar(255),
	`handlerClass` varchar(255),
	`storeType` smallint NOT NULL DEFAULT 0
);
INSERT INTO "eav_attribute_type" VALUES(1,'raw','\mazurva\eav\inputs\TextInput',0);
INSERT INTO "eav_attribute_type" VALUES(2,'array','\mazurva\eav\inputs\EncodedTextInput',3);
INSERT INTO "eav_attribute_type" VALUES(3,'option','\mazurva\eav\inputs\DropDownList',1);
INSERT INTO "eav_attribute_type" VALUES(4,'multiple','\mazurva\eav\inputs\EncodedTextInput',2);
CREATE TABLE `eav_attribute_value` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	`entityId` integer NOT NULL,
	`attributeId` integer NOT NULL,
	`value` varchar(255),
	`optionId` integer
);
CREATE TABLE `eav_attribute_option` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	`attributeId` integer,
	`value` varchar(255)
);
COMMIT;
