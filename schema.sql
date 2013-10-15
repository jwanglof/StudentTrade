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
-- Table `db1162056_st`.`adUserInfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adUserInfo` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adUserInfo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(80) NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `phonenumber` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`ad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`ad` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`ad` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NOT NULL ,
  `info` TEXT NOT NULL ,
  `password` INT NOT NULL ,
  `price` INT NOT NULL ,
  `date_created` DATETIME NOT NULL ,
  `date_expired` DATETIME NOT NULL ,
  `showed` INT NOT NULL ,
  `fk_ad_adType` INT NOT NULL ,
  `fk_ad_campus` INT NULL ,
  `fk_ad_city` INT NULL ,
  `fk_ad_adUserInfo` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ad_type_id_idx` (`fk_ad_adType` ASC) ,
  INDEX `fk_campus_id_idx` (`fk_ad_campus` ASC) ,
  INDEX `fk_city_id_idx` (`fk_ad_city` ASC) ,
  INDEX `fk_ad_adUserInfo_idx` (`fk_ad_adUserInfo` ASC) ,
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
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ad_adUserInfo`
    FOREIGN KEY (`fk_ad_adUserInfo` )
    REFERENCES `db1162056_st`.`adUserInfo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adTypeInfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adTypeInfo` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adTypeInfo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(20) NOT NULL ,
  `short_name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NULL ,
  `fk_adTypeInfo_adType` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_adTypeInfo_adType_idx` (`fk_adTypeInfo_adType` ASC) ,
  CONSTRAINT `fk_adTypeInfo_adType`
    FOREIGN KEY (`fk_adTypeInfo_adType` )
    REFERENCES `db1162056_st`.`adType` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db1162056_st`.`adInfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db1162056_st`.`adInfo` ;

CREATE  TABLE IF NOT EXISTS `db1162056_st`.`adInfo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `value` VARCHAR(100) NOT NULL ,
  `fk_adInfo_adTypeInfo` INT NOT NULL ,
  `fk_adInfo_ad` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_adInfo_adTypeInfo_idx` (`fk_adInfo_adTypeInfo` ASC) ,
  INDEX `fk_adInfo_ad_idx` (`fk_adInfo_ad` ASC) ,
  CONSTRAINT `fk_adInfo_adTypeInfo`
    FOREIGN KEY (`fk_adInfo_adTypeInfo` )
    REFERENCES `db1162056_st`.`adTypeInfo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adInfo_ad`
    FOREIGN KEY (`fk_adInfo_ad` )
    REFERENCES `db1162056_st`.`ad` (`id` )
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

-- -----------------------------------------------------
-- Data for table `db1162056_st`.`adTypeInfo`
-- -----------------------------------------------------
START TRANSACTION;
USE `db1162056_st`;
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (1, 'Evenemang', 'event', NULL, 1);
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (2, 'ISBN', 'isbn', NULL, 2);
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (3, 'Författare', 'author', NULL, 2);
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (4, 'Skick', 'condition', NULL, 2);
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (5, 'Adress', 'address', NULL, 3);
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (6, 'Kvadratmeter (m2)', 'size', NULL, 3);
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (7, 'Företag', 'company', NULL, 4);
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (8, 'Från', 'travel_from', NULL, 5);
INSERT INTO `db1162056_st`.`adTypeInfo` (`id`, `name`, `short_name`, `description`, `fk_adTypeInfo_adType`) VALUES (9, 'Till', 'travel_to', NULL, 5);

COMMIT;
