INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos', 'Gastos', 'index');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Alta', 'Gastos', 'alta');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Editar', 'Gastos', 'edit');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Ver', 'Gastos', 'alta');



CREATE TABLE `systemmy_tallerhp`.`catgastos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `detalles` INT NULL DEFAULT 0,
  `total` DOUBLE NULL DEFAULT 0,
  PRIMARY KEY (`id`));

CREATE TABLE `systemmy_tallerhp`.`gastos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NULL,
  `nombre` VARCHAR(200) NULL,
  `cantidad` DOUBLE NULL,
  `total` DOUBLE NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `created_date` TIMESTAMP NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`));

-- 
-- 06 febrero 
--

CREATE TABLE `systemmy_tallerhp`.`tipo_gasto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `descripcion` TEXT NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `systemmy_tallerhp`.`gastos` 
DROP COLUMN `cantidad`,
ADD COLUMN `id_tipogasto` INT NULL AFTER `created_date`;
ALTER TABLE `systemmy_tallerhp`.`gastos` 
ADD CONSTRAINT `id_tipogasto_tipogasto_dx`
  FOREIGN KEY (`id_tipogasto`)
  REFERENCES `systemmy_tallerhp`.`tipo_gasto` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `systemmy_tallerhp`.`tipo_gasto` 
RENAME TO  `systemmy_tallerhp`.`gasto_tipo` ;


ALTER TABLE `systemmy_tallerhp`.`gastos` 
DROP FOREIGN KEY `id_tipogasto_tipogasto_dx`;
ALTER TABLE `systemmy_tallerhp`.`gastos` 
CHANGE COLUMN `id_tipogasto` `id_gastotipo` INT(11) NULL DEFAULT NULL ;
ALTER TABLE `systemmy_tallerhp`.`gastos` 
ADD CONSTRAINT `id_tipogasto_tipogasto_dx`
  FOREIGN KEY (`id_gastotipo`)
  REFERENCES `systemmy_tallerhp`.`gasto_tipo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

CREATE TABLE `systemmy_tallerhp`.`gastos_registros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_gastostipo` INT NULL,
  `detalles` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `created_date` TIMESTAMP NULL DEFAULT current_timestamp,
  `deleted_date` TIMESTAMP NULL,
  `updated_date` TIMESTAMP NULL,
  `cantidad` DOUBLE NULL,
  `total` DOUBLE NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_gastostipo_gastosregistros_dx`
    FOREIGN KEY (`id_gastostipo`)
    REFERENCES `systemmy_tallerhp`.`gasto_tipo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


ALTER TABLE `systemmy_tallerhp`.`gastos` 
ADD COLUMN `comentarios` TEXT NULL AFTER `id_gastotipo`;

ALTER TABLE `systemmy_tallerhp`.`gastos` 
ADD COLUMN `id_taller` INT NULL AFTER `id_user`,
CHANGE COLUMN `id_gastotipo` `id_gastotipo` INT(11) NULL DEFAULT NULL AFTER `id_taller`;

ALTER TABLE `systemmy_tallerhp`.`gastos` 
ADD CONSTRAINT `id_taller_gastos_dx`
  FOREIGN KEY (`id_taller`)
  REFERENCES `systemmy_tallerhp`.`taller` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `systemmy_tallerhp`.`gastos_registros` 
DROP FOREIGN KEY `id_gastostipo_gastosregistros_dx`;
ALTER TABLE `systemmy_tallerhp`.`gastos_registros` 
CHANGE COLUMN `id_gastostipo` `id_gastotipo` INT(11) NULL DEFAULT NULL ;
ALTER TABLE `systemmy_tallerhp`.`gastos_registros` 
ADD CONSTRAINT `id_gastostipo_gastosregistros_dx`
  FOREIGN KEY (`id_gastotipo`)
  REFERENCES `systemmy_tallerhp`.`gasto_tipo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `systemmy_tallerhp`.`gasto_tipo` 
ADD COLUMN `codigo` VARCHAR(45) NULL AFTER `id`,
CHANGE COLUMN `nombre` `nombre` VARCHAR(200) NULL DEFAULT NULL ;


INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Alta', 'Gastos', 'index');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Editar', 'Gastos', 'add');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Ver', 'Gastos', 'view');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Borrar', 'Gastos', 'gastosdelete');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Tipos', 'Catalogos', 'gastostipo');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Tipos Alta', 'Catalogos', 'gastostipoadd');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Tipos Editar', 'Catalogos', 'gastostipoedit');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Tipos Borrar', 'Catalogos', 'gastostipodelete');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Gastos Tipos Ver', 'Catalogos', 'gastostiposhow');

ALTER TABLE `systemmy_tallerhp`.`gasto_tipo` 
RENAME TO  `systemmy_tallerhp`.`gastos_tipo` ;


ALTER TABLE `systemmy_tallerhp`.`gastos_tipo` 
ADD COLUMN `detalles` INT NULL DEFAULT 1 AFTER `descripcion`;
ALTER TABLE `systemmy_tallerhp`.`gastos_tipo` 
ADD COLUMN `tipo` VARCHAR(45) NULL DEFAULT 'Normal' AFTER `detalles`;


ALTER TABLE `systemmy_tallerhp`.`gastos_registros` 
DROP FOREIGN KEY `id_gastostipo_gastosregistros_dx`;
ALTER TABLE `systemmy_tallerhp`.`gastos_registros` 
CHANGE COLUMN `id_gastotipo` `id_gastostipo` INT(11) NULL DEFAULT NULL ;
ALTER TABLE `systemmy_tallerhp`.`gastos_registros` 
ADD CONSTRAINT `id_gastostipo_gastosregistros_dx`
  FOREIGN KEY (`id_gastostipo`)
  REFERENCES `systemmy_tallerhp`.`gastos_tipo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


DROP TABLE `systemmy_tallerhp`.`catgastos`;



ALTER TABLE `systemmy_tallerhp`.`gastos_registros` 
ADD COLUMN `id_gastos` INT NULL AFTER `id_gastostipo`;
ALTER TABLE `systemmy_tallerhp`.`gastos_registros` 
ADD CONSTRAINT `id_gastos_gastostipo_dx`
  FOREIGN KEY (`id_gastos`)
  REFERENCES `systemmy_tallerhp`.`gastos` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
