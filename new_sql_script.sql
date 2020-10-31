CREATE TABLE `other_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `description` longtext NULL DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `billing_frequency` int(11) NULL DEFAULT NULL,
  `sold_stock` int(11) NULL DEFAULT NULL,
  `manager_id` int(11) NOT  NULL,
  `last_update_by` varchar(222) NOT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT NULL DEFAULT,
  PRIMARY KEY (`id`)
) 


CREATE TABLE `mapgeofenceonvehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imei` varchar(20) NOT NULL,
  `geofence_id` int(10) NOT NULL,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`) 
);




ALTER TABLE `delivery_challan` ADD `quantity` BIGINT NULL DEFAULT NULL AFTER `price`;

ALTER TABLE `delivery_challan` ADD `other_stock_id` VARCHAR(222) NULL DEFAULT NULL AFTER `items`;


+---------------+------------------+------+-----+---------+----------------+
| Field         | Type             | Null | Key | Default | Extra          |
+---------------+------------------+------+-----+---------+----------------+
| id            | int(11) unsigned | NO   | PRI | NULL    | auto_increment |
| account_id    | int(10)          | NO   |     | NULL    |                |
| geofence_name | varchar(220)     | NO   |     | NULL    |                |
| geo_tag       | varchar(220)     | NO   |     | NULL    |                |
| is_start      | int(11)          | YES  |     | NULL    |                |
| type          | int(11)          | NO   |     | NULL    |                |
| type_name     | varchar(50)      | YES  |     | NULL    |                |
| lat           | double           | YES  |     | NULL    |                |
| lng           | double           | YES  |     | NULL    |                |
| sw_lat        | double           | YES  |     | NULL    |                |
| sw_lng        | double           | YES  |     | NULL    |                |
| ne_lat        | double           | YES  |     | NULL    |                |
| ne_lng        | double           | YES  |     | NULL    |                |
| radiusMeters  | float            | YES  |     | NULL    |                |
| description   | varchar(450)     | YES  |     | NULL    |                |
| created_at    | int(10)          | YES  |     | NULL    |                |
| updated_at    | int(10)          | YES  |     | NULL    |                |
+---------------+------------------+------+-----+---------+----------------+



CREATE TABLE `geofence` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `account_id` INT(11) NOT NULL,
  `geofence_name` VARCHAR(220) DEFAULT NULL,
  `geo_tag` VARCHAR(220),
  `is_start` INT(11) DEFAULT NULL,
  `type` INT(11),
  `type_name` VARCHAR(50) DEFAULT NULL,
  `lat` DOUBLE DEFAULT NULL,
  `lng` DOUBLE DEFAULT NULL,
  `sw_lat` DOUBLE DEFAULT NULL,
  `sw_lng` DOUBLE DEFAULT NULL,
  `ne_lat` DOUBLE DEFAULT NULL,
  `ne_lng` DOUBLE DEFAULT NULL,
  `radiusMeters` FLOAT DEFAULT NULL,
  `description` VARCHAR(450) DEFAULT NULL,
  `created_at` INT(11) DEFAULT NULL,
  `updated_at` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


CREATE TABLE `mapGeofenceOnVehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imei` varchar(20) NOT NULL,
  `geofence_id` int(10) NOT NULL,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`) 
);






CREATE TABLE `other_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `description` longtext NULL DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `billing_frequency` int(11) NULL DEFAULT NULL,
  `sold_stock` int(11) NULL DEFAULT NULL,
  `manager_id` int(11) NOT  NULL,
  `last_update_by` varchar(222) NOT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT NULL DEFAULT,

  id int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
)