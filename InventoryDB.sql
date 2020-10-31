CREATE TABLE `inventory`.`device` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
`type` VARCHAR(100) NOT NULL ,
`title` VARCHAR(255) NULL ,
`asset_type` INT NOT NULL , 
`description` LONGTEXT NULL , 
`purchase_date` TIMESTAMP NULL DEFAULT NULL ,
`assign_date` TIMESTAMP NULL DEFAULT NULL , 
`assigned_to` INT NOT NULL ,
`billing_frequency` VARCHAR(100) NOT NULL DEFAULT 'NA' , 
`unique_id` VARCHAR(50) NOT NULL , 
`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`update_at` TIMESTAMP NOT NULL DEFAULT NULL ,
 PRIMARY KEY (`id`)
 ) ENGINE = InnoDB;