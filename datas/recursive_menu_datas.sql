-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema recursive_menu
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema recursive_menu
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `recursive_menu` DEFAULT CHARACTER SET utf8 ;
USE `recursive_menu` ;

-- -----------------------------------------------------
-- Table `recursive_menu`.`rubriques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursive_menu`.`rubriques` (
  `idrubriques` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rubriques_name` VARCHAR(120) NOT NULL,
  `rubriques_text` VARCHAR(500) NULL,
  `rubriques_order` SMALLINT UNSIGNED NULL DEFAULT 0,
  `rubriques_idrubriques` INT UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`idrubriques`),
  INDEX `fk_rubriques_rubriques_idx` (`rubriques_idrubriques` ASC),
  CONSTRAINT `fk_rubriques_rubriques`
    FOREIGN KEY (`rubriques_idrubriques`)
    REFERENCES `recursive_menu`.`rubriques` (`idrubriques`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursive_menu`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursive_menu`.`articles` (
  `idarticles` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `articles_title` VARCHAR(150) NOT NULL,
  `articles_text` TEXT NOT NULL,
  `articles_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idarticles`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `recursive_menu`.`articles_has_rubriques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recursive_menu`.`articles_has_rubriques` (
  `articles_idarticles` INT UNSIGNED NOT NULL,
  `rubriques_idrubriques` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`articles_idarticles`, `rubriques_idrubriques`),
  INDEX `fk_articles_has_rubriques_rubriques1_idx` (`rubriques_idrubriques` ASC),
  INDEX `fk_articles_has_rubriques_articles1_idx` (`articles_idarticles` ASC),
  CONSTRAINT `fk_articles_has_rubriques_articles1`
    FOREIGN KEY (`articles_idarticles`)
    REFERENCES `recursive_menu`.`articles` (`idarticles`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_rubriques_rubriques1`
    FOREIGN KEY (`rubriques_idrubriques`)
    REFERENCES `recursive_menu`.`rubriques` (`idrubriques`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
