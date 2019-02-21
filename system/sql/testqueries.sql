ALTER TABLE `systemmy_tallerhp`.`vehiculo` 
ADD COLUMN `status_vehiculo` VARCHAR(45) NULL DEFAULT 'Pendiente' AFTER `deleted_date`;


ALTER TABLE `systemmy_tallerhp`.`vehiculo` 
ADD COLUMN `fecha_firma` VARCHAR(45) NULL AFTER `status_vehiculo`;

ALTER TABLE `systemmy_tallerhp`.`historial_vehiculoservicio` 
CHANGE COLUMN `id_personal` `id_personal` INT(11) NULL DEFAULT NULL AFTER `id_user`;
