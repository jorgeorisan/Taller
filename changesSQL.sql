/* 26 sept 2018  */
CREATE TABLE `systemmy_tallerhp`.`trabajo` (
  `id` INT NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `nombre` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `created_date` VARCHAR(45) NULL,
  `updated_date` VARCHAR(45) NULL,
  `deleted_date` VARCHAR(45) NULL,
  `id_user` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));


CREATE TABLE `systemmy_tallerhp`.`permiso` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `section` VARCHAR(45) NULL,
  `page` VARCHAR(45) NULL,
  `id_user` VARCHAR(45) NULL,
  `created_date` VARCHAR(45) NULL,
  `updated_date` VARCHAR(45) NULL,
  `deleted_date` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `systemmy_tallerhp`.`permiso_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_permiso` INT NULL,
  `id_user` INT NULL,
  `created_date` TIMESTAMP NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `id_permisopermisouser_dx_idx` (`id_permiso` ASC),
  INDEX `id_userpermisouser_dx_idx` (`id_user` ASC),
  CONSTRAINT `id_userpermisouser_dx`
    FOREIGN KEY (`id_user`)
    REFERENCES `systemmy_tallerhp`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_permisopermisouser_dx`
    FOREIGN KEY (`id_permiso`)
    REFERENCES `systemmy_tallerhp`.`permiso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
ALTER TABLE `systemmy_tallerhp`.`permiso_user` 
DROP FOREIGN KEY `id_permisopermisouser_dx`;

ALTER TABLE `systemmy_tallerhp`.`permiso` 
DROP COLUMN `id_user`,
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `nombre` `nombre` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `section` `section` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `page` `page` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `created_date` `created_date` TIMESTAMP NULL DEFAULT current_timestamp ,
CHANGE COLUMN `updated_date` `updated_date` TIMESTAMP NULL DEFAULT NULL ,
CHANGE COLUMN `deleted_date` `deleted_date` TIMESTAMP NULL DEFAULT NULL ;


ALTER TABLE `systemmy_tallerhp`.`permiso_user` 
DROP INDEX `id_permisopermisouser_dx_idx` ,
ADD INDEX `id_permisopermisouser2_dx_idx` (`id_permiso` ASC);
ALTER TABLE `systemmy_tallerhp`.`permiso_user` 
ADD CONSTRAINT `id_permisopermisouser_dx`
  FOREIGN KEY (`id_permiso`)
  REFERENCES `systemmy_tallerhp`.`permiso` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `systemmy_tallerhp`.`trabajo` 
CHANGE COLUMN `id_user` `id_user` VARCHAR(45) NULL DEFAULT NULL AFTER `status`,
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `created_date` `created_date` TIMESTAMP NULL DEFAULT current_timestamp ,
CHANGE COLUMN `updated_date` `updated_date` TIMESTAMP NULL DEFAULT NULL ,
CHANGE COLUMN `deleted_date` `deleted_date` TIMESTAMP NULL DEFAULT NULL ;


ALTER TABLE `systemmy_tallerhp`.`permiso` 
ADD COLUMN `status` VARCHAR(45) NULL DEFAULT 'active' AFTER `deleted_date`;
