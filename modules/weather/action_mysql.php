<?php

/**
 * @Project Tuan Chau Dev
 * @Author Hau Pham (phamdinhhau@gmail.com)
 * @Copyright (C) 2014 Hau's Corp. All rights reserved
 * @Createdate 23/5/2014, 16:16 
 */


if( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_weather" . ";";

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_weather (
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  location_name varchar(100) NOT NULL,
  location_code int(11) NOT NULL,
  weight int(11) NOT NULL DEFAULT '0',  
  status tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Cao Bằng', 1252353, '1')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Phú Thọ', 1252556, '2')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Bắc Giang', 1229284, '3')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Hà Nội', 91888417, '4')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Hải Phòng', 1236690, '5')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Quảng Ninh', 1252437, '6')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Ninh Bình', 1252523, '7')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Nam Định', 1252512, '8')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Thừa Thiên Huế', 1252438, '9')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Đà Nẵng', 1252376, '10')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Nha Trang', 91883001, '11')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Hồ Chí Minh', 1252431, '12')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_weather (location_name, location_code, weight) VALUES ('Vũng Tàu', 1252672, '13')";