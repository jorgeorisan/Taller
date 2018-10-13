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
