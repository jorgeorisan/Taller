INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Nomina Index', 'Nomina', 'index');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Nomina Alta', 'Nomina', 'add');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Nomina Ver', 'Nomina', 'view');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Nomina Editar', 'Nomina', 'edit');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Nomina Borrar', 'Nomina', 'nominadelete');


CREATE TABLE `nomina` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `id_user` int(11) DEFAULT NULL,
   `id_taller` int(11) DEFAULT NULL,
   `nombre` varchar(200) DEFAULT NULL,
   `total` double DEFAULT NULL,
   `status` varchar(45) DEFAULT 'active',
   `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_date` timestamp NULL DEFAULT NULL,
   `comentarios` text,
   `fecha_inicial` timestamp NULL DEFAULT NULL,
   `fecha_final` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id`),
   KEY `id_taller_nomina_dx` (`id_taller`),
   CONSTRAINT `id_taller_nomina_dx` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1


  
 CREATE TABLE `nomina_personal` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `id_personal` int(11) DEFAULT NULL,
   `id_nomina` int(11) DEFAULT NULL,
   `status` varchar(45) DEFAULT 'active',
   `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `deleted_date` timestamp NULL DEFAULT NULL,
   `updated_date` timestamp NULL DEFAULT NULL,
   `cantidad` double DEFAULT 1,
   `total` double DEFAULT NULL,
   `detalles` text DEFAULT NULL,
   PRIMARY KEY (`id`),
   KEY `id_personal_nominapersonal_dx` (`id_personal`),
   KEY `id_nomina_nominapersonal_dx` (`id_nomina`),
   CONSTRAINT `id_personal_nominapersonal_dx` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
   CONSTRAINT `id_nomina_nominapersonal_dx` FOREIGN KEY (`id_nomina`) REFERENCES `nomina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1
 

 ALTER TABLE `systemmy_tallerhp`.`nomina_personal` 
ADD COLUMN `fecha` TIMESTAMP NULL AFTER `total`;



ALTER TABLE `systemmy_tallerhp`.`nomina_personal` 
ADD COLUMN `id_vehiculo` INT NULL AFTER `id_nomina`;
ALTER TABLE `systemmy_tallerhp`.`nomina_personal` 
ADD CONSTRAINT `id_vehiculo_nominapersonal_dx`
  FOREIGN KEY (`id_vehiculo`)
  REFERENCES `systemmy_tallerhp`.`vehiculo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `systemmy_tallerhp`.`nomina` 
ADD COLUMN `available` INT NULL DEFAULT 1 AFTER `fecha_final`;
