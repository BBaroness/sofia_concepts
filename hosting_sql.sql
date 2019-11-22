#Create Database
CREATE DATABASE webtech_fall2019_;


# Create table for clients
CREATE TABLE `webtech_fall2019_`.`clients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NOT NULL,
  `lname` VARCHAR(45) NOT NULL,
  `gender` ENUM('male', 'female', 'other') NOT NULL,
  `email` VARCHAR(45) NOT NULL UNIQUE,
  `contact` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));
  
  
  # Create Testimonials Table
  CREATE TABLE `webtech_fall2019_`.`testimonials` (
  `client_id` INT NOT NULL,
  `subject` VARCHAR(45) NOT NULL,
  `message` VARCHAR(280) NOT NULL,
  `display_approval` BOOLEAN NOT NULL DEFAULT 0,
  INDEX `client_comment_reference_idx` (`client_id` ASC),
  CONSTRAINT `client_comment_reference`
    FOREIGN KEY (`client_id`)
    REFERENCES `webtech_fall2019_`.`clients` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
    
    
    # Create table for services on offer
    CREATE TABLE `webtech_fall2019_`.`services` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `price` DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`id`));
  
  
  # Create table with different timeslots
  CREATE TABLE `webtech_fall2019_`.`time_slots` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`));
  
  
  # Create table to keep track of bookings
  CREATE TABLE `webtech_fall2019_`.`bookings` (
  `time_slot_id` INT NOT NULL,
  `client_id` INT NOT NULL,
  `service_id` INT NOT NULL,
  `booking_date` DATE NOT NULL,
  `served` ENUM('true', 'false') NULL DEFAULT 'false',
  INDEX `timeslot_booking_ref_idx` (`time_slot_id` ASC),
  INDEX `client_booking_ref_idx` (`client_id` ASC) ,
  INDEX `service_booking_ref_idx` (`service_id` ASC) ,
  PRIMARY KEY (`time_slot_id`, `service_id`, `booking_date`),
  CONSTRAINT `timeslot_booking_ref`
    FOREIGN KEY (`time_slot_id`)
    REFERENCES `webtech_fall2019_`.`time_slots` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `client_booking_ref`
    FOREIGN KEY (`client_id`)
    REFERENCES `webtech_fall2019_`.`clients` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `service_booking_ref`
    FOREIGN KEY (`service_id`)
    REFERENCES `webtech_fall2019_`.`services` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
    
    
    # Create table for Product Categories
    CREATE TABLE `webtech_fall2019_`.`product_categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));
  
  
  
      
    # Finally, create products table
    CREATE TABLE `webtech_fall2019_`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT NULL,
  `name` VARCHAR(45) NOT NULL,
  `price` DECIMAL(6,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `product_category_ref_idx` (`category_id` ASC),
  CONSTRAINT `product_category_ref`
    FOREIGN KEY (`category_id`)
    REFERENCES `webtech_fall2019_`.`product_categories` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE);

  
  
  