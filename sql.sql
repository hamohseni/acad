CREATE TABLE IF NOT EXISTS `Grado` (
  `gra_id` INT(11) NOT NULL AUTO_INCREMENT,
  `gra_nombre` VARCHAR(45) NOT NULL,
  `niv_id` INT(11) NOT NULL,
  PRIMARY KEY (`gra_id`,`niv_id`),
  INDEX `fk_Grado_Nivel` (`niv_id` ASC),
  CONSTRAINT `fk_Grado_Nivel`
    FOREIGN KEY (`niv_id`)
    REFERENCES `Nivel` (`niv_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `Curso` (
  `cur_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cur_nombre` VARCHAR(45) NOT NULL,
  `cur_estado` BOOLEAN NOT NULL,
  PRIMARY KEY (`cur_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE TABLE IF NOT EXISTS `Curso_has_Grado` (
  `cur_gra_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cur_id` INT(11) NOT NULL,
  `gra_id` INT(11) NOT NULL,
  `cur_gra_estado` BOOLEAN NOT NULL,
  PRIMARY KEY (`cur_gra_id`, `cur_id`, `gra_id`),
  INDEX `fk_Curso_has_Grado_Curso1` (`cur_id` ASC),
  INDEX `fk_Curso_has_Grado_Grado1` (`gra_id` ASC),
  CONSTRAINT `fk_Curso_has_Grado_Curso1`
    FOREIGN KEY (`cur_id`)
    REFERENCES `Curso` (`cur_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_has_Grado_Grado1`
    FOREIGN KEY (`gra_id`)
    REFERENCES `Grado` (`gra_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;



