


-- 18 enero 2018
ALTER TABLE `systemmy_tallerhp`.`proveedor` 
ADD COLUMN `banco` VARCHAR(45) NULL AFTER `created_date`,
ADD COLUMN `num_cta` VARCHAR(45) NULL AFTER `banco`,
ADD COLUMN `email` VARCHAR(200) NULL AFTER `num_cta`;
