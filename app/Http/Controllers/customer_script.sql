CREATE TABLE customer (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(250) NOT NULL,
email VARCHAR(220) NOT NULL,
mobile bigint,
billing_code VARCHAR(50),
application VARCHAR(50) NULL DEFAULT NULL,
customer_type VARCHAR(50),
manager_id  INT(11),
created_at_employee  VARCHAR(50) NULL DEFAULT NULL,
address VARCHAR(350) NULL DEFAULT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
updated_at TIMESTAMP NULL DEFAULT NULL 
)

CREATE TABLE barcode_imei_inventory (
imei varchar(50) PRIMARY KEY,
deviceType varchar(150) NULL DEFAULT NULL,
description varchar(255) NULL DEFAULT NULL,
purchased_from varchar(255) NULL DEFAULT NULL,
assigned_to varchar(255) NULL DEFAULT NULL,
assigned_at varchar(255) NULL DEFAULT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
updated_at TIMESTAMP NULL DEFAULT NULL 
)

 
/***************************amzone server *************/

CREATE TABLE geofence (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
account_id int(10) NOT NULL,
geofence_name VARCHAR(220) NOT NULL,
geo_tag VARCHAR(220) NOT NULL,
is_start INT(11) NULL DEFAULT NULL,
type INT(11) NOT NULL,
type_name VARCHAR(50) NULL DEFAULT NULL,
lat double NULL DEFAULT NULL,
lng double NULL DEFAULT NULL,
sw_lat double NULL DEFAULT NULL,
sw_lng double NULL DEFAULT NULL,
ne_lat double NULL DEFAULT NULL,
ne_lng double NULL DEFAULT NULL,
radiusMeters float NULL DEFAULT NULL,
description VARCHAR(450) NULL DEFAULT NULL,
created_at int(10) NULL DEFAULT NULL,
updated_at int(10) NULL DEFAULT NULL 
);

CREATE TABLE mapGeofenceOnVehicle (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
imei int(10) NOT NULL,
geofence_id int(10) NOT NULL,
created_at int(10) NULL DEFAULT NULL,
updated_at int(10) NULL DEFAULT NULL 
);


CREATE TABLE `tat_reports` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `imei` varchar(22) NOT NULL,
  `date` int(11) DEFAULT NULL,
  `supplierArea` varchar(450) DEFAULT NULL,
  `supplierIn` int(11) DEFAULT NULL,
  `supplierOut` int(11) DEFAULT NULL,
  `detentionAtSupplier` int(11) DEFAULT NULL,
  `customerArea` varchar(450) DEFAULT NULL,
  `customerIn` int(11) DEFAULT NULL,
  `customerOut` int(11) DEFAULT NULL,
  `cetentionAtCustomer` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL
);

CREATE TABLE `trip_reports` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `imei` varchar(20) NOT NULL,
  `siteName` varchar(450) DEFAULT NULL,
  `startDate` int(10) DEFAULT NULL,
  `startDistance` float DEFAULT NULL,
  `startLocation` varchar(450) DEFAULT NULL,
  `stopDate` int(10) DEFAULT NULL,
  `stopDistance` float DEFAULT NULL,
  `stopLocation` varchar(450) DEFAULT NULL,
  `travelTime` int(10) DEFAULT NULL,
  `stoppedFor` int(10) DEFAULT NULL,
  `travelDistance` float DEFAULT NULL,
  `geofenceNo` varchar(450) DEFAULT NULL,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL
);





CREATE TABLE mapGeofenceOnVehicle (
id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
imei varchar(20) NOT NULL,
geofence_id int(10) NOT NULL,
created_at int(10) NULL DEFAULT NULL,
updated_at int(10) NULL DEFAULT NULL 
);





/***************************amzone server *************/





ALTER TABLE `sim` ADD `payment_mode` VARCHAR(70) NULL DEFAULT NULL AFTER `status`

ALTER TABLE `sim` ADD `payment_status` VARCHAR(70) NULL DEFAULT NULL AFTER `payment_mode`

ALTER TABLE `sim` ADD `description` VARCHAR(450) NULL DEFAULT NULL AFTER `payment_status`


ALTER TABLE `device` ADD `payment_mode` VARCHAR(70) NULL DEFAULT NULL AFTER `status`

ALTER TABLE `device` ADD `payment_status` VARCHAR(70) NULL DEFAULT NULL AFTER `payment_mode`

ALTER TABLE `device` ADD `description` VARCHAR(450) NULL DEFAULT NULL AFTER `payment_status`

UPDATE  `device` SET `features_allowed` = '1' WHERE `features_allowed` is null;

UPDATE  `sim` SET `features_allowed` = '1' WHERE `features_allowed` is null;




ALTER TABLE `sim` ADD `customer_id` INT(11) NULL DEFAULT NULL AFTER `description`
ALTER TABLE `device` ADD `customer_id` INT(11) NULL DEFAULT NULL AFTER `description`

CREATE TABLE delivery_challan (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
challan_no VARCHAR(20) NOT NULL,
items VARCHAR(100) NOT NULL,
item_type VARCHAR(100) NOT NULL,
title VARCHAR(255) NOT NULL,
price double,
description VARCHAR(350) NULL DEFAULT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
updated_at TIMESTAMP NULL DEFAULT NULL 
)


CREATE TABLE challan_no (
id INT  AUTO_INCREMENT PRIMARY KEY,
status VARCHAR(20) NOT NULL,
created_by VARCHAR(220) NOT NULL,
customer_id INT(11) NOT NULL,
description VARCHAR(350) NULL DEFAULT NULL,
total double NULL DEFAULT NULL,
gst double NULL DEFAULT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
AUTO_INCREMENT = 1000;


CREATE TABLE motor_on_off (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
imei VARCHAR(20) NOT NULL,
status VARCHAR(50) NOT NULL,
account_id bigint NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)


ALTER TABLE `mapGeofenceOnVehicle` CHANGE `imei` VARCHAR(22) NOT NULL;