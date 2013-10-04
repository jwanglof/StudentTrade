SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `StudentTrade` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `StudentTrade` ;

-- -----------------------------------------------------
-- Table `StudentTrade`.`ad_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `StudentTrade`.`ad_type` ;

CREATE  TABLE IF NOT EXISTS `StudentTrade`.`ad_type` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `StudentTrade`.`city` ;

CREATE  TABLE IF NOT EXISTS `StudentTrade`.`city` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `city_name` VARCHAR(45) NOT NULL ,
  `short_name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`university`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `StudentTrade`.`university` ;

CREATE  TABLE IF NOT EXISTS `StudentTrade`.`university` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `university_name` VARCHAR(100) NOT NULL ,
  `fk_city_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_city_name_idx` (`fk_city_id` ASC) ,
  CONSTRAINT `fk_city_id`
    FOREIGN KEY (`fk_city_id` )
    REFERENCES `StudentTrade`.`city` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`campus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `StudentTrade`.`campus` ;

CREATE  TABLE IF NOT EXISTS `StudentTrade`.`campus` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `campus_name` VARCHAR(100) NOT NULL ,
  `fk_university_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_university_name_idx` (`fk_university_id` ASC) ,
  CONSTRAINT `fk_university_id`
    FOREIGN KEY (`fk_university_id` )
    REFERENCES `StudentTrade`.`university` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `StudentTrade`.`admin` ;

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
DROP TABLE IF EXISTS `StudentTrade`.`ad` ;

CREATE  TABLE IF NOT EXISTS `StudentTrade`.`ad` (
  `id` INT NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `info` TEXT NOT NULL ,
  `password` INT NOT NULL ,
  `price` INT NOT NULL ,
  `date_created` DATETIME NOT NULL ,
  `valid_to_date` DATETIME NOT NULL ,
  `fk_ad_type_id` INT NOT NULL ,
  `fk_campus_id` INT NULL ,
  `fk_city_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ad_type_id_idx` (`fk_ad_type_id` ASC) ,
  INDEX `fk_campus_id_idx` (`fk_campus_id` ASC) ,
  INDEX `fk_city_id_idx` (`fk_city_id` ASC) ,
  CONSTRAINT `fk_ad_type_id`
    FOREIGN KEY (`fk_ad_type_id` )
    REFERENCES `StudentTrade`.`ad_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_campus_id`
    FOREIGN KEY (`fk_campus_id` )
    REFERENCES `StudentTrade`.`campus` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_city_id`
    FOREIGN KEY (`fk_city_id` )
    REFERENCES `StudentTrade`.`city` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `StudentTrade`.`ad_user_info`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `StudentTrade`.`ad_user_info` ;

CREATE  TABLE IF NOT EXISTS `StudentTrade`.`ad_user_info` (
  `id` INT NOT NULL ,
  `name` VARCHAR(80) NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
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

-- -----------------------------------------------------
-- Data for table `StudentTrade`.`ad_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `StudentTrade`;
INSERT INTO `StudentTrade`.`ad_type` (`id`, `name`, `description`) VALUES (1, 'tickets', 'Biljetter');
INSERT INTO `StudentTrade`.`ad_type` (`id`, `name`, `description`) VALUES (2, 'literature', 'Kurslitteratur');
INSERT INTO `StudentTrade`.`ad_type` (`id`, `name`, `description`) VALUES (3, 'house', 'Bostad');
INSERT INTO `StudentTrade`.`ad_type` (`id`, `name`, `description`) VALUES (4, 'work', 'Jobb/arbete');
INSERT INTO `StudentTrade`.`ad_type` (`id`, `name`, `description`) VALUES (5, 'travel', 'Resor/samåkning');
INSERT INTO `StudentTrade`.`ad_type` (`id`, `name`, `description`) VALUES (6, 'other', 'Övrigt');

COMMIT;

-- -----------------------------------------------------
-- Data for table `StudentTrade`.`city`
-- -----------------------------------------------------
START TRANSACTION;
USE `StudentTrade`;
INSERT INTO `StudentTrade`.`city` (`id`, `city_name`, `short_name`) VALUES (1, 'Linköping', 'linkoping');
INSERT INTO `StudentTrade`.`city` (`id`, `city_name`, `short_name`) VALUES (2, 'Stockholm', 'sthlm');
INSERT INTO `StudentTrade`.`city` (`id`, `city_name`, `short_name`) VALUES (3, 'Göteborg', 'gbg');
INSERT INTO `StudentTrade`.`city` (`id`, `city_name`, `short_name`) VALUES (4, 'Lund', 'lund');

COMMIT;

-- -----------------------------------------------------
-- Data for table `StudentTrade`.`university`
-- -----------------------------------------------------
START TRANSACTION;
USE `StudentTrade`;
INSERT INTO `StudentTrade`.`university` (`id`, `university_name`, `fk_city_id`) VALUES (1, 'Linköpings Universitet', 1);
INSERT INTO `StudentTrade`.`university` (`id`, `university_name`, `fk_city_id`) VALUES (2, 'Kungliga Tekniska högskolan', 2);
INSERT INTO `StudentTrade`.`university` (`id`, `university_name`, `fk_city_id`) VALUES (3, 'Chalmers tekniska högskola', 3);
INSERT INTO `StudentTrade`.`university` (`id`, `university_name`, `fk_city_id`) VALUES (4, 'Lunds Universitet', 4);
INSERT INTO `StudentTrade`.`university` (`id`, `university_name`, `fk_city_id`) VALUES (5, 'Göteborgs universitet', 3);
INSERT INTO `StudentTrade`.`university` (`id`, `university_name`, `fk_city_id`) VALUES (6, 'Stockholms universitet', 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `StudentTrade`.`campus`
-- -----------------------------------------------------
START TRANSACTION;
USE `StudentTrade`;
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (1, 'Valla', 1);
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (2, 'US', 1);
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (3, 'Norrköping', 1);
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (4, 'Helsingborg', 4);
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (5, 'KTH Campus', 2);
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (6, 'Johanneberg', 3);
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (7, 'Lindholmen', 3);
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (8, 'Konradsberg', 6);
INSERT INTO `StudentTrade`.`campus` (`id`, `campus_name`, `fk_university_id`) VALUES (9, 'Linné', 5);

COMMIT;

-- -----------------------------------------------------
-- Data for table `StudentTrade`.`admin`
-- -----------------------------------------------------
START TRANSACTION;
USE `StudentTrade`;
INSERT INTO `StudentTrade`.`admin` (`id`, `username`, `password`, `name`) VALUES (1, 'jwanglof', 'asdf', 'Johan Wänglöf');

COMMIT;
