


-- 18 enero 2018
ALTER TABLE `systemmy_tallerhp`.`proveedor` 
ADD COLUMN `banco` VARCHAR(45) NULL AFTER `created_date`,
ADD COLUMN `num_cta` VARCHAR(45) NULL AFTER `banco`,
ADD COLUMN `email` VARCHAR(200) NULL AFTER `num_cta`;



CREATE TABLE `personal` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `id_user` int(11) DEFAULT NULL,
   `id_taller` int(11) DEFAULT NULL,
   `nombre` varchar(200) DEFAULT NULL,
   `apellido_pat` varchar(100) DEFAULT NULL,
   `apellido_mat` varchar(100) DEFAULT NULL,
   `telefono` varchar(20) DEFAULT NULL,
   `calle` varchar(200) DEFAULT NULL,
   `num_int` varchar(45) DEFAULT NULL,
   `num_ext` varchar(45) DEFAULT NULL,
   `email` varchar(200) DEFAULT NULL,
   `cp` varchar(45) DEFAULT NULL,
   `colonia` varchar(100) DEFAULT NULL,
   `ciudad` varchar(100) DEFAULT NULL,
   `estado` varchar(100) DEFAULT NULL,
   `status` varchar(45) DEFAULT 'active',
   `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_date` timestamp NULL DEFAULT NULL,
   `deleted_date` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id`),
   KEY `id_userpersonal_dx_idx` (`id_user`),
   CONSTRAINT `id_userpersonal_dx` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8


 ALTER TABLE `systemmy_tallerhp`.`pedido` 
ENGINE = InnoDB ;
ALTER TABLE `systemmy_tallerhp`.`pedido_refaccion` 
ENGINE = InnoDB ;

INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Personal Ver', 'Personal', 'show');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Personal Borrar', 'Personal', 'personaldelete');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Personal Editar', 'Personal', 'edit');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Personal Alta', 'Personal', 'add');
INSERT INTO `systemmy_tallerhp`.`permiso` (`nombre`, `section`, `page`) VALUES ('Personal', 'Personal', 'index');
