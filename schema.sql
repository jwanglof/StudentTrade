SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `db1162056_st` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `db1162056_st` ;

-- -----------------------------------------------------
-- Table `db1162056_st`.`adType`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adType` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adType` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NOT NULL ,
  `color` VARCHAR(45) NOT NULL DEFAULT '#ffffff' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`city` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`city` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `city_name` VARCHAR(45) NOT NULL ,
  `short_name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`university`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`university` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`university` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `university_name` VARCHAR(100) NOT NULL ,
  `fk_university_city` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_city_name_idx` (`fk_university_city` ASC) ,
  CONSTRAINT `fk_university_city`
    FOREIGN KEY (`fk_university_city` )
    REFERENCES `db1162056_st`.`city` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`campus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`campus` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`campus` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `campus_name` VARCHAR(100) NOT NULL ,
  `fk_campus_university` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_university_name_idx` (`fk_campus_university` ASC) ,
  CONSTRAINT `fk_campus_university`
    FOREIGN KEY (`fk_campus_university` )
    REFERENCES `db1162056_st`.`university` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`admin` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`admin` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(150) NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`ad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`ad` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`ad` (
  `id` INT NOT NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `info` TEXT NOT NULL ,
  `password` INT NOT NULL ,
  `price` INT NOT NULL ,
  `date_created` DATETIME NOT NULL ,
  `valid_to_date` DATETIME NOT NULL ,
  `fk_ad_adType` INT NOT NULL ,
  `fk_ad_campus` INT NULL ,
  `fk_ad_city` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ad_type_id_idx` (`fk_ad_adType` ASC) ,
  INDEX `fk_campus_id_idx` (`fk_ad_campus` ASC) ,
  INDEX `fk_city_id_idx` (`fk_ad_city` ASC) ,
  CONSTRAINT `fk_ad_ad_type`
    FOREIGN KEY (`fk_ad_adType` )
    REFERENCES `db1162056_st`.`adType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ad_campus`
    FOREIGN KEY (`fk_ad_campus` )
    REFERENCES `db1162056_st`.`campus` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ad_city`
    FOREIGN KEY (`fk_ad_city` )
    REFERENCES `db1162056_st`.`city` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adUserInfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adUserInfo` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adUserInfo` (
  `id` INT NOT NULL ,
  `name` VARCHAR(80) NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `address` VARCHAR(45) NULL ,
  `fk_adUserInfo_ad` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ad_user_info_city_idx` (`fk_adUserInfo_ad` ASC) ,
  CONSTRAINT `fk_ad_user_info_city`
    FOREIGN KEY (`fk_adUserInfo_ad` )
    REFERENCES `db1162056_st`.`ad` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adTypeTickets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adTypeTickets` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adTypeTickets` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `event` VARCHAR(45) NULL ,
  `fk_adTypeTickets_adType` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_adTypeTickets_adType_idx` (`fk_adTypeTickets_adType` ASC) ,
  CONSTRAINT `fk_adTypeTickets_adType`
    FOREIGN KEY (`fk_adTypeTickets_adType` )
    REFERENCES `db1162056_st`.`adType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adTypeLiterature`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adTypeLiterature` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adTypeLiterature` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `isbn` INT NULL ,
  `fk_adTypeLiterature_adType` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_adTypeLiterature_adType_idx` (`fk_adTypeLiterature_adType` ASC) ,
  CONSTRAINT `fk_adTypeLiterature_adType`
    FOREIGN KEY (`fk_adTypeLiterature_adType` )
    REFERENCES `db1162056_st`.`adType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adTypeHousing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adTypeHousing` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adTypeHousing` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `size` INT NULL ,
  `fk_adTypeHousing_adType` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_adTypeHousing_adType_idx` (`fk_adTypeHousing_adType` ASC) ,
  CONSTRAINT `fk_adTypeHousing_adType`
    FOREIGN KEY (`fk_adTypeHousing_adType` )
    REFERENCES `db1162056_st`.`adType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adTypeWork`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adTypeWork` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adTypeWork` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `fk_adTypeWork_adType` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_adTypeWork_adType_idx` (`fk_adTypeWork_adType` ASC) ,
  CONSTRAINT `fk_adTypeWork_adType`
    FOREIGN KEY (`fk_adTypeWork_adType` )
    REFERENCES `db1162056_st`.`adType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adTypeTravel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adTypeTravel` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adTypeTravel` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `fk_adTypeTravel_adType` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_adTypeHousing_adType_idx` (`fk_adTypeTravel_adType` ASC) ,
  CONSTRAINT `fk_adTypeTravel_adType`
    FOREIGN KEY (`fk_adTypeTravel_adType` )
    REFERENCES `db1162056_st`.`adType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adTypeOther`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adTypeOther` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adTypeOther` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `fk_adTypeOther_adType` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_adTypeOther_adType_idx` (`fk_adTypeOther_adType` ASC) ,
  CONSTRAINT `fk_adTypeOther_adType`
    FOREIGN KEY (`fk_adTypeOther_adType` )
    REFERENCES `db1162056_st`.`adType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `db1162056_st` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `db1162056_st`.`adType`
-- -----------------------------------------------------
START TRANSACTION;
USE `db1162056_st`;
INSERT INTO `db1162056_st`.`adType` (`id`, `name`, `description`, `color`) VALUES (1, 'tickets', 'Biljetter', '#f5634a');
INSERT INTO `db1162056_st`.`adType` (`id`, `name`, `description`, `color`) VALUES (2, 'literature', 'Kurslitteratur', '#f3c14e');
INSERT INTO `db1162056_st`.`adType` (`id`, `name`, `description`, `color`) VALUES (3, 'house', 'Bostad', '#7cc576');
INSERT INTO `db1162056_st`.`adType` (`id`, `name`, `description`, `color`) VALUES (4, 'work', 'Jobb/arbete', '#3b8686');
INSERT INTO `db1162056_st`.`adType` (`id`, `name`, `description`, `color`) VALUES (5, 'travel', 'Resor/samåkning', '#0b486b');
INSERT INTO `db1162056_st`.`adType` (`id`, `name`, `description`, `color`) VALUES (6, 'other', 'Övrigt', '#a864a8');

COMMIT;

-- -----------------------------------------------------
-- Data for table `db1162056_st`.`city`
-- -----------------------------------------------------
START TRANSACTION;
USE `db1162056_st`;
INSERT INTO `db1162056_st`.`city` (`id`, `city_name`, `short_name`) VALUES (1, 'Linköping', 'linkoping');
INSERT INTO `db1162056_st`.`city` (`id`, `city_name`, `short_name`) VALUES (2, 'Stockholm', 'sthlm');
INSERT INTO `db1162056_st`.`city` (`id`, `city_name`, `short_name`) VALUES (3, 'Göteborg', 'gbg');
INSERT INTO `db1162056_st`.`city` (`id`, `city_name`, `short_name`) VALUES (4, 'Lund', 'lund');

COMMIT;

-- -----------------------------------------------------
-- Data for table `db1162056_st`.`university`
-- -----------------------------------------------------
START TRANSACTION;
USE `db1162056_st`;
INSERT INTO `db1162056_st`.`university` (`id`, `university_name`, `fk_university_city`) VALUES (1, 'Linköpings Universitet', 1);
INSERT INTO `db1162056_st`.`university` (`id`, `university_name`, `fk_university_city`) VALUES (2, 'Kungliga Tekniska högskolan', 2);
INSERT INTO `db1162056_st`.`university` (`id`, `university_name`, `fk_university_city`) VALUES (3, 'Chalmers tekniska högskola', 3);
INSERT INTO `db1162056_st`.`university` (`id`, `university_name`, `fk_university_city`) VALUES (4, 'Lunds Universitet', 4);
INSERT INTO `db1162056_st`.`university` (`id`, `university_name`, `fk_university_city`) VALUES (5, 'Göteborgs universitet', 3);
INSERT INTO `db1162056_st`.`university` (`id`, `university_name`, `fk_university_city`) VALUES (6, 'Stockholms universitet', 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `db1162056_st`.`campus`
-- -----------------------------------------------------
START TRANSACTION;
USE `db1162056_st`;
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (1, 'Valla', 1);
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (2, 'US', 1);
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (3, 'Norrköping', 1);
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (4, 'Helsingborg', 4);
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (5, 'KTH Campus', 2);
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (6, 'Johanneberg', 3);
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (7, 'Lindholmen', 3);
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (8, 'Konradsberg', 6);
INSERT INTO `db1162056_st`.`campus` (`id`, `campus_name`, `fk_campus_university`) VALUES (9, 'Linné', 5);

COMMIT;

-- -----------------------------------------------------
-- Data for table `db1162056_st`.`admin`
-- -----------------------------------------------------
START TRANSACTION;
USE `db1162056_st`;
INSERT INTO `db1162056_st`.`admin` (`id`, `username`, `password`, `name`) VALUES (1, 'jwanglof', 'asdf', 'Johan Wänglöf');

COMMIT;
