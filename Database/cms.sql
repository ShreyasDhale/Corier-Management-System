/*Database for COrier System*/

/* Login Database Admin */

CREATE DATABASE project;

/*Login Table*/
CREATE TABLE `project`.`login` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `user` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `address1` VARCHAR(45) NULL DEFAULT NULL,
  `contact` BIGINT(11) NOT NULL,
  `otp` INT NULL,
  `isAdmin` INT DEFAULT 0,
  PRIMARY KEY (`id`,`user`));

INSERT INTO `adminlogin` (`id`, `email`, `password`, `name`, `user`, `address`, `address1`, `contact`, `otp` , `isAdmin`) 
VALUES ('1', 'admin@gmail.com', 'Shreyas@123', 'Admin Name', 'Admin@123', 'Address', NULL, '1234567890', NULL , 0);

/*Staff*/
CREATE TABLE `project`.`staff` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `user` VARCHAR(45) NOT NULL,
  `branch_id` VARCHAR(45) NOT NULL,
  `Salary` INT NOT NULL,
  PRIMARY KEY (`id`,`user`));

/* Parcle Form Table */  

CREATE TABLE `project`.`parcelform` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sname` VARCHAR(45) NOT NULL,
  `saddr` VARCHAR(70) NOT NULL,
  `scont` BIGINT(11) NOT NULL,
  `rname` VARCHAR(45) NOT NULL,
  `raddr` VARCHAR(70) NOT NULL,
  `rcont` BIGINT(11) NOT NULL,
  `frombr` VARCHAR(45) NOT NULL,
  `tobr` VARCHAR(45) NOT NULL,
  `bill` INT NOT NULL,
  PRIMARY KEY (`id`)
);

/*One to many RelationShip*/

CREATE TABLE `project`.`parcel_info` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sname` VARCHAR(45) NOT NULL,
  `scont` VARCHAR(70) NOT NULL,
  `rcont` BIGINT(11) NOT NULL,
  `rname` VARCHAR(45) NOT NULL,
  `trackid` INT NOT NULL,
  `height` FLOAT NOT NULL,
  `width` FLOAT NOT NULL,
  `length` FLOAT NOT NULL,
  `weight` FLOAT NOT NULL,
  `price` FLOAT NOT NULL,
  `flag` INT NULL DEFAULT 0,
  `cust_id` INT REFERENCES userlogin(id),
  `bdate` DATE NOT NULL,
  `ddate` DATE NULL,
  `btime` TIME NOT NULL,
  `dtime` TIME NULL,
  CONSTRAINT PRIMARY KEY CLUSTERED(`id`)
);

/*Branch table */
CREATE TABLE `project`.`branch` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `building` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `state` VARCHAR(45) NOT NULL,
  `zip` INT NOT NULL,
  `country` VARCHAR(45) NOT NULL,
  `contact` BIGINT(11) NOT NULL,
  PRIMARY KEY (`id`, `contact`)
);

/*drop table parcelform;
drop table branch;
drop table adminlogin;
drop table userlogin;
drop table parcel_info;*/