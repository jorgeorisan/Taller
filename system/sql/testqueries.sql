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