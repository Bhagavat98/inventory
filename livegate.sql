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
   longitude VARCHAR(50) NULL DEFAULT NULL,
   latitude VARCHAR(50) NULL DEFAULT NULL,
   email_verified_at timestamp NULL DEFAULT NULL,
   password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   is_super_admin tinyint(4) DEFAULT 0,
   is_admin tinyint(4) DEFAULT 0,
   manager_id INT NOT NULL,
   profile_img longtext COLLATE utf8mb4_unicode_ci,
   features_allowed bigint(20) DEFAULT NULL,
   deleted_flag int(11) NOT NULL DEFAULT 0,
   status varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
   remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   time_zone varchar(150) NULL,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create Table Customers

CREATE TABLE customers (
    cust_id INT NOT NULL AUTO_INCREMENT,
    customer_name VARCHAR(255) NULL,
    mobile bigint(20) DEFAULT NULL,
    email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    members varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    profile_img longtext COLLATE utf8mb4_unicode_ci,
    gender enum('m','f','o') DEFAULT NULL,
    birthdate date DEFAULT NULL,
    building varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  	flat_type varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  	flat_no varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  	owner INT NOT NULL DEFAULT '0',
    family_id INT NOT NULL DEFAULT,
    user_type INT NOT NULL DEFAULT '0',
  	password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  	manager_id INT NOT NULL,
  	is_user tinyint(4) DEFAULT 0,
    features_allowed bigint(20) DEFAULT NULL,
    email_allowed bigint(20) DEFAULT NULL,
   	deleted_flag int(11) NOT NULL DEFAULT 0,
    status varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    time_zone varchar(150) NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (cust_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

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
    manager_id INT NOT NULL,
    features_allowed bigint(20) DEFAULT NULL,
   	deleted_flag int(11) NOT NULL DEFAULT 0,
    status varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
    time_zone varchar(150) NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (secu_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

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
   time_zone varchar(50) NULL,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 


-- create Table fcm_admin

CREATE TABLE fcm_admin (
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
   time_zone varchar(50) NULL,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (account_id) REFERENCES users(id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

-- Create Table Visitors

CREATE TABLE visitors (
   vist_id INT NOT NULL AUTO_INCREMENT,
   type_id varchar(100) DEFAULT NULL,
   visitor_name varchar(225) DEFAULT NULL,
   comp_id varchar(200) DEFAULT NULL,
   vehicle_no varchar(150) DEFAULT NULL,
   visitor_vehicle_type varchar(100) DEFAULT NULL,
   visitor_mobile bigint(20) DEFAULT NULL,
   date_time varchar(100) NULL DEFAULT NULL,
   expriy_date_time timestamp NULL DEFAULT NULL,
   gate varchar(50) DEFAULT NULL,
   otp INT DEFAULT NULL,
   cust_id int(11) NOT NULL,
   manager_id int(11) NOT NULL,
   allowed_by varchar(100) DEFAULT NULL,
   visitor_img longtext COLLATE utf8mb4_unicode_ci,
   check_in_time TIMESTAMP NULL DEFAULT NULL,
   check_out_time TIMESTAMP NULL DEFAULT NULL,
   status bigint(20) DEFAULT NULL,
   features_allowed bigint(20) DEFAULT NULL,
   deleted_flag int(11) NOT NULL DEFAULT 0,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
 PRIMARY KEY (vist_id),
 FOREIGN KEY (cust_id) REFERENCES customers(cust_id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create Table regular_visitors

CREATE TABLE regular_visitors (
   id INT NOT NULL AUTO_INCREMENT,
   visitor_name varchar(225) DEFAULT NULL,
   visitor_mobile bigint(20) DEFAULT NULL,
   date_time varchar(100) NULL DEFAULT NULL,
   vehicle_no varchar(150) DEFAULT NULL,
   secu_id int(11) DEFAULT NULL,
   cust_id int(11) DEFAULT NULL,
   manager_id int(11) NOT NULL,
   allowed_by varchar(100) DEFAULT NULL,
   visitor_img longtext COLLATE utf8mb4_unicode_ci,
   status bigint(20) DEFAULT NULL,
   check_in_time TIMESTAMP NULL DEFAULT NULL,
   check_out_time TIMESTAMP NULL DEFAULT NULL,
   last_check_in_check_out bigint(20) DEFAULT NULL,
   features_allowed bigint(20) DEFAULT NULL,
   deleted_flag int(11) NOT NULL DEFAULT 0,
   created_at timestamp NULL DEFAULT NULL,
   updated_at timestamp NULL DEFAULT NULL,
 PRIMARY KEY (id),
 FOREIGN KEY (manager_id) REFERENCES users(id),
 FOREIGN KEY (cust_id) REFERENCES customers(cust_id),
 FOREIGN KEY (secu_id) REFERENCES security(secu_id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create Table visiter type

CREATE TABLE visitor_type (
  id INT NOT NULL AUTO_INCREMENT,
  type varchar(100) DEFAULT NULL,
  logo varchar(550) DEFAULT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create Table company

CREATE TABLE visitor_company (
  id INT NOT NULL AUTO_INCREMENT,
  type INT NOT NULL,
  company_name varchar(300) DEFAULT NULL,
  company_logo varchar(550) DEFAULT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (type) REFERENCES visitor_type(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create Table saveotp

CREATE TABLE saveotp (
   id INT NOT NULL AUTO_INCREMENT,
   mobile bigint(20) NOT NULL,
   otp int(225) NOT NULL,
   created_at timestamp NULL DEFAULT NULL,
 PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create Table NoticeBoard

 CREATE TABLE noticeboard (
  noti_id INT NOT NULL AUTO_INCREMENT,
  title varchar(100) DEFAULT NULL,
  notice longtext COLLATE utf8mb4_unicode_ci,
  expriy_date timestamp NULL DEFAULT NULL,
  vote enum('yes','no') DEFAULT NULL, 
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (noti_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create Table voting

 CREATE TABLE voting (
  id INT NOT NULL AUTO_INCREMENT,
  noti_id INT(11) DEFAULT NULL,
  vote enum('like','dislike') DEFAULT NULL,
  manager_id INT NOT NULL,
  cust_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (manager_id) REFERENCES users(id),
  FOREIGN KEY (cust_id) REFERENCES customers(cust_id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;





 -- Create Table complaints_type

CREATE TABLE complaints_type (
  id INT NOT NULL AUTO_INCREMENT,
  complaints_type varchar(100) DEFAULT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 -- Create Table Complaints

CREATE TABLE complaints (
  comp_id INT NOT NULL AUTO_INCREMENT,
  complaints_type_id INT NOT NULL,
  complaints_description longtext COLLATE utf8mb4_unicode_ci,
  cust_id INT NOT NULL,
  manager_id INT NOT NULL,
  status varchar(20) NOT NULL DEFAULT 'progress',
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (comp_id),
  FOREIGN KEY (manager_id) REFERENCES users(id),
  FOREIGN KEY (cust_id) REFERENCES customers(cust_id),
  FOREIGN KEY (complaints_type_id) REFERENCES complaints_type(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- complaints_images

CREATE TABLE  complaints_images(
  image_id INT NOT NULL AUTO_INCREMENT,
  comp_id INT NOT NULL,
  complaints_image varchar(550) DEFAULT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (image_id),
  FOREIGN KEY (comp_id) REFERENCES complaints(comp_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


 -- Create Table Vehicles

CREATE TABLE  vehicles(
  vehi_id INT NOT NULL AUTO_INCREMENT,
  vehicle_no varchar(250) DEFAULT NULL,
  vehicle_name varchar(250) DEFAULT NULL,
  vehicle_type varchar(250) DEFAULT NULL,
  cust_id INT NOT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (vehi_id),
  FOREIGN KEY (manager_id) REFERENCES users(id),
  FOREIGN KEY (cust_id) REFERENCES customers(cust_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- advantisment

CREATE TABLE  advantisment(
  advantisment_id INT NOT NULL AUTO_INCREMENT,
  advantisment_title varchar(550) DEFAULT NULL,
  stores varchar(550) DEFAULT NULL,
  advantisment_description longtext COLLATE utf8mb4_unicode_ci,
  expriy_date timestamp NULL DEFAULT NULL,
  manager_id INT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (advantisment_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- advantisment_society

CREATE TABLE  advantisment_society(
  id INT NOT NULL AUTO_INCREMENT,
  society_id INT NOT NULL,
  advantisment_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (advantisment_id) REFERENCES advantisment(advantisment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- advantisment_images

CREATE TABLE  advantisment_images(
  image_id INT NOT NULL AUTO_INCREMENT,
  advantisment_id INT NOT NULL,
  advantisment_image varchar(550) DEFAULT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (image_id),
  FOREIGN KEY (advantisment_id) REFERENCES advantisment(advantisment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- trending_stores

CREATE TABLE  trending_stores(
  trending_id INT NOT NULL AUTO_INCREMENT,
  trending_title varchar(550) DEFAULT NULL,
  trending_description longtext COLLATE utf8mb4_unicode_ci,
  cust_id INT NOT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (trending_id),
  FOREIGN KEY (manager_id) REFERENCES users(id),
  FOREIGN KEY (cust_id) REFERENCES customers(cust_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- trending_images

CREATE TABLE  trending_images(
  id INT NOT NULL AUTO_INCREMENT,
  trending_id INT NOT NULL,
  trending_images varchar(550) DEFAULT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (trending_id) REFERENCES trending_stores(trending_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- society_building

CREATE TABLE  society_building(
  building_id INT NOT NULL AUTO_INCREMENT,
  building_name varchar(550) DEFAULT NULL,
  gate_id INT DEFAULT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (building_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- society_building

CREATE TABLE  society_gate(
  gate_id INT NOT NULL AUTO_INCREMENT,
  gate_name varchar(550) DEFAULT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (gate_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- society_maintenance

CREATE TABLE  society_maintenance(
  maintenance_id INT NOT NULL AUTO_INCREMENT,
  start_date timestamp NOT NULL,
  end_date timestamp NOT NULL,
  building_maintenance INT DEFAULT NULL,
  lift_maintenance INT NOT NULL,
  security_maintenance INT NOT NULL,
  cleaning INT NOT NULL,
  water INT NOT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (maintenance_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--society notify_list

CREATE TABLE  notify_list(
  id INT NOT NULL AUTO_INCREMENT,
  notify_name varchar(200) NOT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--society_sos

CREATE TABLE  society_sos(
  id INT NOT NULL AUTO_INCREMENT,
  request_customer_id INT NOT NULL,
  responce_customer_id INT NOT NULL,
  manager_id INT NOT NULL,
  status bigint(20) DEFAULT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (manager_id) REFERENCES users(id),
  FOREIGN KEY (request_customer_id) REFERENCES customers(cust_id),
  FOREIGN KEY (responce_customer_id) REFERENCES customers(cust_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--sos_press

CREATE TABLE  sos_press(
  id INT NOT NULL AUTO_INCREMENT,
  request_customer_id INT NOT NULL,
  emergency_id INT NOT NULL,
  manager_id INT NOT NULL,
  status bigint(20) DEFAULT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (manager_id) REFERENCES users(id),
  FOREIGN KEY (request_customer_id) REFERENCES customers(cust_id),
  FOREIGN KEY (emergency_id) REFERENCES notify_list(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--daily_cab_request

CREATE TABLE  daily_cab_request(
  id INT NOT NULL AUTO_INCREMENT,
  cust_id INT NOT NULL,
  name varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  service_type varchar(200) DEFAULT NULL,
  pick_time TIME DEFAULT NULL,
  drop_time TIME DEFAULT NULL,
  mobile bigint(20) DEFAULT NULL,
  email varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  from_pick_location varchar(200) DEFAULT NULL,
  to_drop_location varchar(200) DEFAULT NULL,
  manager_id INT NOT NULL,
  status bigint(20) DEFAULT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (cust_id) REFERENCES customers(cust_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--payment

CREATE TABLE  payment(
  payment_id INT NOT NULL AUTO_INCREMENT,
  transaction_id varchar(200) NOT NULL,
  amount INT NOT NULL,
  payment_name varchar(250) NOT NULL,
  payment_is varchar(150) NOT NULL,
  fcmKey longtext,
  mobile bigint(20) DEFAULT NULL,
  cust_id INT NOT NULL,
  manager_id INT NOT NULL,
  payment_date varchar(150) NULL DEFAULT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (payment_id),
  FOREIGN KEY (cust_id) REFERENCES customers(cust_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--payment_history

CREATE TABLE  payment_history(
  id INT NOT NULL AUTO_INCREMENT,
  transaction_id varchar(200) NOT NULL,
  amount INT NOT NULL,
  payment_is varchar(150) NOT NULL,
  payment_date varchar(150) NULL DEFAULT NULL,
  payment_type varchar(150) NOT NULL,
  payment_id INT NOT NULL,
  cust_id INT NOT NULL,
  family_id INT NOT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (cust_id) REFERENCES customers(cust_id),
  FOREIGN KEY (payment_id) REFERENCES payment(payment_id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--account

CREATE TABLE  account(
  id INT NOT NULL AUTO_INCREMENT,
  account_number bigint(20) NOT NULL,
  confirm_account_number bigint(20) NOT NULL,
  ifsc_code varchar(50) NOT NULL,
  mobile bigint(20) DEFAULT NULL,
  bank_name varchar(255) NULL DEFAULT NULL,
  manager_id INT NOT NULL,
  features_allowed bigint(20) DEFAULT NULL,
  deleted_flag int(11) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (manager_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;











