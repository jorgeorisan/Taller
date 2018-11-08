/***13102018****/
ALTER TABLE `systemmy_tallerhp`.`servicio` 
ADD COLUMN `paquete` INT NULL DEFAULT 0 AFTER `id_user`;

CREATE TABLE `systemmy_tallerhp`.`servicio_paquete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_servicio` INT NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `created_date` TIMESTAMP NULL DEFAULT current_timestamp,
  `deleted_date` TIMESTAMP NULL,
  PRIMARY KEY (`id`));

  
ALTER TABLE `systemmy_tallerhp`.`servicio_paquete` 
ADD CONSTRAINT `id_servicioserviciopaquete_dx`
  FOREIGN KEY (`id_servicio`)
  REFERENCES `systemmy_tallerhp`.`servicio` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `systemmy_tallerhp`.`servicio_paquete` 
ADD COLUMN `id_serviciopaquete` INT NULL AFTER `id`;


ALTER TABLE `systemmy_tallerhp`.`servicio_paquete` 
ADD CONSTRAINT `id_servpaquete`
  FOREIGN KEY (`id_serviciopaquete`)
  REFERENCES `systemmy_tallerhp`.`servicio` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Servicio Paquete', 'Catalogos', 'serviciopaquete');

UPDATE `systemmy_tallerhp`.`permiso` SET `page` = 'paquete' WHERE (`id` = '47');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Asignar Servicios Paquete', 'Catalogos', 'serviciopaquete');
/****22 10 2018 ****/

ALTER TABLE `systemmy_tallerhp`.`solicitud_refaccion` 
DROP FOREIGN KEY `id_refaccioncotizacionr_dx`;
ALTER TABLE `systemmy_tallerhp`.`solicitud_refaccion` 
DROP INDEX `id_refaccioncotizacion_dx_idx` ;
;

ALTER TABLE `systemmy_tallerhp`.`refaccion` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ;

CREATE TABLE `systemmy_tallerhp`.`imagenes_refaccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_refaccion` INT NULL,
  `nombre` TEXT NULL,
  `descripcion` TEXT NULL,
  `url` TEXT NULL,
  `status` VARCHAR(45) NULL DEFAULT 'active',
  `created_date` TIMESTAMP NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`));

ALTER TABLE `systemmy_tallerhp`.`imagenes_refaccion` 
ADD CONSTRAINT `id_refaccion_imagenesrefaccion_dx`
  FOREIGN KEY (`id_refaccion`)
  REFERENCES `systemmy_tallerhp`.`refaccion` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `systemmy_tallerhp`.`refaccion` 
ADD COLUMN `costo_aprox` VARCHAR(45) NULL AFTER `imagen_url`,
ADD COLUMN `costo_real` DOUBLE NULL AFTER `costo_aprox`;

ALTER TABLE `systemmy_tallerhp`.`imagenes_refaccion` 
ADD CONSTRAINT `id_refaccion_imagenesrefacc_dx`
  FOREIGN KEY (`id_refaccion`)
  REFERENCES `systemmy_tallerhp`.`refaccion` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `systemmy_tallerhp`.`imagenes_refaccion` 
ADD COLUMN `deleted_date` TIMESTAMP NULL AFTER `created_date`;


-- 30 10 2018  listo

ALTER TABLE `systemmy_tallerhp`.`vehiculo` 
ADD COLUMN `PolizaNum` VARCHAR(200) NULL AFTER `TarjetaCirc`,
ADD COLUMN `ReporteNum` VARCHAR(45) NULL AFTER `PolizaSeg`,
ADD COLUMN `siniestro` VARCHAR(150) NULL AFTER `ReporteNum`,
ADD COLUMN `deducible` VARCHAR(45) NULL AFTER `siniestro`;


-- 3 nov 2018
  ALTER TABLE `systemmy_tallerhp`.`vehiculo_servicio` 
ADD COLUMN `detalles` TEXT NULL AFTER `id_servicio`;

  ALTER TABLE `systemmy_tallerhp`.`vehiculo_refaccion` 
ADD COLUMN `detalles` TEXT NULL AFTER `id_refaccion`;

ALTER TABLE `systemmy_tallerhp`.`refaccion` 
ADD COLUMN `detalles` INT NULL DEFAULT 0 AFTER `costo_real`;

ALTER TABLE `systemmy_tallerhp`.`servicio` 
ADD COLUMN `detalles` INT NULL DEFAULT 0  AFTER `status`;

