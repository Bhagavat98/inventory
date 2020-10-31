-- Create Table Users

CREATE TABLE users (
   id INT NOT NULL AUTO_INCREMENT,
   name varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   mobile bigint(20) DEFAULT NULL,
   society_name longtext COLLATE utf8mb4_unicode_ci,
   society_admin varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   admin_email varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   no_of_gate bigint(20) DEFAULT NULL,
   address longtext COLLATE utf8mb4_unicode_ci,
   email_verified_at timestamp NULL DEFAULT NULL,
   password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   is_super_admin tinyint(4) DEFAULT 0,
   is_admin tinyint(4) DEFAULT 0,
   manager_id tinyint(4) DEFAULT 0,
   profile_img longtext COLLATE utf8mb4_unicode_ci,
   features_allowed bigint(20) DEFAULT NULL,
   deleted_flag int(11) NOT NULL DEFAULT 0,
   status varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
   remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
);

-- Create Table Customer 

CREATE TABLE customers (
    cust_id INT NOT NULL AUTO_INCREMENT,
    customer_name VARCHAR(255) NULL,
    mobile bigint(20) DEFAULT NULL,
    email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    members varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    profile_img longtext COLLATE utf8mb4_unicode_ci,
    building varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  	flat_type varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  	flat_no varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  	owner varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  	password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  	manager_id tinyint(4) DEFAULT 0,
  	is_user tinyint(4) DEFAULT 0,
    features_allowed bigint(20) DEFAULT NULL,
   	deleted_flag int(11) NOT NULL DEFAULT 0,
    status varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (cust_id)
); 

-- create Table Security

CREATE TABLE security (
	secu_id INT NOT NULL AUTO_INCREMENT,
    security_name VARCHAR(50) NULL,
    mobile bigint(20) DEFAULT NULL,
    email varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 	  security_gate varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    security_office varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    building varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    profile_img longtext COLLATE utf8mb4_unicode_ci,
  	password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  	is_security tinyint(4) NOT NULL DEFAULT 0,
  	manager_id tinyint(4) DEFAULT 0,
    features_allowed bigint(20) DEFAULT NULL,
   	deleted_flag int(11) NOT NULL DEFAULT 0,
    status varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (secu_id)
); 

-- create Table fcm customer

CREATE TABLE fcm_customer (
   id INT NOT NULL AUTO_INCREMENT,
   account_id int(11) DEFAULT NULL,
   email varchar(50) DEFAULT NULL,
   mobile bigint(20) DEFAULT NULL,
   password_token varchar(255) DEFAULT NULL,
   unique_phone_id varchar(100) DEFAULT NULL,
   fcm_server_id varchar(100) DEFAULT NULL,
   device_details varchar(255) DEFAULT NULL,
   phone_type varchar(50) DEFAULT NULL,
   fcmKey longtext,
   pushnotificationios longtext,
   features_allowed bigint(20) DEFAULT NULL,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
); 

-- Create Table Visiters

CREATE TABLE visiters (
   vist_id INT NOT NULL AUTO_INCREMENT,
   visiter_type varchar(100) DEFAULT NULL,
   visiter_name varchar(225) DEFAULT NULL,
   company_name varchar(200) DEFAULT NULL,
   visiter_vehicle_type varchar(100) DEFAULT NULL,
   visiter_mobile bigint(20) DEFAULT NULL,
   date_time timestamp NULL DEFAULT NULL,
   gate varchar(50) DEFAULT NULL,
   cust_id int(11) NOT NULL,
   is_approvat varchar(20) NOT NULL DEFAULT 'approvat',
   features_allowed bigint(20) DEFAULT NULL,
   deleted_flag int(11) NOT NULL DEFAULT 0,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
 PRIMARY KEY (vist_id)
);

-- Create Table saveotp

CREATE TABLE saveotp (
   id INT NOT NULL AUTO_INCREMENT,
   mobile bigint(20) NOT NULL,
   otp int(225) NOT NULL,
   created_at timestamp NULL DEFAULT NULL,
 PRIMARY KEY (id)
);


-- Create Table logs

CREATE TABLE logs (
  id INT NOT NULL AUTO_INCREMENT,
  notification_message varchar(300) DEFAULT NULL,
  logs varchar(300) DEFAULT NULL,
  is_success varchar(50) DEFAULT NULL,
  failure int(11) NOT NULL,
  mobile bigint(20) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
);

-- Create Table NoticeBoard

 CREATE TABLE noticeboard (
  noti_id INT NOT NULL AUTO_INCREMENT,
  title varchar(100) DEFAULT NULL,
  notice longtext COLLATE utf8mb4_unicode_ci,
  expriy_date timestamp NULL DEFAULT NULL,
  manager_id tinyint(4) DEFAULT 0,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (noti_id)
);

 -- Create Table Complaints

CREATE TABLE complaints (
  comp_id INT NOT NULL AUTO_INCREMENT,
  title varchar(100) DEFAULT NULL,
  complaints longtext COLLATE utf8mb4_unicode_ci,
  cust_id int(11) NOT NULL,
  manager_id tinyint(4) DEFAULT 0,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (comp_id)
);

