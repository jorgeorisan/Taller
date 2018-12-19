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


-- 29 nov 2018


CREATE TABLE `systemmy_tallerhp`.`historial_vehiculoservicio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_vehiculoservicio` INT NULL,
  `id_user` INT NULL,
  `status_anterior` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  `comentarios` VARCHAR(300) NULL,
  `created_date` VARCHAR(45) NULL DEFAULT 'current_timestamp',
  PRIMARY KEY (`id`),
  CONSTRAINT `id_vehiculoservicio_historialvehiculoservicio_dx`
    FOREIGN KEY (`id_vehiculoservicio`)
    REFERENCES `systemmy_tallerhp`.`vehiculo_servicio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_user_historialvehiculoservicio_dx`
    FOREIGN KEY (`id_user`)
    REFERENCES `systemmy_tallerhp`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



CREATE TABLE `systemmy_tallerhp`.`historial_vehiculorefaccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_vehiculorefaccion` INT NULL,
  `id_user` INT NULL,
  `status_anterior` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  `comentarios` VARCHAR(300) NULL,
  `created_date` VARCHAR(45) NULL DEFAULT 'current_timestamp',
  PRIMARY KEY (`id`),
  CONSTRAINT `id_vehiculorefaccion_historialvehiculorefaccion_dx`
    FOREIGN KEY (`id_vehiculorefaccion`)
    REFERENCES `systemmy_tallerhp`.`vehiculo_refaccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_user_historialvehiculorefaccion_dx`
    FOREIGN KEY (`id_user`)
    REFERENCES `systemmy_tallerhp`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



ALTER TABLE `systemmy_tallerhp`.`historial_vehiculoservicio` 
CHANGE COLUMN `created_date` `created_date` TIMESTAMP NULL DEFAULT current_timestamp ;

ALTER TABLE `systemmy_tallerhp`.`historial_vehiculorefaccion` 
CHANGE COLUMN `created_date` `created_date` TIMESTAMP NULL DEFAULT current_timestamp ;


INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Servicio Vehiculo Borrar', 'Vehiculos', 'vehiculoserviciodelete');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Refaccion Vehiculo Borrar', 'Vehiculos', 'vehiculorefacciondelete');


--
-- 19 dic 2018
--agregar fechas al historial de servicios

ALTER TABLE `systemmy_tallerhp`.`historial_vehiculoservicio` 
ADD COLUMN `fecha_inicio` VARCHAR(45) NULL AFTER `created_date`,
ADD COLUMN `fecha_estimada` VARCHAR(45) NULL AFTER `fecha_inicio`,
ADD COLUMN `fecha_fin` VARCHAR(45) NULL AFTER `fecha_estimada`;

ALTER TABLE `systemmy_tallerhp`.`historial_vehiculorefaccion` 
ADD COLUMN `fecha_inicio` VARCHAR(45) NULL AFTER `created_date`,
ADD COLUMN `fecha_estimada` VARCHAR(45) NULL AFTER `fecha_inicio`,
ADD COLUMN `fecha_fin` VARCHAR(45) NULL AFTER `fecha_estimada`;


ALTER TABLE `systemmy_tallerhp`.`historial_vehiculorefaccion` 
ADD COLUMN `id_userasigned` INT NULL AFTER `fecha_fin`;

ALTER TABLE `systemmy_tallerhp`.`historial_vehiculoservicio` 
ADD COLUMN `id_userasigned` INT NULL AFTER `fecha_fin`;

DELIMITER |
CREATE TRIGGER hist_serv AFTER INSERT ON vehiculo_servicio
  FOR EACH ROW BEGIN
    INSERT INTO historial_vehiculoservicio (id_vehiculoservicio,id_user,status,comentarios) values(NEW.id, null,NEW.status,'Inicial');
  END
|
DELIMITER ;

DELIMITER |
CREATE TRIGGER hist_refac AFTER INSERT ON vehiculo_refaccion
  FOR EACH ROW BEGIN
    INSERT INTO historial_vehiculorefaccion (id_vehiculorefaccion,id_user,status,comentarios) values(NEW.id, null,NEW.status,'Inicial');
  END
|
DELIMITER ;
--
-- 19 dic 2018
--agregar almacen

CREATE TABLE `systemmy_tallerhp`.`almacen_taller` (
  `id` INT NOT NULL,
  `id_taller` INT NULL,
  `nombre` VARCHAR(200) NULL,
  `ubicacion` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `created_date` TIMESTAMP NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_taller_almacentaller_dx`
    FOREIGN KEY (`id_taller`)
    REFERENCES `systemmy_tallerhp`.`taller` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);