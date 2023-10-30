-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema wonderfull_travel
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `wonderfull_travel` ;

-- -----------------------------------------------------
-- Schema wonderfull_travel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `wonderfull_travel` DEFAULT CHARACTER SET utf8 ;
USE `wonderfull_travel` ;

-- -----------------------------------------------------
-- Table `wonderfull_travel`.`continent`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wonderfull_travel`.`continent` ;

CREATE TABLE IF NOT EXISTS `wonderfull_travel`.`continent` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wonderfull_travel`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wonderfull_travel`.`pais` ;

CREATE TABLE IF NOT EXISTS `wonderfull_travel`.`pais` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `continent_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_pais_continent1`
    FOREIGN KEY (`continent_id`)
    REFERENCES `wonderfull_travel`.`continent` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wonderfull_travel`.`ofertes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wonderfull_travel`.`ofertes` ;

CREATE TABLE IF NOT EXISTS `wonderfull_travel`.`ofertes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pais_id` INT UNSIGNED NOT NULL,
  `preu` DECIMAL(5,2) NOT NULL,
  `imatges` VARCHAR(45) NOT NULL,
  `durada_dies` INT UNSIGNED NOT NULL,
  `valida` BIT(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `pais_id`
    FOREIGN KEY (`pais_id`)
    REFERENCES `wonderfull_travel`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wonderfull_travel`.`reserva`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wonderfull_travel`.`reserva` ;

CREATE TABLE IF NOT EXISTS `wonderfull_travel`.`reserva` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `oferta_id` INT UNSIGNED NOT NULL,
  `descompte` BIT(1) NOT NULL,
  `client_nom` VARCHAR(50) NOT NULL,
  `client_telefon` VARCHAR(50) NOT NULL,
  `quantitat_persones` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_reserva_oferta`
    FOREIGN KEY (`oferta_id`)
    REFERENCES `wonderfull_travel`.`ofertes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
