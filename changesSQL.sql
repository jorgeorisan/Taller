/* 28 sept 2018  */
ALTER TABLE `systemmy_tallerhp`.`user_type` 
ADD COLUMN `comentarios` VARCHAR(100) NULL AFTER `nombre`;

CREATE TABLE `systemmy_tallerhp`.`permiso_usertype` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_permiso` INT NULL,
  `id_usertype` INT NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  INDEX `id_usertypepermisousertype_dx_idx` (`id_usertype` ASC),
  INDEX `id_permisopermisousertype_dx_idx` (`id_permiso` ASC),
  CONSTRAINT `id_permisopermisousertype_dx`
    FOREIGN KEY (`id_permiso`)
    REFERENCES `systemmy_tallerhp`.`permiso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_usertypepermisousertype_dx`
    FOREIGN KEY (`id_usertype`)
    REFERENCES `systemmy_tallerhp`.`user_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


/****02 oct 2018**/
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Trabajos', 'Catalogos', 'trabajo');
UPDATE `systemmy_tallerhp`.`permiso` SET `nombre`='Sub Marcas' WHERE `id`='39';
UPDATE `systemmy_tallerhp`.`permiso` SET `nombre`='Marcas' WHERE `id`='34';
UPDATE `systemmy_tallerhp`.`permiso` SET `nombre`='Aseguradoras' WHERE `id`='33';
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Trabajos Alta', 'Catalogos', 'trabajoadd');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Trabajos Editar', 'Catalogos', 'trabajoedit');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Trabajos Borrar', 'Catalogos', 'trabajodelete');

/***26 oct 2018**/
CREATE TABLE `systemmy_tallerhp`.`vehiculo_servicio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_vehiculo` INT NULL,
  `id_servicio` INT NULL,
  `total` DOUBLE NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `created_date` TIMESTAMP NULL DEFAULT current_timestamp,
  `updated_date` TIMESTAMP NULL,
  `deleted_date` TIMESTAMP NULL,
  `updated_user` INT NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `systemmy_tallerhp`.`vehiculo_servicio` 
ADD CONSTRAINT `id_servicio_vehiculoservicio_dx`
  FOREIGN KEY (`id_servicio`)
  REFERENCES `systemmy_tallerhp`.`servicio` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `id_vehiculo_vehiculoservicio_dx`
  FOREIGN KEY (`id_vehiculo`)
  REFERENCES `systemmy_tallerhp`.`vehiculo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


  CREATE TABLE `systemmy_tallerhp`.`vehiculo_refaccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_vehiculo` INT NULL,
  `id_refaccion` INT NULL,
  `cantidad` DOUBLE NULL,
  `costo_aprox` DOUBLE NULL,
  `costo_real` DOUBLE NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `created_date` TIMESTAMP NULL DEFAULT current_timestamp,
  `updated_date` TIMESTAMP NULL,
  `deleted_date` TIMESTAMP NULL,
  `updated_user` INT NULL,
  PRIMARY KEY (`id`));
  
ALTER TABLE `systemmy_tallerhp`.`vehiculo_refaccion` 
ADD CONSTRAINT `id_refaccion_vehiculorefaccion_dx`
  FOREIGN KEY (`id_refaccion`)
  REFERENCES `systemmy_tallerhp`.`refaccion` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `id_vehiculo_vehiculorefaccion_dx`
  FOREIGN KEY (`id_vehiculo`)
  REFERENCES `systemmy_tallerhp`.`vehiculo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
