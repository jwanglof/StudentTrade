SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `StudentTrade` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `StudentTrade` ;

-- -----------------------------------------------------
-- Table `StudentTrade`.`ad_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `StudentTrade`.`ad_type` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `desc` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`city`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `StudentTrade`.`city` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`university`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `StudentTrade`.`university` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_city`
    FOREIGN KEY (`id` )
    REFERENCES `StudentTrade`.`city` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`campus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `StudentTrade`.`campus` (
  `id` INT NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_university`
    FOREIGN KEY (`id` )
    REFERENCES `StudentTrade`.`university` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`admin`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `StudentTrade`.`admin` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(150) NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`ad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `StudentTrade`.`ad` (
  `id` INT NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `info` TEXT NOT NULL ,
  `password` INT NOT NULL ,
  `date_created` DATETIME NOT NULL ,
  `valid_to_date` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_ad_type`
    FOREIGN KEY (`id` )
    REFERENCES `StudentTrade`.`ad_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`ad_user_info`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `StudentTrade`.`ad_user_info` (
  `id` INT NOT NULL ,
  `name` VARCHAR(80) NULL ,
  `email` VARCHAR(100) NULL ,
  `address` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_city`
    FOREIGN KEY (`id` )
    REFERENCES `StudentTrade`.`city` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `StudentTrade` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
