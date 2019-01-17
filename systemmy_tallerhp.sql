-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-01-2019 a las 13:43:39
-- Versión del servidor: 5.6.41
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `systemmy_tallerhp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id` int(11) NOT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `id_taller`, `nombre`, `ubicacion`, `status`, `created_date`) VALUES
(1, 1, 'almacen1', 'asas', 'active', '2019-01-04 07:09:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aseguradora`
--

CREATE TABLE `aseguradora` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `calle` varchar(200) DEFAULT NULL,
  `num_int` varchar(45) DEFAULT NULL,
  `num_ext` varchar(45) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `cp` varchar(45) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `url` text,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aseguradora`
--

INSERT INTO `aseguradora` (`id`, `nombre`, `telefono`, `calle`, `num_int`, `num_ext`, `email`, `cp`, `colonia`, `ciudad`, `estado`, `url`, `status`, `created_date`) VALUES
(1, 'No asignada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2018-09-20 20:26:56'),
(2, 'ABA SEGUROS, S.A. DE C.V.', '0181-8368-1400', 'Montes Rocallos', '505', 'lm', '', '66260', 'Residencial San Agustin', 'Monterrey', 'Nuevo Le?n', 'abaseguros.com', 'active', '2016-09-21 09:34:30'),
(3, 'AIG SEGUROS MÃ‰XICO, S.A. DE C.V.', '5488-4700', 'Insurgentes Sur', '1136', '', '', '3219', 'Col. Del Valle', 'MÃ©xico', 'Distrito Federal', 'aig.com.mx', 'active', '2017-02-11 20:08:01'),
(4, 'ALLIANZ MEXICO S.A. COMPAÃ‘ÃA DE SEGUROS', '5201-3000', 'Blvd. Manuel Ãvila Camacho', '164', '', '', '11010', 'Lomas de Barrilaco', 'MÃ©xico', 'Distrito Federal', 'allianz.com.mx', 'active', '2017-02-11 20:09:18'),
(5, 'ASEGURADORA INTERACCIONES, S.A', '5326-8600', 'Reforma ', '383', 'Piso 5 y 6', '', '6500', 'Cuauht?moc', 'M?xico', 'Distrito Federal', 'interacciones.com', 'active', '2016-09-05 15:22:00'),
(6, 'ASEGURADORA PATRIMONIAL DA?OS, S.A.', '5249-8660', 'Horacio', '340', 'Piso 9', '', '11570', 'Chapultepec Morales', 'M?xico', 'Distrito Federal', 'apatrimonial.com.mx', 'active', '2016-09-05 15:22:00'),
(7, 'ASEGURADORA PATRIMONIAL VIDA, S.A. de C.V.', '4161-9550', 'Arist?teles', '77', 'Piso 1 Despado 104', '', '11550', 'Polanco Reforma', 'MÃ©xico', 'Distrito Federal', 'apvida.mx', 'active', '2017-02-11 20:23:27'),
(8, 'ASERTA SEGUROS S.A. DE C.V.', '5449-3490', 'Perif?rico Sur', '4829', 'Piso 9', '', '14010', 'Parques del Pedregal', 'M?xico', 'Distrito Federal', 'asertavida.com.mx', 'active', '2016-09-05 15:22:00'),
(9, 'ASSURANT VIDA M?XICO, S.A.', '5000-1800', 'Insurgentes Sur', '2453', 'Piso 3 Oficina 301', '', '1090', 'Tizapan', 'M?xico', 'Distrito Federal', 'assurantsolutions.com', 'active', '2016-09-05 15:22:00'),
(10, 'ATRADIUS SEGUROS DE CR?DITO, S.A.', '5484-0000', 'Miguel Angel De Quevedo', '696', '', '', '3100', 'Del Valle', 'M?xico', 'Distrito Federal', 'atradius.com.mx', 'active', '2016-09-05 15:22:00'),
(11, 'AXA SEGUROS, S.A. de C.V.', '5169-1000', 'Xola', '535', 'Piso 27', '', '3100', 'Del Valle', 'M?xico', 'Distrito Federal', 'axa.mx', 'active', '2016-09-05 15:22:00'),
(12, 'SEGUROS BBVA BANCOMER, S.A. DE C.V.', '9171-4166', 'Montes Urales', '424', 'Piso 1', '', '11000', 'Lomas de Chapultepec', 'M?xico', 'Distrito Federal', 'segurosbancomer.com.mx', 'active', '2016-09-05 15:22:00'),
(13, 'BUPA M?XICO SEGUROS, S.A. DE C.V.', '5202-1701', 'Manuel Avila Camacho', '88', 'Piso 5 Torre Picasso', '', '11000', 'Lomas de Chapultepec', 'M?xico', 'Distrito Federal', 'bupa.com.mx', 'active', '2016-09-05 15:22:00'),
(14, 'CARDIF M?XICO SEGUROS DE VIDA, S.A. DE C.V.', '2282-2000', 'Paseo de las Palmas', '425', 'Piso 5', '', '11000', 'Lomas de Chapultepec', 'M?xico', 'Distrito Federal', 'cardif.com.mx', 'active', '2016-09-05 15:22:00'),
(15, 'CHUBB DE M?XICO COMPA??A DE SEGUROS, S.A. DE C.V.', '5081-5600', 'Santa Fe', '505', 'Piso 17', '', '5349', 'Cruz Manca', 'M?xico', 'Distrito Federal', 'chubb.com', 'active', '2016-09-05 15:22:00'),
(16, 'EL ?GUILA COMPA??A DE SEGUROS, S.A. DE C.V.', '5488-8888', 'Insurgentes Sur', '1106', 'Piso 1', '', '3200', 'Tlacoquemecatl', 'M?xico', 'Distrito Federal', 'elaguila.com.mx', 'active', '2016-09-05 15:22:00'),
(17, 'FM GLOBAL DE M?XICO, S.A. de C.V.', '0181-8262-4700', 'D?as Ordaz', '140', 'PH 1', '', '64650', 'Santa Mar?a', 'Monterrey', 'Nuevo Le?n', 'fmglobal.com', 'active', '2016-09-05 15:22:00'),
(18, 'GENERAL DE SEGUROS, S.A.B.', '5278-8000', 'Patriotismo', '266', '', '', '3800', 'San Pedro de los Pinos', 'M?xico', 'Distrito Federal', 'generaldeseguros.mx', 'active', '2016-09-05 15:22:00'),
(19, 'GRUPO MEXICANO DE SEGUROS, S.A. DE C.V.', '5480-4000', 'Insurgentes Sur', '1605', 'Piso 25', '', '3900', 'San Jos? Insurgentes', 'M?xico', 'Distrito Federal', 'gmx.com.mx', 'active', '2016-09-05 15:22:00'),
(20, 'GRUPO NACIONAL PROVINCIAL, S.A.B.', '5227-3900', 'Cerro de las Torres', '395', '', '', '4200', 'Campestre Churubusco', 'M?xico', 'Distrito Federal', 'gnp.com.mx', 'active', '2016-09-05 15:22:00'),
(21, 'HANNOVER SERVICES M?XICO S.A DE C.V.', '9140-0800', 'Av. Santa Fe', '170', 'Ofic-4-4-28', '', '1210', 'Lomas de Santa Fe', 'Alvaro Obreg?n', 'Distrito Federal', 'hannover-re.com', 'active', '2016-09-05 15:22:00'),
(22, 'HDI GERLING DE M?XICO SEGUROS, S.A.', '5202-7534', 'Av. Paseos de las Palmas', '239', 'Despacho 104', '', '11000', 'Lomas de Chapultepec', 'Miguel Hidalgo', 'Distrito Federal', 'hdi-gerling.com.mx', 'active', '2016-09-05 15:22:00'),
(23, 'HIR COMPA??A DE SEGUROS, S.A. DE C.V.', '5262-1782', 'R?o Marne', '24', '', '', '6500', 'Cuauht?moc', 'M?xico', 'Distrito Federal', 'hirseguros.com', 'active', '2016-09-05 15:22:00'),
(24, 'HSBC SEGUROS, S.A. DE C.V.', '5721-2222', 'Paseo de la Reforma', '347', 'Piso 6', '', '6500', 'Cuauht?moc', 'M?xico', 'Distrito Federal', 'hsbc.com.mx', 'active', '2016-09-05 15:22:00'),
(25, 'LA LATINOAMERICANA SEGUROS, S.A.', '5130-2800', 'Eje Central Lazaro C?rdenas', '2', 'Piso 8', '', '6007', 'Centro', 'M?xico', 'Distrito Federal', 'lalatino.com.mx', 'active', '2016-09-05 15:22:00'),
(26, 'MAPFRE TEPEYAC S.A.', '5230-7000', 'Av. Paseo de la Reforma', '243', '', '', '6500', 'Cuauht?moc', 'M?xico', 'Distrito Federal', 'mapfre.com.mx', 'active', '2016-09-05 15:22:00'),
(27, 'METLIFE M?XICO, S.A.', '5328-7000', 'Manuel Avila Camacho', '32', '', '', '11000', 'Lomas de Chapultepec', 'M?xico', 'Distrito Federal', 'metlife.com.mx', 'active', '2016-09-05 15:22:00'),
(28, 'PRINCIPAL SEGUROS, S.A. DE C.V.', '5279-7900', 'Campos El?seos', '345', 'Piso 12', '', '11560', 'Chapultepec Polanco', 'M?xico', 'Distrito Federal', 'principal.com.mx', 'active', '2016-09-05 15:22:00'),
(29, 'QUÃLITAS COMPAÃ‘ÃA DE SEGUROS, S.A. DE C.V.', '5481-8500', 'Av. Sn JerÃ³nimo', '478', '', 'igasca@qualitas.com.mx', '1900', 'JardÃ­nes del Pedregal', 'MÃ©xico', 'Distrito Federal', 'http://www.qualitas.com.mx', 'active', '2017-10-22 22:44:54'),
(30, 'SEGUROS AFIRME, S.A.', '0181-8318-3900', 'Ocampo', '220', '', '', '64000', 'Zona Centro', 'Monterrey', 'Nuevo Le?n', 'afirme.com.mx', 'active', '2016-09-05 15:22:00'),
(31, 'SEGUROS ARGOS, S.A. DE C.V.', '1500-1600', 'Tecoyotitla', '412', '', '', '1050', 'Ex hacienda de Guadalupe ', 'Alvaro Obreg?n', 'Distrito Federal', 'segurosargos.com', 'active', '2016-09-05 15:22:00'),
(32, 'SEGUROS ATLAS, S.A.', '9177-5000', 'Paseo de los Tamarindos', '60', 'P.B.', '', '5120', 'Bosques de las Lomas', 'M?xico', 'Distrito Federal', 'segurosatlas.com.mx', 'active', '2016-09-05 15:22:00'),
(33, 'SEGUROS AZTECA, S.A. DE C.V.', '1720-7000', 'Insurgentes Sur', '3579', 'Torre III, Piso 1', '', '14000', 'La Joya Tlalpan', 'M?xico', 'Distrito Federal', 'segurosazteca.com.mx', 'active', '2016-09-05 15:22:00'),
(34, 'SEGUROS BANAMEX, S.A. DE C.V.', '1226-8100', 'Venustiano Carranza', '63', 'Anexo Piso 2', '', '6000', 'Centro', 'M?xico', 'Distrito Federal', 'segurosbanamex.com', 'active', '2016-09-05 15:22:00'),
(35, 'SEGUROS BANORTE', '2454-6146', 'chicontepec', '63', 'Piso 5', '', '6170', 'Hip?dromo Condesa', 'M?xico', 'Distrito Federal', 'segurosbanorte.com.mx', 'active', '2016-09-05 15:22:00'),
(36, 'SEGUROS INBURSA, S.A.', '5625-4900', 'Insurgentes Sur', '3500', '', '', '14060', 'Pe?a Pobre', 'M?xico', 'Distrito Federal', 'inbursa.com', 'active', '2016-09-05 15:22:00'),
(37, 'SEGUROS MONTERREY NEW YORK LIFE, S.A. DE C.V.', '5326-9000', 'Reforma ', '342', 'Piso 20', '', '6600', 'Ju?rez', 'Cuauht?moc', 'Distrito Federal', 'mnyl.com.mx', 'active', '2016-09-05 15:22:00'),
(38, 'ZURICH COMPAÃ‘ÃA DE SEGUROS', '5284-1001', 'Ejecito Nacional', '843', 'B', '', '11520', 'Granada', 'Miguel Hidalgo', 'Distrito Federal', 'zurich.com.mx', 'active', '2017-02-11 20:04:39'),
(39, 'SEGUROS MULTIVA, S.A. GRUPO FINANCIERO MULTIVA', '5284-6200', 'Cerrada Tecamachalco', '45', '', '', '11650', 'Reforma Social', 'Miguel Hidalgo', 'Distrito Federal', 'multivaseguros.com', 'active', '2016-09-05 15:22:00'),
(40, 'ANA COMPAÃ‘ÃA DE SEGUROS, S.A. DE C.V.', '5322-8200', 'Insurgentes Sur', '1685', 'Piso 15 y P.B.', '', '1020', 'Guadalupe Inn', 'MÃ©xico', 'Distrito Federal', 'anaseguros.com.mx', 'active', '2017-02-11 20:06:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
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
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `id_user`, `id_taller`, `nombre`, `apellido_pat`, `apellido_mat`, `telefono`, `calle`, `num_int`, `num_ext`, `email`, `cp`, `colonia`, `ciudad`, `estado`, `status`, `created_date`, `updated_date`, `deleted_date`) VALUES
(6, NULL, 2, 'Anibal Leonel HernÃ¡ndez de LeÃ³n ', NULL, NULL, '552727-5967', 'EfrÃ©n reboyedo', '', '118', 'valuacion@mastreta.com.mx', '6830', 'Obrera ', 'Cdmx', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(7, NULL, 2, 'Aliacia Landin Castellanos ', NULL, NULL, '553555-8658', 'Antoni Caso ', '201', '2', 'valuacion@mastreta.com.mx', '6820', 'San Rafael ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(8, NULL, 2, 'Raul Bautista Morales ', NULL, NULL, '551354-4566', 'Calle 13 ', '19', '', 'valuacion@mastreta.com.mx', '0', 'Maravillas', '', 'Nezahualcoyotl ', 'active', '2018-09-03 06:12:57', NULL, NULL),
(10, NULL, 2, 'Juan Carlos Elton ', NULL, NULL, '552133-8595', 'Callejon San Antonio Abad', '35', '', 'valuacion@mastreta.com.mx', '6820', 'Transito ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(13, NULL, 2, 'Gerardo MalagÃ³n Almanza', NULL, NULL, '', 'Donato Guerra', '507', '1', 'gerardo.malagon@geohti.com', '6600', 'JuÃ¡rez', 'MÃ©xico', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(15, NULL, 2, 'Gerardo Hernandez de la Torre ', NULL, NULL, '', 'Newton ', '105', '303', 'valuacion@mastreta.com.mx', '6820', 'Polanco ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(25, NULL, 2, 'Edgar Alejandro SÃ¡nchez Marquez', NULL, NULL, '', 'Donato Guerra', '507', '1', 'gerardo.malagon@geohti.com', '6600', 'JuÃ¡rez', 'MÃ©xico', 'Ciudad de MÃ©xico', 'active', '2018-09-03 06:12:57', NULL, NULL),
(35, NULL, 2, 'Javier PiÃ±a Lopez', NULL, NULL, '554903-8120', 'Pino Suarez ', '', '2', 'gerardo.malagon@geohti.com', '6820', 'Centro ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(36, NULL, 2, 'Blanca Flores Infante ', NULL, NULL, '552133-8595', 'Reforma ', '', '211', 'j.elton@live.com.mx', '0', 'Cuauhtemoc ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(37, NULL, 2, 'Gabriela Mejia Cortes ', NULL, NULL, '551003-4602', 'Sur 99 ', '', '3', 'valuacion@mastreta.com.mx', '0', 'Viaducto Piedad ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(38, NULL, 2, 'Alejandro Donat Vergara ', NULL, NULL, '4986-7419', 'Cairo ', '4', '', 'j.elton@live.com.mx', '0', 'Claveria ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(39, NULL, 2, 'Susana JazmÃ­n Ibarra Martinez ', NULL, NULL, '5576-6664-22 y 70446', 'Cajeme ', '5', '', 'refaccioneskatia@gmail.com', '15590', 'Alavaro Obregon ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(40, NULL, 2, 'Celina Juarez ', NULL, NULL, '5591-063497  y 5756-', 'Priv. Barrio ', '14', '', 'j.elton@live.com.mx', '0', 'Cuchilla Plantitlan  ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(41, NULL, 2, 'Gustavo Sotelo PiÃ±a ', NULL, NULL, '5695-9956 y 552563-5', 'Calxada de la Virgen ', 'Edificio 207', '204', 'gsotelo941987@gmail.com', '4480', 'CTM Culhuacan ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(42, NULL, 2, 'Javier Sanchez Becerra', NULL, NULL, '5585-803939', '7 cda. Av 553', '3', '', 'j.elton@live.com.mx', '0', 'San Juan de Aragon ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(43, NULL, 2, 'Javier Eduardo Reyes Miranda ', NULL, NULL, '5549-047691', 'Tlaxcoaque ', '8', '', 'jreyesmira@gmail.com', '6000', 'Centro ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(44, NULL, 2, 'Torres Garcia Abraham ', NULL, NULL, '558096-4604 y 553975', 'Lerdo ', '322', '', 'manigoldo.m.a@gmail.com', '6250', 'San Simon Tolnahuac ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(45, NULL, 2, 'Oscar Enrique Carrera ', NULL, NULL, '5553-0784', 'Francisco Marquez', '161', '2', 'j.elton@live.com.mx', '6420', 'Roma ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(46, NULL, 2, 'JosÃ© Halim Aguilar Cruz', NULL, NULL, '552645-5070 ', 'Agustin delgado ', '68', 'E 101', 'emasuma@hotmail.com', '6820', 'Transito ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(47, NULL, 2, 'Israel Ortega Garcia ', NULL, NULL, '5543-450012', 'Doctor Erazo ', '40', '', 'garciaiortega@yahoo.com.mx', '0', 'Doctores ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(48, NULL, 2, 'MartÃ­n Juarez Serna', NULL, NULL, '5123-0752 y 556013-2', 'Lorenzo Boturini', '2', '202', 'mars.mjs@gmail.com', '6820', 'Transito', 'CDMX', 'Cuauhtemoc', 'active', '2018-09-03 06:12:57', NULL, NULL),
(49, NULL, 2, 'JesÃºs Antonio Linares Vega ', NULL, NULL, '551304-0724 y 552324', 'Mariano Escobedo ', '', '476', 'alinaresvega@hotmail.com', '0', 'Anzures ', 'CDMX', 'Miguel Hidalgo ', 'active', '2018-09-03 06:12:57', NULL, NULL),
(50, NULL, 2, 'Jorge Lopez Guzman', NULL, NULL, '5518-026570', '', '', '', '', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(51, NULL, 2, 'OSCA RAMIREZ CUELLAR', NULL, NULL, '553720-4781 ', 'MATIAS ROMERO ', '', '173', '', '3630', 'LETRAN VALLE ', 'CDMX', 'BENITO JUAREZ ', 'active', '2018-09-03 06:12:57', NULL, NULL),
(52, NULL, 2, 'OSCA RAMIREZ CUELLAR', NULL, NULL, '553720-4781 ', 'MATIAS ROMERO ', '', '173', '', '3630', 'LETRAN VALLE ', 'CDMX', 'BENITO JUAREZ ', 'active', '2018-09-03 06:12:57', NULL, NULL),
(53, NULL, 2, 'RICARDO JOB LOPEZ CASTELLANOS ', NULL, NULL, '5554-316194', 'GOMEZ PALACIOS ', '', '144', 'ricardo_job@hotmail.com', '6170', 'HIPODROMO CONDESA ', 'CDMX', 'Cuauhtemoc', 'active', '2018-09-03 06:12:57', NULL, NULL),
(54, NULL, 2, 'RICARDO JOB LOPEZ CASTELLANOS ', NULL, NULL, '5554-316194', 'GOMEZ PALACIOS ', '', '144', 'ricardo_job@hotmail.com', '6170', 'HIPODROMO CONDESA ', 'CDMX', 'Cuauhtemoc', 'active', '2018-09-03 06:12:57', NULL, NULL),
(55, NULL, 2, 'Miguel Angel Camarillo CalderÃ³n ', NULL, NULL, '5574-2450  y 551606-', 'Av. Cuautemoc ', '255', '', 'camarillomiguelangel@yahoo.com.mx', '6700', 'Roma ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(56, NULL, 2, 'Francisco Salinas Solis ', NULL, NULL, '5536-736054', 'Cecilio Robelo ', '9', '', 'j.elton@live.com.mx', '15590', 'AeronÃ¡utica Militar ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(57, NULL, 2, 'Felipe Jimenez', NULL, NULL, '5555884938', 'Reforma', '34', '222', 'valuacion@mastreta.com@mx', '11024', 'Cuauhtemoc ', 'Mexico', 'Cdmx', 'active', '2018-09-03 06:12:57', NULL, NULL),
(58, NULL, 2, 'Christian Enrique Melo Canacasco ', NULL, NULL, '552709-9728', 'Ing. Civiles', 'Mz. 16 Lt. 20 ', '', 'cmelo@qualitas.com.mx', '9420', 'Nueva Rosita ', 'CDMX', 'Iztapalapa ', 'active', '2018-09-03 06:12:57', NULL, NULL),
(59, NULL, 2, 'Eduardo Monrreal Montanvo ', NULL, NULL, '553273-2407', 'Cda. de Mazatlan ', '', '14', 'dr_emonreal51@hotmail.com', '6140', 'Condesa ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(60, NULL, 2, 'Rafael Arana Gonzalez', NULL, NULL, '5521338595', 'Xocongo', '', '45', 'j.elton@live.com.mx', '0', 'TrÃ nsito', 'MÃ¨xico', 'mexico D.f.', 'active', '2018-09-03 06:12:57', NULL, NULL),
(61, NULL, 2, 'Arturo Martinez Arimas', NULL, NULL, '55442-1605 , 557517-', 'Pradros  de Cedros ', 'MZ 11', 'LT 9AZ', 'j.elton@live.com.mx', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(62, NULL, 2, 'ANTONIO GUILLERMO ALCANTARA INIESTA', NULL, NULL, '5562566790', 'C. GALICIA ', '0', '123', 'gerencia@mastreta.com.mx', '0', 'ALAMOS', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(63, NULL, 2, 'Jose Barquet', NULL, NULL, '5554359093', 'Republica de Chile #49-C', '', '', 'edgar.reyes@geohti.com', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(64, NULL, 2, 'Ricardo Torres Tezanos', NULL, NULL, '25989770-5520884040', 'Norte 33 ', '', '57', 'richmond.t@hotmail.com', '0', 'Moctezuma 2Âª secciÃ²n', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(65, NULL, 2, 'ALEJANDRO DONAT VERGARA ', NULL, NULL, '5549865419', 'HOMEX', '', '15', 'ivazquez@mastreta.com.mx', '0', 'HOGARES MEXICANOS', 'ECATEPEC', 'EDO MEX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(66, NULL, 2, 'ALEJANDRO DONAT VERGARA ', NULL, NULL, '5549865419', 'HOMEX', '', '15', 'ivazquez@mastreta.com.mx', '0', 'HOGARES MEXICANOS', 'ECATEPEC', 'EDO MEX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(67, NULL, 2, 'Samantha Sanchez  SaldaÃ±a', NULL, NULL, '85828610 EXT. 8110', 'Ferrrocarril de Cuernavaca ', '', '13', 'ssaldaÃ±a443@gmail.com', '0', 'Carola', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(68, NULL, 2, 'Samantha Sanchez  SaldaÃ±a', NULL, NULL, '85828610 EXT. 8110', 'Ferrrocarril de Cuernavaca ', '', '13', 'ssaldaÃ±a443@gmail.com', '0', 'Carola', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(69, NULL, 2, 'Samantha Sanchez  SaldaÃ±a', NULL, NULL, '85828610 EXT. 8110', 'Ferrrocarril de Cuernavaca ', '', '13', 'ssaldaÃ±a443@gmail.com', '0', 'Carola', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(70, NULL, 2, 'Samantha Sanchez  SaldaÃ±a', NULL, NULL, '85828610 EXT. 8110', 'Ferrrocarril de Cuernavaca ', '', '13', 'ssaldaÃ±a443@gmail.com', '0', 'Carola', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(71, NULL, 2, 'Edna Tonantzin MejÃ­a Cervantes ', NULL, NULL, '69940980-5549466909', 'Doctor Navarro ', '', '60', '', '0', 'Doctores ', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(74, NULL, 2, 'Eduardo Vega Jimenez', NULL, NULL, '5541792724', 'Enrique Gonzales MartÃ¬nez', '', '264', 'borjaflaco@live.com.mx', '0', 'Santa MarÃ¬a Rivera', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(75, NULL, 2, 'RAUL SANCHEZ SALAZAR', NULL, NULL, '5515100699', 'DOCTOR LAVISTA', '', '139', 'nsophia10@live.com.mx', '0', 'DOCTORES', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(76, NULL, 2, 'JORGE MAURICIO ALVARADO LOPEZ', NULL, NULL, '5534617374', '', '', '', 'nsophia10@live.com.mx', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(77, NULL, 2, 'ARMANDO RIOS SANCHEZ', NULL, NULL, '5536483668', 'XOCONGO', '', '58', 'nsophia10@live.com.mx', '0', 'TRANSITO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(78, NULL, 2, 'SERGIO SANCHEZ TORRES', NULL, NULL, '5543015271', 'NEZAHUALCOYOLT ', '', 'S/N', 'nsophia10@live.com.mx', '0', 'TEPLETAHUCA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(79, NULL, 2, 'Irma  Rodriguez Conde', NULL, NULL, '5528194936', 'Tzinal  ', '', '169 ', 'conde irma@gmail.com', '0', ' Heroes de Padierna', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(80, NULL, 2, 'Gustavo Garcia Garcia', NULL, NULL, '5546-042807', 'Organo ', '', '31', 'mixcalco13pajaro@gmail.com', '6010', 'Centro ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(81, NULL, 2, 'Jose de Jesus Ramos Coronel', NULL, NULL, '', 'Marina Nacional', '', '200', 'nsophia10@live.com.mx', '0', 'Anahuatl', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(82, NULL, 2, 'DAVID SHIVER MEMUN', NULL, NULL, '18019353', 'BOSQUE DE REFORMA ', '', '1477', 'refacciones@mastreta.com.mx', '0', 'CUAJIMALPA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(83, NULL, 2, 'NELLY VARGAS GUTIERREZ', NULL, NULL, '5518834186', 'AV. DEL TALLER', '', '37', 'valuacion@mastreta.com.mx', '0', 'JARDIN BALO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(84, NULL, 2, 'RICARDO RODRIGUEZ HERNANDEZ', NULL, NULL, '5513199240', 'MASSENET ', '', '125', 'richyrh@gmail.com', '0', 'PERALVILLO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(85, NULL, 2, 'GUMERSINTO DOMINGUEZ BARRIOS', NULL, NULL, '4771839275', 'CICERÃ’N ', '', '501', 'nsophia10live.com.mx', '0', 'MIGUEL HIDALG0', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(86, NULL, 2, 'DAVID MIRZOYAN', NULL, NULL, '5510071512', 'AV. JOSE VASCONSELOS', '', '204', 'j.elton@live.com.mx', '0', 'HIPODROMO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(87, NULL, 2, 'AGUSTÃŒN ESCORCIA LOZOYA', NULL, NULL, '5513852516', 'MANUEL NICOLAS CORPANCHO', '', '365', 'nsophia10live.com.mx', '0', 'LORENZO BOTURINI', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(88, NULL, 2, 'DIEGO MONTESSORO JIMENEZ', NULL, NULL, '5585803939', 'SEPTIMA AVENIDA', '3', '553', 'refacciones@mastreta.com.mx', '0', 'SAN JUAN DE ARAGÃ’N SEGUNDA SECCION', 'CDMX', 'EDO MEX.', 'active', '2018-09-03 06:12:57', NULL, NULL),
(89, NULL, 2, 'GUILLERMO JUAREZ RENDON', NULL, NULL, '5518444511', 'JUAN ESCUTIA', '', '122', 'valuacion@mastreta.com.mx', '0', 'AMERICAS', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(90, NULL, 2, 'OSCAR PALEN LOPEZ', NULL, NULL, '5522880404', 'PANAMA', '', '3', 'valuacion @mastreta.com.mx', '0', 'REFORMA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(91, NULL, 2, 'EDUARDO MONTERREAL MONTAVO', NULL, NULL, '5532732407', 'CERRADA DE MAZATLAN ', '', '14', 'valuacion@mastreta.com.mx', '0', 'CONDESA', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(92, NULL, 2, 'ANTONIO HUERTAS GOMEZ', NULL, NULL, '5533148657', 'LOMAS DEL SOL', '32-A', '33', 'valuacion@mastreta.com.mx', '0', 'LOMAS DE IZTAPALUCA', 'CDMX', 'EDO. DE MEX.', 'active', '2018-09-03 06:12:57', NULL, NULL),
(93, NULL, 2, 'ISRAEL IBAÃ‘EZ RAZO', NULL, NULL, '7221084768', 'JOSE MARIA MORELOS ', '', '206', 'valuacion@mastreta.com.mx', '0', 'ACANTEPEC', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(94, NULL, 2, 'ISAAC GASCA', NULL, NULL, '', '', '', '', 'valuacion@mastreta.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(95, NULL, 2, 'ROXANA RAMIREZ TORRES', NULL, NULL, '5525047398', 'AV. DEL TALLER ', '', '109', 'valuacion@mastreta.com.mx', '0', 'JARDIN BALBUENA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(96, NULL, 2, 'JOSE LUIS MENDOZA GAITAN', NULL, NULL, '86368718', '', '', '', 'valuacion@mastreta.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(97, NULL, 2, 'CLEMENTE MARTIN FLORES PASTEN', NULL, NULL, '5573775707', 'PROSPERO GARCIA', '', '108', 'valuacion@mastreta.com.mx', '0', 'SANTA MARIA TOMATLAN', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(98, NULL, 2, 'Miguel  Gonzalez Zenil ', NULL, NULL, '558538-6181', 'Ret 35 de Cecilio Robelo', '54', '', 'jmgzenil@gmail.com', '15900', 'Jardin Balbuena ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(99, NULL, 2, 'ROGELIO PEREZ ESQUIVEL', NULL, NULL, '5567750531', 'PRIMERA PRIVADA DEL FORRAJE', '', '106', 'valuacion@mastreta.com.mx', '0', 'RANCHO DON ANTONIO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(100, NULL, 2, 'MARCO ANTONIO GARCIA OLIVAR', NULL, NULL, '5532061220', 'AV. DEL ROSAL ', '', ' 502', 'valuacion@mastreta.com.mx', '0', 'LOS ANGELES ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(101, NULL, 7, 'ARMANDO JULIO SANCHEZ SANCHEZ ', NULL, NULL, '5535271050', 'AV. SANTA LUCIA ', '', '810', 'valuacion@mastreta.com.mx', '0', 'VICTOR RICO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(102, NULL, 2, 'JESUS SANCHEZ BRISEÃ‘O', NULL, NULL, '5537072303', 'AV. 2', '', '26', 'jesusk2701@gmail.com', '0', 'SAN PEDRO DE LOS PINOS', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(103, NULL, 2, 'OSCAR BRAYAN VAZQUEZ ESCALONA', NULL, NULL, '5577610034', 'DELICIAS', '5', '66', 'gerardo_escalona@hotmail.com', '0', 'CENTRO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(104, NULL, 2, 'LUIS ALFREDO PEREZ ROMERO', NULL, NULL, '5554338127', 'CHAPARRITA', '5', '6', 'nsophia10@live.com.mx', '0', 'VICENTE VILLEGA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(105, NULL, 2, 'JUAN MANUEL SOLIS LOPEZ', NULL, NULL, '5510092769', 'CALLEJON SAN ANTONIO ABAD', '', '35', 'manuelsolisl55@gmail.com', '0', 'TRANSITO', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(106, NULL, 2, 'ALMA OLIVIA VELAZCO GONZALEZ', NULL, NULL, '5527490997', 'ANTILLAS ', '204', '906', 'valuacion@mastreta.com.mx', '0', 'PORTALES', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(107, NULL, 2, 'RAMON HERNANDEZ BONILLA', NULL, NULL, '5530801671', '3CDA  DE OYAMEL', '', '10', '', '10360', 'EL ERMITAÃ‘O', 'LA MAGDALENA CONTRERAS', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(108, NULL, 2, 'ALEJANDRO GONZALEZ TRUJANO', NULL, NULL, '', '', '', '', 'valuacion@mastreta.com.mx', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(109, NULL, 2, 'CESAR BECERRIL CASASOLA', NULL, NULL, '5527754781', 'SAN ANTONIO ABAD ', '', '22', 'valuacion@mastreta.com.mx', '0', '', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(110, NULL, 2, 'OTHON JOSE ALONSO DIAZ', NULL, NULL, '5551564031', 'RAMON Y CAJAL', '', '39', 'othon173@hotmail.com', '0', 'MODERNA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(111, NULL, 2, 'LAURA ELENA MARTINEZ CHAVEZ', NULL, NULL, '5537178732', 'RETORNO 2', '8', '130', 'nsophia10@live.com.mx', '0', 'AV DEL TALLER', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(112, NULL, 2, 'MIGUEL ANGEL GALINDO CRUZ', NULL, NULL, '5513571354', '', '', '', 'nsophia10@live.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(113, NULL, 2, 'JORGE HERNANDEZ FRANCO', NULL, NULL, '5540641371', 'MOSQUETA', '6-A', '504', 'nsophia10@live.com.mx', '0', 'GUERRERO', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(114, NULL, 2, 'ERNESTO MARTINEZ VARGAS', NULL, NULL, '5577800088', 'XOCONGO', '', '531', 'valuacion@mastreta.com.mx', '0', 'TRANSITO', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(115, NULL, 2, 'MARCO ANTONIO NOVOA FIESCO', NULL, NULL, '5532651538', 'SUR 109', '', '118', 'nsophia10@live.com.mx', '0', 'AERONAUTICA MILITAR', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(116, NULL, 2, 'ALFREDO ZARATE PADILLA', NULL, NULL, '5525171989', 'CALLE JM ORTIZ', '', 'MZ. 16 LT.15', 'azartap@hotmail.com', '0', 'AMPLIACION CIUDAD LAGO', 'CDMX', 'EDO. DE MEX.', 'active', '2018-09-03 06:12:57', NULL, NULL),
(117, NULL, 2, 'AGUSTIN LOPEZ TAPIA', NULL, NULL, '5570500511', 'SUR 103', '', 'S/N', 'acuariotapia1@gmail.com', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(118, NULL, 2, 'MARCOS ALTAMIRANO MORENO', NULL, NULL, '', '', '', '', 'nsophia10@live.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(119, NULL, 2, 'MARTHA GASCA RAMIREZ', NULL, NULL, '5534945693', 'NORTE 13', '', 'S/N', 'nsophia10@live.com.mx', '0', 'MOCTESUMA 2Âª SECCION', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(120, NULL, 2, 'RENE RAUL SANTIAGO ORTIZ', NULL, NULL, '5518025774', 'PLAZUELA 3 DE ANA LUCIA ', 'MZ 14', 'LT 48-A', 'resantiago.ortiz@gmail.com', '0', 'PLAZAS DE ARAGON', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(121, NULL, 2, 'ARTURO FONSECA CASTILLO', NULL, NULL, '5546406691', 'CANCUN', 'MZ 226', 'LT. 12 A', 'fonck@gmail.com', '0', 'HEROES DE PADIERNA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(122, NULL, 2, 'FRANCISCO JAVIER MARTINEZ MANI', NULL, NULL, '5522058394', 'GOMA', '', '128', 'valuacion@mastreta.com.mx', '0', 'GRANJAS MEXICO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(123, NULL, 2, 'ANGEL ORDONEZ HERNANDEZ', NULL, NULL, '5520825939', '', '', '', 'nsophia10@live.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(124, NULL, 2, 'MIGUEL ANGEL DIAZ MOLINA', NULL, NULL, '55977684', 'GONOD', '', '175', 'nsophia10@live.com.mx', '0', 'EXIPODROMO DE PALVILLO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(125, NULL, 2, 'JORGE ADRIAN RAMOS LARA', NULL, NULL, '5534867773', 'DOCTOR LUCIO', '5', '196', 'coatlecue1005@hotmail.com', '0', 'DOCTORES', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(126, NULL, 2, 'ADRIAN RIVERA RINCON', NULL, NULL, '5521093063', 'ENRIQUE GRANADOS', '', '58', 'valuacion@mastreta.com.mx', '0', 'ALGARIN', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(127, NULL, 2, 'JOSE LUIS TORRES NUÃ‘EZ', NULL, NULL, '5521979695', 'VALLE DE SIRE', '', '110', 'torresjoseluis091@gmail.com', '0', 'VALLE DE ARAGON 2ÂªSECCION', 'CDMX', 'EDO. DE MEXICO', 'active', '2018-09-03 06:12:57', NULL, NULL),
(128, NULL, 2, 'ARMANDO VALDEZ GUITIERREZ', NULL, NULL, '5549231953', 'RUFINO TAMAYO', '', '9', 'javaguia75@yahoo.com.mx', '0', 'INDECO SANTA CLARA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(129, NULL, 2, 'JOSE ENTONIO SANCHEZ MIRAVETLE', NULL, NULL, '5543563038', 'MINATILLAN', '', '5', 'amiravele@habilitaciones.com.mx', '0', 'ROMA SUR', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(130, NULL, 2, 'ARMANDO RODRIGUEZ LUNA', NULL, NULL, '5554356531', 'CARLOS PEREIRA', '', '57', 'carys68@hotmail.com', '0', 'VIADUCTO PIEDAD', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(131, NULL, 2, 'RAFAEL GARCIA RAMO', NULL, NULL, '554219525', 'GABRIEL HERNANDEZ', '', '56', 'valuacion@mastreta.com.mx', '0', 'Doctores ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(132, NULL, 2, 'AURELIO BUENO', NULL, NULL, '5544916571', '', '', '', '', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(133, NULL, 2, 'ALBERTO MORELOS OLVERA', NULL, NULL, '', '', '', '', 'mastreta@airbag.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(134, NULL, 2, 'ADRIAN SOLER HERNANDEZ', NULL, NULL, '5530201940', 'AV. CHAPULTEPEC', 'A-403', '273', 'mastreta@airbag.com.mx', '0', 'JUAREZ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(135, NULL, 2, 'GUILLERMO RODRIGUEZ PACHECO', NULL, NULL, '', '', '', '', 'mastreta@airbag.com.mx', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(136, NULL, 2, 'JUAN CARLOS AMARO CADENAS', NULL, NULL, '90185119', 'OMEGA', '', '', 'fabiancadena2000@yahoo.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(137, NULL, 2, 'SIGIFREDO SANCHEZ DELGADILLO', NULL, NULL, '53836995', 'UNIDAD HABITACIONAL', 'E-10', '', 'valuacion@mastreta.com.mx', '0', 'MIGUEL HIDALGO', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(138, NULL, 2, 'CARLOS ENRIQUE ALVAREZ REYES', NULL, NULL, '5560851364', 'AV. AZCAPOTZALCO', '', '731', 'mastreta@airbag.com.mx', '0', 'CASTILLA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(139, NULL, 2, 'ADRIÃN DÃAZ GARCÃA', NULL, NULL, '5539550650', 'ORIENTE 168', '', '309', 'gato7781@hotmail.com', '0', 'MOCTEZUMA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(140, NULL, 2, 'JORGE SANTIAGO ALONSO', NULL, NULL, '542036485', '', '', '', 'mastreta@airbag.com.mx', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(141, NULL, 2, 'GUIEVINISSA CABRERA ALTAMIRANO', NULL, NULL, '5517664107', 'EMILIANO ZAPATA', '', '5', 'guie_18@hotmail.com', '0', 'SAN ANTONIO', 'CDMX', 'EDO. MEXICO', 'active', '2018-09-03 06:12:57', NULL, NULL),
(142, NULL, 2, 'EMILIO RAMÃREZ CASTILLO ', NULL, NULL, '5532639149', 'CHIMALPOPOCA', '', '31', 'valuacion@airbag.com.mx', '0', 'BOSQUES DE MOCTEZUMA', 'CDMX', 'EDO. MEX.', 'active', '2018-09-03 06:12:57', NULL, NULL),
(143, NULL, 2, 'ANTONIO AYOLA MALDONADO', NULL, NULL, '5529008970', 'MORELIA', '', '58', 'autorin@prodigy.net.mx', '0', 'ROMA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(144, NULL, 2, 'CESAR CORTAZAR RUIZ', NULL, NULL, '5523883735', 'SIETE LEGUAS', '', '320', 'acuralive@yahoo.com.mx', '0', 'BENITO JUAREZ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(145, NULL, 2, 'NOELIA PARK', NULL, NULL, '5559260108', 'RINCÃ“N DE BOSQUES', '', '51', 'josexyh@hotmail.com', '0', 'MIGUEL HIDALGO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(146, NULL, 2, 'MARGARITO SANTOS PULIDO', NULL, NULL, '', '', '', '', 'valuacion@mastreta.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(147, NULL, 2, 'EVELYN MONSERRAT VALENZUELA SANCHEZ', NULL, NULL, '5539886131', 'CHABACANO', '', '115', 'tkdevelynvalenzuela@hotmail.es', '0', 'AMPLIACIÃ“N ASTURIAS', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(148, NULL, 2, 'DAVID ALEJANDRO PEREZ HERNANDEZ', NULL, NULL, '5581514581', 'BELLA VISTA', '', '520', 'valuacion@airbag.com.mx', '0', 'SAN JUAN XALAPA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(149, NULL, 2, 'OSCAR FERNANDO TRUJANO SANDOVAL', NULL, NULL, '5532330268', '', '', '', 'valuacion@mastreta.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(150, NULL, 2, 'ALEJANDRO ORIN', NULL, NULL, '', '', '', '', 'valuacion@mastreta.com,mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(151, NULL, 2, 'GABRIEL RUVALCABA QUIROZ', NULL, NULL, '43248150', 'VASCO DE QUIRADA', '4', '18', 'gabrielruva66@gmail.com', '0', 'PARAJE SAN JUAN', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(152, NULL, 2, 'ARMANDO VALENCIA GONZALEZ', NULL, NULL, '12529538', '', '', '', 'valuacion@mastreta.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(153, NULL, 2, 'MARIO RAFAEL GALVÃN LINARES', NULL, NULL, '5529710447', 'DOCTOR BARRAGÃN ', '202', '738', 'marior.galvan@gmail.com', '0', 'NARVARTE', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(154, NULL, 2, 'ALDO SORIANO GARCIA', NULL, NULL, '5527765489', '', '', '', 'aldsorian@hotmail.com', '0', 'BOSQUES DE SANTA FE', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(155, NULL, 2, 'JORGE CERRITOS HERNANDEZ', NULL, NULL, '5519172213', 'HIDALGO', '2-A', '500', 'jorgech_2411@hotmail.com', '0', 'SAN NICOLAS TOLENTINO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(156, NULL, 2, 'MAX GERARDO MARTÃNEZ MORENO', NULL, NULL, '5543237873', '', '', '', 'valuacion@airbag.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(157, NULL, 2, 'JESUS ENRIQUE ALDANA ROSAS', NULL, NULL, '5559262114', 'DOCTOR LA VISTA', '', '139', 'orogladiador1@hotmail.com', '0', 'DOCTORES', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(158, NULL, 2, 'OSCAR ULISES RODRIGUEZ CHAVEZ', NULL, NULL, '5513668561', 'VICENTE GUERRERO', '1', '2', '9renovatio@gmail.com', '0', 'CASTILLO CHICO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(159, NULL, 2, 'JUAN CHAVEZ EZQUIVEL', NULL, NULL, '5527602413', 'RISCO', '', '15', 'jche8989@gmail.com', '0', 'LA CASCADA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(160, NULL, 2, 'RICARDO DÃVILA REYES', NULL, NULL, '5548130510', 'JOSE JOAQUÃN  PESADO', '', '20', 'ricardo.davila@cns.gob.mx', '0', 'OBRERA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(161, NULL, 2, 'EDUARDO LOPEZ IBARRA', NULL, NULL, '5521711619', 'LOPEZ', '', '12', 'eduardo.lopezi@pgr.gob.mx', '0', 'CENTRO ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(162, NULL, 2, 'HECTOR GERARDO HUERTA ESTRADA ', NULL, NULL, '5524428927', 'SUR 75-A', '', '4356', 'hector.huertae@imss.gob.mx', '0', 'VIADUCTO PIEDAD', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(163, NULL, 2, 'DANIEL JESUS BAUTISTA', NULL, NULL, '5514085218', 'TLAXCOAQUE', '5', '8', 'djbautistac@yahoo.com.mx', '0', 'CENTRO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(164, NULL, 2, 'RAQUEL TOVAR JUAREZ', NULL, NULL, '5544558625', 'CAMPO FORTUNA NACIONAL', '', '189', 'raquel_tovar3@hotmail.com', '0', 'SAN ANTONIO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(165, NULL, 2, 'FELIPE DE JESUS LOPEZ AGUILAR', NULL, NULL, '53972706', 'RETORNO DE LA PALMA', '', '4', '', '0', 'UNIDAD ADOLFO LOPEZ MATEOS', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(166, NULL, 2, 'JUAN CARLOS MORENA BELLO', NULL, NULL, '5554363894', 'MANUEL JOSE OTHON', '', '133', 'carallas@hotmail.com', '0', 'OBRERA', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(167, NULL, 2, 'SANDRA LANDEROS', NULL, NULL, '5557091133', '', '', '', '', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(168, NULL, 2, 'BLANCA ESTELA VAZQUEZ RODRIGUEZ', NULL, NULL, '5522639025', 'XOCONGO', '', '40', 'blancavr@live.com.mx', '0', 'TRANSITO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(169, NULL, 2, 'MIGUEL RAUL AVILA GUERRERO', NULL, NULL, '5531282127', 'AV. JUAREZ', '', '20', 'mavilag.@sre.com.mx', '0', 'CENTRO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(170, NULL, 2, 'JESUS ANTONIO GALINDO MENDOZA', NULL, NULL, '5529718712', 'PARAGUAY', '', '35', 'valuacion@mastreta.com.mx', '0', 'CENTRO', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(171, NULL, 2, 'Juan Manuel Alvarado  (Prueba de sistema)', NULL, NULL, '', 'Prueba', '0989', '54', 'jm_alvarado_lopez@yahoo.com', '97887', 'Transito', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(172, NULL, 2, 'Maria Cruz Morales Fuentes', NULL, NULL, '5528220527', '15 andador ', '402', '101', 'jm_alvarado_lopez@yahoo.com', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(173, NULL, 2, 'Jose Antonio Marin', NULL, NULL, '', 'rytryrty', 'ty', 'ioi', 'jamcanive@gmail.com', '2321', 'ghgha', 'cdmx', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(174, NULL, 2, 'Felix', NULL, NULL, '', '', '123', '', 'jm_alvarado_lopez@yahoo.com', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(175, NULL, 2, 'Rogelio Guerra', NULL, NULL, '', 'xochicalco', '12', '10', 'jm_alvarado_lopez@yahoo.com', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(176, NULL, 7, 'Alan MÃ©ndez Bermudez', NULL, NULL, '', '', '', '', 'jm_alvarado_lopez@yahoo.com', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(177, NULL, 7, 'FERNANDO GARCIA AVENDAÃ‘O', NULL, NULL, '54297669  CEL. 55631', 'AV. PALMITAS ', '', 'M.48 LT.158', 'fernando.garciaav@gmail.com', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(178, NULL, 7, 'Roberto Toche Huila', NULL, NULL, '5545234453', 'Luna ', '', '44', 'valuacion@mastreta.com.mx', '0', 'Guerrero', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(179, NULL, 7, 'Claudia Fabiola Gutierrez Miranda', NULL, NULL, '5514921441', 'Canal Atenco', '', '1', 'claudia_fgm@yahoo.com.mx', '0', 'Santiago Norte', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(180, NULL, 7, 'Miguel Angel Ortega Mayel ', NULL, NULL, '55544953554', 'Av. de las Torres ', '', '19', 'valuacion@mastreta.com.mx', '0', 'San AgustÃ­n', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(181, NULL, 7, 'Alfredo Daniel Arenas quintero', NULL, NULL, '5516535009', 'Cerrada de Agrarismo ', '', '8', 'soydany11@gmail.com', '0', 'Escandon ', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(182, NULL, 7, 'Yu Yungxian', NULL, NULL, '5525387606', '', '', '', 'alibeycosmeticos@hotmail.com', '0', 'Centro', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(183, NULL, 7, 'Abelardo Rosas Jose', NULL, NULL, '5531473697', 'Plaza Santa Ana', 'B2', '16', 'valuacion@mastreta.com.mx', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(184, NULL, 7, 'Jose Daniel Benitez Torres', NULL, NULL, '5543208846', 'Apio', 'Lt. 40', 'Mz.84', 'yb_eto@hotmail.com', '0', 'Los Angeles', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(185, NULL, 7, 'Benjamin de la Huerta HernÃ¡ndez ', NULL, NULL, '55780727 o 552273354', 'Diagonal 20 de Noviembre ', 'Departamento 18 ', '219', '', '6090', 'Centro ', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(186, NULL, 7, 'Omar Morales Segundo', NULL, NULL, '5549403807', 'Privada Chapultepec', '', '73', 'jm_alvarado_lopez@yahoo.com', '0', 'La Mesa', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(187, NULL, 7, 'Jose Luis K Cornish', NULL, NULL, '55405326', 'Aguiar y Seijas', '201', '56', '', '11000', 'Lomas Virreyes ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(188, NULL, 7, 'VerÃ³nica ', NULL, NULL, '', '', '', '', '', '0', '', '', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(189, NULL, 7, 'AdÃ¡n Casas Llanos', NULL, NULL, '52367535 o 557735046', 'Doctor LuciÃ³ ', '', '1950', 'adanllanos22@gmail.com', '0', 'Doctores', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(190, NULL, 7, 'Jorge Andres Mercado Joffre ', NULL, NULL, '5207-9168  ext. 17', 'Paseo de la Reforma ', '601', '231', 'andyjoffre@hotmail.com', '6500', 'Cuauhtemoc ', 'CDMX', 'Cuauhtemoc', 'active', '2018-09-03 06:12:57', NULL, NULL),
(191, NULL, 7, 'Veronica Inacua Trejo ', NULL, NULL, '6545-1296  556916-00', 'Santo Domingo ', '505', '25', 'cielo_610@hotmail.com', '0', 'La preciosa ', 'CDMX', 'Azcapotzalco', 'active', '2018-09-03 06:12:57', NULL, NULL),
(192, NULL, 7, 'Miguel Angel Gonzalez Oviedo', NULL, NULL, '5561081694', 'Tlacotlal Z', '1', '2426', '', '800720', 'Gabriel Ramos MillÃ¡n', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(193, NULL, 7, 'ValentÃ­n Torres Corona', NULL, NULL, '5540428184', 'Pera VeriÃ±al', '', '27', 'pegaso_transportes@yahoo.com.mx', '16010', 'Paseos del Sur', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(194, NULL, 7, 'Jose Armando Alvarez', NULL, NULL, '5516775704', '', '', '', '', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(195, NULL, 7, 'Adrian Aguilar Alonso', NULL, NULL, '5515867488', 'Av. del taller ', '402', '791-11', 'adriang01@hotmail.com', '0', 'JardÃ­n Balbuena', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(196, NULL, 7, 'Arturo Nava Ramirez ', NULL, NULL, '5548009821', 'moctezuma', '', '90', 'arthur.nava35@gmail.com', '6100', 'guerrero ', 'CDMX', 'Cuauhtemoc', 'active', '2018-09-03 06:12:57', NULL, NULL),
(197, NULL, 7, 'Jonathan Garcia Corona', NULL, NULL, '5544749597 o 5518018', 'Primaveras', '9', '11', 'facturacion@gasfar.com', '0', 'Bosques', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(198, NULL, 7, 'Francisco Gonzalez Olvera', NULL, NULL, '58153908 o 552302430', 'Via Magna', '', '6', 'gpaco220@gmail.com', '52766', 'San Ferando la Herradura ', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(199, NULL, 7, 'Carlos Alberto Castro Vallejano', NULL, NULL, '52772871 o 556069036', 'Manzana 1 ', '1 PB', 'Grupo 6 ', 'charly.vallejano@hotmail.com', '1170', 'Unidad Santa Fe', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(200, NULL, 7, 'Miguel Angel Gutierrez Vargas ', NULL, NULL, '55145051 o 551353338', 'Praga', 'PB', '39', 'magv206@gmail.com', '6600', 'Juarez', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(201, NULL, 7, 'Gabriel MejÃ­a Cortes', NULL, NULL, '5510034602', 'Sur 99', '', '3', 'gabriel.mejiac@gmail.com', '15960', 'El Parque ', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(202, NULL, 7, 'Edith Tiburcio Jimenez', NULL, NULL, '5510071648', 'Bacerac ', '', '57', 'adalid_85@hotmail.com', '15990', 'Alvaro Obregon', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(203, NULL, 7, 'Pedro Vazquez Aguirre', NULL, NULL, '5534685592', 'Manuel Gonzalez', '5', '408', 'pedrovag@live.com.mx', '0', 'Tlatelolco', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(204, NULL, 7, 'Enrique Espinoza Moreno', NULL, NULL, '53468494 o 552253908', 'Gabriel Hernandez', '', '56', '', '0', 'Doctores', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(205, NULL, 7, 'Arisbel Jacobo  Rodriguez ', NULL, NULL, '5511860116 o 5858104', 'Guadalajara', '', 'Mz 13  Lt 32', 'ajr_aris83@hotmail.com', '57850', 'Ejidos de San AgustÃ­n ', 'CDMX', 'Edo. Mexico', 'active', '2018-09-03 06:12:57', NULL, NULL),
(206, NULL, 7, 'Marcelo Javier Zorrillo Gonzalez ', NULL, NULL, '5530450435', 'Jaime NunÃ³ ', '602', 'N 14602', 'zorillomarcelo@gmail.com', '6200', 'Morelos', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(207, NULL, 7, 'Cesar Mauricio Rivera Vazquez', NULL, NULL, '5530161237', 'Av. Cuauhtemoc', '', '1240', 'pcdeltabj@hotmail.com', '3310', 'Santa Cruz Atoyac', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(208, NULL, 7, 'Araceli Quiroz Sanchez ', NULL, NULL, '5541775292', 'Oriente 164', '', '423', 'araceliquiroz74@gmail.com', '15500', 'Moctezuma Segunda Seccion', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(209, NULL, 7, 'Jenyfer Yanet Martinez Monroy', NULL, NULL, '5545362674', 'Jesus Maria ', '2', '164', 'zamarimonroy@hotmail.com', '6020', 'Centro', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(210, NULL, 7, 'Edgar GarcÃ­a Perez', NULL, NULL, '5576149502', '', '', '', 'edgargnr04@gmail.com', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(211, NULL, 7, 'Edgar Avalos Fernandez', NULL, NULL, '5512924473', 'Atlantida', '', '191', 'edgar_misionero@hotmail.com', '10380', 'Barros Sierra', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(212, NULL, 7, 'Julieta Munguia Barrera', NULL, NULL, '5585774385', 'Oriente 172', '', '51', 'marketing@espacioalebrije.com.mx', '15530', 'Moctezuma 2A Seccion', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(213, NULL, 7, 'Asael Torres  Loyo', NULL, NULL, '5529196633', 'Valle de los Angeles', '', '226', 'asael77@hotmail.com', '57100', 'Valle de Aragon 1A Seccion', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(214, NULL, 7, 'Eloy Gutierrez Alcala', NULL, NULL, '56902648', 'Villa Federal ', '', 'LT 3 Mz 49 P', 'eloynegro@gmail.com', '0', 'Desarrollo Urbano Quetzalcoatl', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(215, NULL, 7, 'Andres Hernandez Pastor', NULL, NULL, '5513452868', 'Amezquites', '202', '110', 'andreshdzpastor@hotmail.com', '4369', 'Santo Domingo', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(216, NULL, 7, 'Jose Ignacio Valdivia Camargo', NULL, NULL, '5541336985', 'Moctezuma', '', '190', 'josevaldivia760801@gmail.com', '0', 'Guerrero', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(217, NULL, 7, 'Guadalupe Jimenez', NULL, NULL, '5591902888', '', '', '', '', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(218, NULL, 7, 'Juan Eulalio Mendoza Cotero', NULL, NULL, '5545935535', 'Av Paraiso Oriente', '15', '238', 'jmendoza6022@hotmail.com', '45134', 'Fraccionamiento Campo Real ', '', 'Zapopoan Jalisco', 'active', '2018-09-03 06:12:57', NULL, NULL),
(219, NULL, 7, 'Yuriada Iazum GarcÃ­a Ramirez', NULL, NULL, '55224012', '', '', '', '', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(220, NULL, 7, 'Jorge Reyes Arroyo ', NULL, NULL, '1944-5992 o 555195-1', 'Lago Tanganica #5 Int. 203 Col. Granada ', '203', '5', 'jorge_reyes01@yahoo.com.mx', '11520', 'Granada ', 'CDMX', 'Miguel Hidalgo ', 'active', '2018-09-03 06:12:57', NULL, NULL),
(221, NULL, 7, 'Noe MartÃ­nez ', NULL, NULL, '5554149481', '', '', '', '', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(222, NULL, 7, 'Alejandro Francisco Manuel', NULL, NULL, '5531954822', '', '', '', '', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(223, NULL, 7, 'Jonatan  Garcia Morales', NULL, NULL, '5549966491', 'Batuecas', 'MZ1', 'Lt 3', 'jon1jon1garcia@gmail.com', '1280', 'El Pocito', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(224, NULL, 7, 'Irma Mosqueda Frausto', NULL, NULL, '5554988975', 'Andador de la cordillera', '', '14', 'moscardiu@yahoo.com.mx', '54900', 'Fraccionamiento ciudad labor', 'CDMX', 'Municipio de TultitlÃ¡n Edo. Mex.', 'active', '2018-09-03 06:12:57', NULL, NULL),
(225, NULL, 7, 'Francisco Bustamante', NULL, NULL, '5578436368', '', '', '', '', '0', '', 'CDMX', '', 'active', '2018-09-03 06:12:57', NULL, NULL),
(226, NULL, 7, 'Didier Alvarez ', NULL, NULL, '5549872819', 'Doctor Velazco', '4', '151', 'didieralvarezlares@gmail.com', '6720', 'Doctores', 'CDMX', 'CDMX', 'active', '2018-09-03 06:12:57', NULL, NULL),
(227, NULL, 7, 'Juan Miguel Cardenas Vargas', NULL, NULL, '5566734097 o 7652098', 'Pablo Neruda', 'Mz8 ', 'Lt.30', 'mcardenasj7621@gmail.com', '55295', 'Pedro Ojeda Paullada', 'CDMX', 'Edo. Mexico', 'active', '2018-09-03 06:12:57', NULL, NULL),
(228, NULL, 7, 'Luis Eduardo Zavala Peregrino', NULL, NULL, '5554571173', 'Aluminios', 'E602', '161', 'eduardo.zavalap@hotmail.com', '15220', 'Popular Razo', 'CDMX', '', 'deleted', '2018-09-03 06:12:57', NULL, '2018-11-08 18:53:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_vehiculo`
--

CREATE TABLE `detalles_vehiculo` (
  `id` int(11) NOT NULL,
  `id_vehiculo` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `Medallon` varchar(45) DEFAULT NULL,
  `EquipoAudioOriginal` int(11) DEFAULT NULL,
  `LlaveDLlantas` varchar(45) DEFAULT NULL,
  `tablero` int(11) DEFAULT '1',
  `funcionIndicadores` int(11) DEFAULT '1',
  `tanqueGasolina` int(11) DEFAULT '1',
  `Kilometraje` varchar(45) DEFAULT NULL,
  `FuncionamientoAC` int(11) DEFAULT '1',
  `ControlesAC` int(11) DEFAULT '1',
  `Cenicero` int(11) DEFAULT '1',
  `Encendedor` int(11) DEFAULT '1',
  `Guantera` int(11) DEFAULT '1',
  `Retrovisor` int(11) DEFAULT '1',
  `LuzInterior` int(11) DEFAULT '1',
  `Visera` int(11) DEFAULT '1',
  `Claxon` int(11) DEFAULT '1',
  `EquipoAudioAdaptado` int(11) DEFAULT '1',
  `MarcaEquipoAudio` varchar(100) DEFAULT NULL,
  `Ecualizador` int(11) DEFAULT '1',
  `Amplificador` int(11) DEFAULT '1',
  `CajadeCDs` int(11) DEFAULT '1',
  `Bocinas` int(11) DEFAULT '1',
  `AlarmaInstalada` int(11) DEFAULT '1',
  `Tapetes` int(11) DEFAULT '1',
  `Tapiceria` int(11) DEFAULT '1',
  `Intermitentes` int(11) DEFAULT '1',
  `LucesExteriores` int(11) DEFAULT '1',
  `Bateria` int(11) DEFAULT '1',
  `TaponRadiador` int(11) DEFAULT '1',
  `Radiador` int(11) DEFAULT '1',
  `TaponAceite` int(11) DEFAULT '1',
  `Bandas` int(11) DEFAULT '1',
  `BayonetaDeMotor` int(11) DEFAULT '1',
  `BayonetaDeTransmision` int(11) DEFAULT '1',
  `Purificador` int(11) DEFAULT '1',
  `CablesBujias` int(11) DEFAULT '1',
  `DepositoAgua` int(11) DEFAULT '1',
  `FaciaFrontal` int(11) DEFAULT '1',
  `Placa` int(11) DEFAULT '1',
  `Parrilla` int(11) DEFAULT '1',
  `Faros` int(11) DEFAULT '1',
  `FarosNiebla` int(11) DEFAULT '1',
  `Viceles` int(11) DEFAULT '1',
  `CuartosFrontal` int(11) DEFAULT '1',
  `EmblemaCofre` int(11) DEFAULT '1',
  `EmblemaParrilla` int(11) DEFAULT '1',
  `ParabrisasFrontal` int(11) DEFAULT '1',
  `BrazosLimpiaParabrisas` int(11) DEFAULT '1',
  `PlumasLimpiaParabrisas` int(11) DEFAULT '1',
  `Cofre` int(11) DEFAULT '1',
  `BrazoLimpiador` int(11) DEFAULT '1',
  `PlumaLimpiadora` int(11) DEFAULT '1',
  `Emblemas` int(11) DEFAULT '1',
  `Spoiler` int(11) DEFAULT '1',
  `PlacaTrasera` int(11) DEFAULT '1',
  `Escape` int(11) DEFAULT '1',
  `FaciaTrasera` int(11) DEFAULT '1',
  `CuartosLatIzquierdo` int(11) DEFAULT '1',
  `EmblemasLatIzquierdo` int(11) DEFAULT '1',
  `EspejoLatIzquierdo` int(11) DEFAULT '1',
  `CristalesLatIzquierdos` int(11) DEFAULT '1',
  `ManijasLatIzquierdo` int(11) DEFAULT '1',
  `MoldurasLatIzquierdo` int(11) DEFAULT '1',
  `CuartosLatDerecho` int(11) DEFAULT '1',
  `EmblemasLatDerecho` int(11) DEFAULT '1',
  `EspejoLatDerecho` int(11) DEFAULT '1',
  `CristalesLatDerecho` int(11) DEFAULT '1',
  `ManijasLatDerecho` int(11) DEFAULT '1',
  `MoldurasLatDerecho` int(11) DEFAULT '1',
  `Herramientas` int(11) DEFAULT '1',
  `Gato` int(11) DEFAULT '1',
  `LlantaRefaccion` int(11) DEFAULT '1',
  `TapeteCajuela` int(11) DEFAULT '1',
  `Extinguidor` int(11) DEFAULT '1',
  `CablesPasaCorriente` int(11) DEFAULT '1',
  `SenalesReflejantes` int(11) DEFAULT '1',
  `Antena` int(11) DEFAULT '1',
  `TapaGasolina` int(11) DEFAULT '1',
  `TaponGasolina` int(11) DEFAULT '1',
  `CanastillaViaje` int(11) DEFAULT '1',
  `Llaves` int(11) DEFAULT '1',
  `Llavero` int(11) DEFAULT '1',
  `TarjetaCirculacion` int(11) DEFAULT '1',
  `MedLlantaDelDer` varchar(100) DEFAULT NULL,
  `MarcaLlantaDelDer` varchar(100) DEFAULT NULL,
  `LlantaDelDerT` int(11) DEFAULT '1',
  `LlantaDelDerR` int(11) DEFAULT '1',
  `MedLlantaDelIzq` varchar(100) DEFAULT NULL,
  `MarcaLlantaDelIzq` varchar(100) DEFAULT NULL,
  `LlantaDelIzqT` int(11) DEFAULT '1',
  `LlantaDelIzqR` int(11) DEFAULT '1',
  `MedLlantaTrasDer` varchar(100) DEFAULT NULL,
  `MarcaLlantaTrasDer` varchar(100) DEFAULT NULL,
  `LlantaTrasDerT` int(11) DEFAULT '1',
  `LlantaTrasDerR` int(11) DEFAULT '1',
  `MedLlantaTrasIzq` varchar(100) DEFAULT NULL,
  `MarcaLlantaTrasIzq` varchar(100) DEFAULT NULL,
  `LlantaTrasIzqT` int(11) DEFAULT '1',
  `LlantaTrasIzqR` int(11) DEFAULT '1',
  `descDanosPreexist` text,
  `observaciones` text,
  `articulosResguardados` text,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_vehiculorefaccion`
--

CREATE TABLE `historial_vehiculorefaccion` (
  `id` int(11) NOT NULL,
  `id_vehiculorefaccion` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_anterior` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comentarios` varchar(300) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_inicio` varchar(45) DEFAULT NULL,
  `fecha_estimada` varchar(45) DEFAULT NULL,
  `fecha_fin` varchar(45) DEFAULT NULL,
  `id_userasigned` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial_vehiculorefaccion`
--

INSERT INTO `historial_vehiculorefaccion` (`id`, `id_vehiculorefaccion`, `id_user`, `status_anterior`, `status`, `comentarios`, `created_date`, `fecha_inicio`, `fecha_estimada`, `fecha_fin`, `id_userasigned`) VALUES
(1, 2, 3, 'active', 'Realizado', NULL, '2018-12-13 06:36:25', NULL, NULL, NULL, NULL),
(2, 1, 3, 'active', 'Realizado', NULL, '2018-12-13 06:37:09', NULL, NULL, NULL, NULL),
(3, 2, 3, 'Realizado', 'active', NULL, '2018-12-13 06:43:41', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_vehiculoservicio`
--

CREATE TABLE `historial_vehiculoservicio` (
  `id` int(11) NOT NULL,
  `id_vehiculoservicio` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_anterior` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comentarios` varchar(300) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_inicio` varchar(45) DEFAULT NULL,
  `fecha_estimada` varchar(45) DEFAULT NULL,
  `fecha_fin` varchar(45) DEFAULT NULL,
  `id_userasigned` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial_vehiculoservicio`
--

INSERT INTO `historial_vehiculoservicio` (`id`, `id_vehiculoservicio`, `id_user`, `status_anterior`, `status`, `comentarios`, `created_date`, `fecha_inicio`, `fecha_estimada`, `fecha_fin`, `id_userasigned`) VALUES
(1, 9, 3, 'active', 'Realizado', NULL, '2018-12-12 05:35:19', NULL, NULL, NULL, NULL),
(2, 0, 3, 'active', 'Realizado', NULL, '2018-12-13 06:33:27', NULL, NULL, NULL, NULL),
(3, 0, 3, 'active', 'Realizado', NULL, '2018-12-13 06:34:42', NULL, NULL, NULL, NULL),
(4, 10, 3, 'active', 'Realizado', 'le falto un poco', '2018-12-13 15:41:55', NULL, NULL, NULL, NULL),
(5, 17, 3, 'active', 'Stand-By', '', '2018-12-13 15:43:45', NULL, NULL, NULL, NULL),
(6, 10, 3, 'Realizado', 'active', '', '2018-12-13 18:04:50', NULL, NULL, NULL, NULL),
(7, 10, 3, 'active', 'Realizado', '', '2018-12-19 09:32:29', '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_refaccion`
--

CREATE TABLE `imagenes_refaccion` (
  `id` int(11) NOT NULL,
  `id_refaccion` int(11) DEFAULT NULL,
  `nombre` text,
  `descripcion` text,
  `url` text,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes_refaccion`
--

INSERT INTO `imagenes_refaccion` (`id`, `id_refaccion`, `nombre`, `descripcion`, `url`, `status`, `created_date`, `deleted_date`) VALUES
(1, 2, '0_afinacion 2.png', NULL, 'auto_2/images/0_afinacion 2.png', 'active', '2018-10-26 22:36:37', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_vehiculo`
--

CREATE TABLE `imagenes_vehiculo` (
  `id` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `nombre` text,
  `descripcion` text,
  `url` text,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenes_vehiculo`
--

INSERT INTO `imagenes_vehiculo` (`id`, `id_vehiculo`, `nombre`, `descripcion`, `url`, `status`, `created_date`, `deleted_date`) VALUES
(1, 238, '10303960_737881409594767_779275035982163164_n.jpg', NULL, 'auto_238/images/10303960_737881409594767_779275035982163164_n.jpg', 'active', '2018-09-20 22:31:11', NULL),
(2, 238, '18557314_10203164427588422_1481581111670788747_n.jpg', NULL, 'auto_238/images/18557314_10203164427588422_1481581111670788747_n.jpg', 'active', '2018-09-20 22:31:11', NULL),
(3, 238, 'fotos+mes+de+enero+060.jpg', NULL, 'auto_238/images/fotos+mes+de+enero+060.jpg', 'active', '2018-09-20 22:31:11', NULL),
(4, 239, 'audi.jpg', NULL, 'auto_239/images/audi.jpg', 'active', '2018-09-27 15:46:40', NULL),
(5, 239, 'audi2.jpg', NULL, 'auto_239/images/audi2.jpg', 'active', '2018-09-27 15:46:40', NULL),
(6, 239, 'audi3.png', NULL, 'auto_239/images/audi3.png', 'active', '2018-09-27 15:46:40', NULL),
(7, 240, 'ferrary.jpg', NULL, 'auto_240/images/ferrary.jpg', 'active', '2018-09-27 16:25:43', NULL),
(8, 240, 'ferrary2.jpg', NULL, 'auto_240/images/ferrary2.jpg', 'active', '2018-09-27 16:25:43', NULL),
(9, 240, 'ferrary3.jpg', NULL, 'auto_240/images/ferrary3.jpg', 'active', '2018-09-27 16:25:43', NULL),
(10, 241, 'cheyene.jpg', NULL, 'auto_241/images/cheyene.jpg', 'active', '2018-09-27 16:27:34', NULL),
(11, 241, 'cheyene2.jpg', NULL, 'auto_241/images/cheyene2.jpg', 'active', '2018-09-27 16:27:34', NULL),
(12, 241, 'cheyene3.jpg', NULL, 'auto_241/images/cheyene3.jpg', 'active', '2018-09-27 16:27:34', NULL),
(13, 242, 'frontier.jpg', NULL, 'auto_242/images/frontier.jpg', 'active', '2018-09-27 16:29:52', NULL),
(14, 242, 'frontier2.jpg', NULL, 'auto_242/images/frontier2.jpg', 'active', '2018-09-27 16:29:52', NULL),
(15, 242, 'frontier3.jpg', NULL, 'auto_242/images/frontier3.jpg', 'active', '2018-09-27 16:29:52', NULL),
(16, 243, 'crosfox2.jpg', NULL, 'auto_243/images/crosfox2.jpg', 'active', '2018-09-27 16:32:29', NULL),
(17, 243, 'crosfox3.jpg', NULL, 'auto_243/images/crosfox3.jpg', 'active', '2018-09-27 16:32:29', NULL),
(18, 243, 'crossfox.jpg', NULL, 'auto_243/images/crossfox.jpg', 'active', '2018-09-27 16:32:29', NULL),
(19, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-12 05:32:52', NULL),
(20, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-12 05:32:53', NULL),
(21, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-12 05:32:53', NULL),
(22, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:38:46', NULL),
(23, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:38:46', NULL),
(24, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:38:46', NULL),
(25, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:41:39', NULL),
(26, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:41:39', NULL),
(27, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:41:39', NULL),
(28, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:44:46', NULL),
(29, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:44:46', NULL),
(30, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:44:46', NULL),
(31, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:46:15', NULL),
(32, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:46:15', NULL),
(33, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:46:15', NULL),
(34, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:47:40', NULL),
(35, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:47:40', NULL),
(36, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:47:40', NULL),
(37, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:48:06', NULL),
(38, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:48:06', NULL),
(39, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:48:06', NULL),
(40, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:48:06', NULL),
(41, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:48:06', NULL),
(42, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:48:06', NULL),
(43, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:48:06', NULL),
(44, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:48:06', NULL),
(45, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:54:43', NULL),
(46, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:54:43', NULL),
(47, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:54:43', NULL),
(48, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 16:54:55', NULL),
(49, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 16:54:55', NULL),
(50, 246, 'mustange3.jpg', NULL, 'auto_246/images/mustange3.jpg', 'deleted', '2018-12-13 16:54:55', NULL),
(51, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:05:46', NULL),
(52, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:05:46', NULL),
(53, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:06:58', NULL),
(54, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:06:58', NULL),
(55, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:09:12', NULL),
(56, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:09:12', NULL),
(57, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:20:36', NULL),
(58, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:20:36', NULL),
(59, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:22:19', NULL),
(60, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:22:19', NULL),
(61, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:22:29', NULL),
(62, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:22:29', NULL),
(63, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:23:25', NULL),
(64, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:23:25', NULL),
(65, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:24:46', NULL),
(66, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:24:46', NULL),
(67, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:25:07', NULL),
(68, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:25:07', NULL),
(69, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:26:55', NULL),
(70, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:26:55', NULL),
(71, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:27:50', NULL),
(72, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:27:50', NULL),
(73, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:32:13', NULL),
(74, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:32:13', NULL),
(75, 246, 'mustange2.jph__89930.png', NULL, 'auto_246/images/mustange2.jph__89930.png', 'deleted', '2018-12-13 17:32:13', NULL),
(76, 246, 'mustange2.jpi__66062.png', NULL, 'auto_246/images/mustange2.jpi__66062.png', 'deleted', '2018-12-13 17:32:13', NULL),
(77, 246, 'mustange2.jpj__7592.png', NULL, 'auto_246/images/mustange2.jpj__7592.png', 'deleted', '2018-12-13 17:32:13', NULL),
(78, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:37:07', NULL),
(79, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:37:07', NULL),
(80, 246, 'mustange2.jph_Array_12888.png', NULL, 'auto_246/images/mustange2.jph_Array_12888.png', 'deleted', '2018-12-13 17:37:07', NULL),
(81, 246, 'mustange2.jpi_Array_72823.png', NULL, 'auto_246/images/mustange2.jpi_Array_72823.png', 'deleted', '2018-12-13 17:37:07', NULL),
(82, 246, 'mustange2.jpj_Array_92310.png', NULL, 'auto_246/images/mustange2.jpj_Array_92310.png', 'deleted', '2018-12-13 17:37:07', NULL),
(83, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:38:35', NULL),
(84, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:38:35', NULL),
(85, 246, 'mustange2.jph_Captura.PNG_43354.png', NULL, 'auto_246/images/mustange2.jph_Captura.PNG_43354.png', 'deleted', '2018-12-13 17:38:35', NULL),
(86, 246, 'mustange2.jpi_8032b7bcf2da3c74a75a61f47cece076.png_71468.png', NULL, 'auto_246/images/mustange2.jpi_8032b7bcf2da3c74a75a61f47cece076.png_71468.png', 'deleted', '2018-12-13 17:38:35', NULL),
(87, 246, 'mustange2.jpj_27539974_406441249794621_8477430187647809841_n.png_98965.png', NULL, 'auto_246/images/mustange2.jpj_27539974_406441249794621_8477430187647809841_n.png_98965.png', 'deleted', '2018-12-13 17:38:35', NULL),
(88, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:39:11', NULL),
(89, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:39:11', NULL),
(90, 246, 'mustange2.jph_Captura.PNG_11254.png', NULL, 'auto_246/images/mustange2.jph_Captura.PNG_11254.png', 'deleted', '2018-12-13 17:39:11', NULL),
(91, 246, 'mustange2.jpi_8032b7bcf2da3c74a75a61f47cece076.png_11395.png', NULL, 'auto_246/images/mustange2.jpi_8032b7bcf2da3c74a75a61f47cece076.png_11395.png', 'deleted', '2018-12-13 17:39:11', NULL),
(92, 246, 'mustange2.jpj_27539974_406441249794621_8477430187647809841_n.png_68890.png', NULL, 'auto_246/images/mustange2.jpj_27539974_406441249794621_8477430187647809841_n.png_68890.png', 'deleted', '2018-12-13 17:39:11', NULL),
(93, 246, 'mustange2.jpk_47687402_10215982878939120_6237040044259934208_n.jpg_15214.png', NULL, 'auto_246/images/mustange2.jpk_47687402_10215982878939120_6237040044259934208_n.jpg_15214.png', 'deleted', '2018-12-13 17:39:11', NULL),
(94, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:39:53', NULL),
(95, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:39:53', NULL),
(96, 246, 'mustange2.jph_Captura.PNG_54724.png', NULL, 'auto_246/images/mustange2.jph_Captura.PNG_54724.png', 'deleted', '2018-12-13 17:39:53', NULL),
(97, 246, 'mustange2.jpi_8032b7bcf2da3c74a75a61f47cece076.png_25381.png', NULL, 'auto_246/images/mustange2.jpi_8032b7bcf2da3c74a75a61f47cece076.png_25381.png', 'deleted', '2018-12-13 17:39:54', NULL),
(98, 246, 'mustange2.jpj_27539974_406441249794621_8477430187647809841_n.png_8489.png', NULL, 'auto_246/images/mustange2.jpj_27539974_406441249794621_8477430187647809841_n.png_8489.png', 'deleted', '2018-12-13 17:39:54', NULL),
(99, 246, 'mustange2.jpk_47687402_10215982878939120_6237040044259934208_n.jpg_58029.png', NULL, 'auto_246/images/mustange2.jpk_47687402_10215982878939120_6237040044259934208_n.jpg_58029.png', 'deleted', '2018-12-13 17:39:54', NULL),
(100, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:40:02', NULL),
(101, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:40:02', NULL),
(102, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:40:25', NULL),
(103, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:40:25', NULL),
(104, 246, 'mustange2.jph_Captura.PNG_25712.png', NULL, 'auto_246/images/mustange2.jph_Captura.PNG_25712.png', 'deleted', '2018-12-13 17:40:25', NULL),
(105, 246, 'mustange2.jpi_8032b7bcf2da3c74a75a61f47cece076.png_44810.png', NULL, 'auto_246/images/mustange2.jpi_8032b7bcf2da3c74a75a61f47cece076.png_44810.png', 'deleted', '2018-12-13 17:40:25', NULL),
(106, 246, 'mustange2.jpj_27539974_406441249794621_8477430187647809841_n.png_21636.png', NULL, 'auto_246/images/mustange2.jpj_27539974_406441249794621_8477430187647809841_n.png_21636.png', 'deleted', '2018-12-13 17:40:26', NULL),
(107, 246, 'mustange2.jpk_47687402_10215982878939120_6237040044259934208_n.jpg_90708.png', NULL, 'auto_246/images/mustange2.jpk_47687402_10215982878939120_6237040044259934208_n.jpg_90708.png', 'deleted', '2018-12-13 17:40:26', NULL),
(108, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:43:06', NULL),
(109, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:43:06', NULL),
(110, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:43:24', NULL),
(111, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:43:24', NULL),
(112, 246, 'Captura.PNG', NULL, 'auto_246/images/Captura.PNG', 'deleted', '2018-12-13 17:43:24', NULL),
(113, 246, '8032b7bcf2da3c74a75a61f47cece076.png', NULL, 'auto_246/images/8032b7bcf2da3c74a75a61f47cece076.png', 'deleted', '2018-12-13 17:43:24', NULL),
(114, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:47:25', NULL),
(115, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:47:25', NULL),
(116, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:47:32', NULL),
(117, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:47:32', NULL),
(118, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:47:43', NULL),
(119, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:47:43', NULL),
(120, 246, 'Captura.PNG', NULL, 'auto_246/images/Captura.PNG', 'deleted', '2018-12-13 17:47:43', NULL),
(121, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:52:48', NULL),
(122, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:52:48', NULL),
(123, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:53:06', NULL),
(124, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:53:06', NULL),
(125, 246, 'Captura.PNG', NULL, 'auto_246/images/Captura.PNG', 'deleted', '2018-12-13 17:53:06', NULL),
(126, 246, '8032b7bcf2da3c74a75a61f47cece076.png', NULL, 'auto_246/images/8032b7bcf2da3c74a75a61f47cece076.png', 'deleted', '2018-12-13 17:53:06', NULL),
(127, 246, '27539974_406441249794621_8477430187647809841_n.png', NULL, 'auto_246/images/27539974_406441249794621_8477430187647809841_n.png', 'deleted', '2018-12-13 17:53:06', NULL),
(128, 246, '47687402_10215982878939120_6237040044259934208_n.jpg', NULL, 'auto_246/images/47687402_10215982878939120_6237040044259934208_n.jpg', 'deleted', '2018-12-13 17:53:06', NULL),
(129, 246, 'LABIAL.PNG', NULL, 'auto_246/images/LABIAL.PNG', 'deleted', '2018-12-13 17:53:06', NULL),
(130, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:55:18', NULL),
(131, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:55:18', NULL),
(132, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:55:39', NULL),
(133, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:55:39', NULL),
(134, 246, '8032b7bcf2da3c74a75a61f47cece076.png', NULL, 'auto_246/images/8032b7bcf2da3c74a75a61f47cece076.png', 'deleted', '2018-12-13 17:55:39', NULL),
(135, 246, '27539974_406441249794621_8477430187647809841_n.png', NULL, 'auto_246/images/27539974_406441249794621_8477430187647809841_n.png', 'deleted', '2018-12-13 17:55:39', NULL),
(136, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:57:21', NULL),
(137, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:57:21', NULL),
(138, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:57:34', NULL),
(139, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:57:34', NULL),
(140, 246, '8032b7bcf2da3c74a75a61f47cece076.png', NULL, 'auto_246/images/8032b7bcf2da3c74a75a61f47cece076.png', 'deleted', '2018-12-13 17:57:34', NULL),
(141, 246, '27539974_406441249794621_8477430187647809841_n.png', NULL, 'auto_246/images/27539974_406441249794621_8477430187647809841_n.png', 'deleted', '2018-12-13 17:57:34', NULL),
(142, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 17:58:40', NULL),
(143, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 17:58:40', NULL),
(144, 246, 'Captura.PNG', NULL, 'auto_246/images/Captura.PNG', 'deleted', '2018-12-13 17:58:40', NULL),
(145, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 22:50:47', NULL),
(146, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 22:50:47', NULL),
(147, 246, 'Captura.PNG', NULL, 'auto_246/images/Captura.PNG', 'deleted', '2018-12-13 22:50:47', NULL),
(148, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 22:51:10', NULL),
(149, 246, 'mustange2.jpg', NULL, 'auto_246/images/mustange2.jpg', 'deleted', '2018-12-13 22:51:10', NULL),
(150, 246, 'Captura.PNG', NULL, 'auto_246/images/Captura.PNG', 'deleted', '2018-12-13 22:51:10', NULL),
(151, 246, 'Captura.PNG', NULL, 'auto_246/images/Captura.PNG', 'deleted', '2018-12-13 22:51:10', NULL),
(152, 246, '8032b7bcf2da3c74a75a61f47cece076.png', NULL, 'auto_246/images/8032b7bcf2da3c74a75a61f47cece076.png', 'deleted', '2018-12-13 22:51:10', NULL),
(153, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'deleted', '2018-12-13 22:52:37', NULL),
(154, 246, 'mustange.jpg', NULL, 'auto_246/images/mustange.jpg', 'active', '2018-12-13 22:53:49', NULL),
(155, 246, 'Captura.PNG', NULL, 'auto_246/images/Captura.PNG', 'active', '2018-12-13 22:53:49', NULL),
(156, 246, '8032b7bcf2da3c74a75a61f47cece076.png', NULL, 'auto_246/images/8032b7bcf2da3c74a75a61f47cece076.png', 'active', '2018-12-13 22:53:49', NULL),
(157, 246, '27539974_406441249794621_8477430187647809841_n.png', NULL, 'auto_246/images/27539974_406441249794621_8477430187647809841_n.png', 'active', '2018-12-13 22:53:49', NULL),
(158, 246, '47687402_10215982878939120_6237040044259934208_n.jpg', NULL, 'auto_246/images/47687402_10215982878939120_6237040044259934208_n.jpg', 'active', '2018-12-13 22:53:49', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  `id_refaccion` int(11) DEFAULT NULL,
  `existencia` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `status`) VALUES
(1, 'Acura', 'active'),
(2, 'Alfa Romeo ', 'active'),
(3, 'Aston Martin', 'active'),
(4, 'Audi', 'active'),
(5, 'Bentley', 'active'),
(6, 'BMW', 'active'),
(7, 'Buick', 'active'),
(8, 'Cadillac', 'active'),
(9, 'Chevrolet', 'active'),
(10, 'Chrysler', 'active'),
(11, 'Dodge', 'active'),
(12, 'FAW', 'active'),
(13, 'Ferrari', 'active'),
(14, 'Fiat', 'active'),
(15, 'Ford', 'active'),
(16, 'GMC', 'active'),
(17, 'Honda', 'active'),
(18, 'Hummer', 'active'),
(19, 'Hyundai', 'active'),
(20, 'Infiniti', 'active'),
(21, 'Isuzu', 'active'),
(22, 'Jaguar', 'active'),
(23, 'Jeep', 'active'),
(24, 'Lamborghini', 'active'),
(25, 'Land Rover', 'active'),
(26, 'Lexus', 'active'),
(27, 'Lincoln', 'active'),
(28, 'Maserati', 'active'),
(29, 'Mazda', 'active'),
(30, 'Mercedes Benz', 'active'),
(31, 'Mercury', 'active'),
(32, 'MG', 'active'),
(33, 'Mini', 'active'),
(34, 'Mitsubishi', 'active'),
(35, 'Nissan', 'active'),
(36, 'Peugeot', 'active'),
(37, 'Pontiac', 'active'),
(38, 'Porsche', 'active'),
(39, 'Renault', 'active'),
(40, 'Saab', 'active'),
(41, 'Seat', 'active'),
(42, 'Smart', 'active'),
(43, 'Subaru', 'active'),
(44, 'Suzuki', 'active'),
(45, 'Toyota', 'active'),
(46, 'Volkswagen', 'active'),
(47, 'Volvo', 'active'),
(48, 'Kia', 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_almacen` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `comentarios` text,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_refaccion`
--

CREATE TABLE `pedido_refaccion` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_refaccion` int(11) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `costo` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `totalcosto` double DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `section` varchar(100) DEFAULT NULL,
  `page` varchar(100) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`, `section`, `page`, `created_date`, `updated_date`, `deleted_date`, `status`) VALUES
(46, 'Servicios Borrar', 'Catalogos', 'serviciodelete', '2018-10-02 22:01:17', NULL, NULL, 'active'),
(44, 'Servicios Alta', 'Catalogos', 'servicioadd', '2018-10-02 22:01:17', NULL, NULL, 'active'),
(45, 'Servicios Editar', 'Catalogos', 'servicioedit', '2018-10-02 22:01:17', NULL, NULL, 'active'),
(43, 'Servicios', 'Catalogos', 'servicio', '2018-10-02 22:01:17', NULL, NULL, 'active'),
(42, 'Sub Marca Borrar', 'Catalogos', 'submarcadelete', '2018-09-28 20:09:32', NULL, NULL, 'active'),
(41, 'Sub Marca Editar', 'Catalogos', 'submarcaedit', '2018-09-28 20:09:19', NULL, NULL, 'active'),
(40, 'Sub Marca Alta', 'Catalogos', 'submarcaadd', '2018-09-28 20:09:07', NULL, NULL, 'active'),
(39, 'Sub Marcas', 'Catalogos', 'submarca', '2018-09-28 20:08:54', NULL, NULL, 'active'),
(38, 'Aseguradora Borrar', 'Catalogos', 'aseguradoradelete', '2018-09-28 20:01:36', NULL, NULL, 'active'),
(37, 'Marca Borrar', 'Catalogos', 'marcadelete', '2018-09-28 19:54:21', '2018-09-29 02:58:25', NULL, 'active'),
(35, 'Marca Alta', 'Catalogos', 'marcaadd', '2018-09-28 19:38:03', NULL, NULL, 'active'),
(36, 'Marca Editar', 'Catalogos', 'marcaedit', '2018-09-28 19:38:18', NULL, NULL, 'active'),
(34, 'Marcas', 'Catalogos', 'marca', '2018-09-28 19:37:50', NULL, NULL, 'active'),
(33, 'Aseguradoras', 'Catalogos', 'aseguradora', '2018-09-28 19:37:19', NULL, NULL, 'active'),
(32, 'Aseguradora Editar', 'Catalogos', 'aseguradoraedit', '2018-09-28 19:37:08', NULL, NULL, 'active'),
(31, 'Aseguradora Alta', 'Catalogos', 'aseguradoraadd', '2018-09-28 19:36:45', NULL, NULL, 'active'),
(30, 'Usuarios Tipos Borrar', 'Users', 'usertypedelete', '2018-09-28 17:56:47', NULL, NULL, 'active'),
(29, 'Usuarios Tipos', 'Users', 'usertype', '2018-09-28 17:48:39', NULL, NULL, 'active'),
(28, 'Permiso Tipos de Usuario', 'Permisos', 'asignartipouser', '2018-09-28 17:47:44', NULL, NULL, 'active'),
(27, 'Usuarios Cambiar Password', 'Users', 'changepassword', '2018-09-28 04:22:23', NULL, NULL, 'active'),
(25, 'Usuarios Editar', 'Users', 'edit', '2018-09-28 04:22:23', NULL, NULL, 'active'),
(26, 'Usuarios Borrar', 'Users', 'userdelete', '2018-09-28 04:22:23', NULL, NULL, 'active'),
(24, 'Usuarios Alta', 'Users', 'add', '2018-09-28 04:22:23', NULL, NULL, 'active'),
(23, 'Usuarios', 'Users', 'index', '2018-09-28 04:22:23', NULL, NULL, 'active'),
(21, 'Permisos Editar', 'Permisos', 'edit', '2018-09-28 04:12:59', NULL, NULL, 'active'),
(22, 'Permisos Borrar', 'Permisos', 'permisodelete', '2018-09-28 04:12:59', NULL, NULL, 'active'),
(20, 'Permisos Alta', 'Permisos', 'add', '2018-09-28 04:12:59', NULL, NULL, 'active'),
(19, 'Permisos Asignar', 'Permisos', 'asignar', '2018-09-28 04:12:59', NULL, NULL, 'active'),
(18, 'Permisos', 'Permisos', 'index', '2018-09-28 04:12:59', NULL, NULL, 'active'),
(17, 'Vehiculos Imprimir Orden', 'Vehiculos', 'print', '2018-09-27 15:20:25', NULL, NULL, 'active'),
(16, 'Cliente Ver', 'Clientes', 'show', '2018-09-27 15:04:32', '2018-09-28 23:41:30', NULL, 'active'),
(15, 'Vehiculos Lista', 'Vehiculos', 'indexlist', '2018-09-27 14:02:07', NULL, NULL, 'active'),
(14, 'Taller Borrar', 'Catalogos', 'tallerdelete', '2018-09-27 02:48:28', NULL, NULL, 'active'),
(13, 'Taller Editar', 'Catalogos', 'talleredit', '2018-09-27 02:48:28', NULL, NULL, 'active'),
(12, 'Taller Alta', 'Catalogos', 'talleradd', '2018-09-27 02:48:28', NULL, NULL, 'active'),
(11, 'Talleres', 'Catalogos', 'taller', '2018-09-27 02:48:28', NULL, NULL, 'active'),
(10, 'Vehiculos Borrar', 'Vehiculos', 'vehiculodelete', '2018-09-27 02:33:14', NULL, NULL, 'active'),
(9, 'Clientes Borrar', 'Clientes', 'clientedelete', '2018-09-27 02:33:14', NULL, NULL, 'active'),
(8, 'Vehiculos Mostrar Orden', 'Vehiculos', 'showorden', '2018-09-27 02:33:14', NULL, NULL, 'active'),
(7, 'Vehiculos Ver', 'Vehiculos', 'view', '2018-09-27 02:33:14', NULL, NULL, 'active'),
(6, 'Vehiculos Editar', 'Vehiculos', 'edit', '2018-09-27 02:33:14', NULL, NULL, 'active'),
(5, 'Vehiculos Alta', 'Vehiculos', 'add', '2018-09-27 02:33:14', NULL, NULL, 'active'),
(4, 'Vehiculos', 'Vehiculos', 'index', '2018-09-27 02:23:22', NULL, NULL, 'active'),
(3, 'Clientes Editar', 'Clientes', 'edit', '2018-09-26 18:14:07', NULL, NULL, 'active'),
(2, 'Clientes Alta', 'Clientes', 'add', '2018-09-26 18:14:07', NULL, NULL, 'active'),
(1, 'Clientes', 'Clientes', 'index', '2018-09-26 18:14:07', NULL, NULL, 'active'),
(47, 'Servicio Paquete', 'Catalogos', 'paquete', '2018-10-13 17:39:24', NULL, NULL, 'active'),
(51, 'Asignar Servicios Paquete', 'Catalogos', 'serviciopaquete', '2018-10-13 17:57:13', NULL, NULL, 'active'),
(52, 'Refacciones', 'Catalogos', 'refaccion', '2018-10-23 02:43:45', NULL, NULL, 'active'),
(53, 'Refacciones Alta', 'Catalogos', 'refaccionadd', '2018-10-23 02:43:57', NULL, NULL, 'active'),
(54, 'Refacciones Editar', 'Catalogos', 'refaccionedit', '2018-10-23 02:44:11', NULL, NULL, 'active'),
(55, 'Refacciones Ver', 'Catalogos', 'refaccionshow', '2018-10-23 02:44:25', NULL, NULL, 'active'),
(56, 'pdf', 'Vehiculos', 'pdf', '2018-11-01 18:48:00', NULL, NULL, 'active'),
(57, 'Servicio Vehiculo Borrar', 'Vehiculos', 'vehiculoserviciodelete', '2018-11-30 20:40:16', NULL, NULL, 'active'),
(58, 'Refaccion Vehiculo Borrar', 'Vehiculos', 'vehiculorefacciondelete', '2018-11-30 20:40:16', NULL, NULL, 'active'),
(59, 'Pedidos', 'Pedidos', 'index', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(60, 'Pedidos Alta', 'Pedidos', 'add', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(61, 'Pedidos Ver', 'Pedidos', 'view', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(62, 'Pedidos Editar', 'Pedidos', 'edit', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(63, 'Pedidos Borrar', 'Pedidos', 'pedidodelete', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(64, 'Almacen', 'Catalogos', 'almacen', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(65, 'Proveedor', 'Catalogos', 'proveedor', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(66, 'Inventario', 'Inventarios', 'index', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(67, 'Proveedor Alta', 'Catalogos', 'proveedoradd', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(68, 'Proveedor Editar', 'Catalogos', 'proveedoredit', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(69, 'Proveedor Borrar', 'Catalogos', 'proveedordelete', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(70, 'Proveedor Ver', 'Catalogos', 'proveedorview', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(71, 'Almacen Alta', 'Catalogos', 'almacenadd', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(72, 'Almacen Editar', 'Catalogos', 'almacenedit', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(73, 'Almacen Ver', 'Catalogos', 'almacenview', '2019-01-04 05:58:34', NULL, NULL, 'active'),
(74, 'Almacen Borrar', 'Catalogos', 'almacendelete', '2019-01-04 05:58:34', NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_user`
--

CREATE TABLE `permiso_user` (
  `id` int(11) NOT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso_user`
--

INSERT INTO `permiso_user` (`id`, `id_permiso`, `id_user`, `created_date`) VALUES
(730, 27, 3, '2019-01-04 06:59:34'),
(729, 24, 3, '2019-01-04 06:59:34'),
(728, 22, 3, '2019-01-04 06:59:34'),
(727, 18, 3, '2019-01-04 06:59:34'),
(726, 21, 3, '2019-01-04 06:59:34'),
(725, 28, 3, '2019-01-04 06:59:34'),
(724, 19, 3, '2019-01-04 06:59:34'),
(723, 20, 3, '2019-01-04 06:59:34'),
(722, 61, 3, '2019-01-04 06:59:34'),
(721, 63, 3, '2019-01-04 06:59:34'),
(720, 59, 3, '2019-01-04 06:59:34'),
(719, 62, 3, '2019-01-04 06:59:34'),
(718, 60, 3, '2019-01-04 06:59:34'),
(717, 66, 3, '2019-01-04 06:59:34'),
(716, 16, 3, '2019-01-04 06:59:34'),
(715, 1, 3, '2019-01-04 06:59:34'),
(714, 3, 3, '2019-01-04 06:59:34'),
(713, 9, 3, '2019-01-04 06:59:34'),
(712, 2, 3, '2019-01-04 06:59:34'),
(711, 13, 3, '2019-01-04 06:59:34'),
(710, 14, 3, '2019-01-04 06:59:34'),
(709, 12, 3, '2019-01-04 06:59:34'),
(708, 11, 3, '2019-01-04 06:59:34'),
(707, 41, 3, '2019-01-04 06:59:34'),
(706, 42, 3, '2019-01-04 06:59:34'),
(705, 40, 3, '2019-01-04 06:59:34'),
(704, 39, 3, '2019-01-04 06:59:34'),
(703, 51, 3, '2019-01-04 06:59:34'),
(702, 45, 3, '2019-01-04 06:59:34'),
(701, 46, 3, '2019-01-04 06:59:34'),
(700, 44, 3, '2019-01-04 06:59:34'),
(699, 43, 3, '2019-01-04 06:59:34'),
(698, 55, 3, '2019-01-04 06:59:34'),
(697, 54, 3, '2019-01-04 06:59:34'),
(696, 53, 3, '2019-01-04 06:59:34'),
(695, 52, 3, '2019-01-04 06:59:34'),
(694, 70, 3, '2019-01-04 06:59:34'),
(693, 68, 3, '2019-01-04 06:59:34'),
(692, 69, 3, '2019-01-04 06:59:34'),
(691, 67, 3, '2019-01-04 06:59:34'),
(690, 65, 3, '2019-01-04 06:59:34'),
(689, 47, 3, '2019-01-04 06:59:34'),
(688, 36, 3, '2019-01-04 06:59:34'),
(687, 37, 3, '2019-01-04 06:59:34'),
(686, 35, 3, '2019-01-04 06:59:34'),
(685, 34, 3, '2019-01-04 06:59:34'),
(684, 32, 3, '2019-01-04 06:59:34'),
(683, 38, 3, '2019-01-04 06:59:34'),
(682, 31, 3, '2019-01-04 06:59:34'),
(681, 33, 3, '2019-01-04 06:59:34'),
(680, 73, 3, '2019-01-04 06:59:34'),
(679, 72, 3, '2019-01-04 06:59:34'),
(678, 74, 3, '2019-01-04 06:59:34'),
(677, 71, 3, '2019-01-04 06:59:34'),
(676, 64, 3, '2019-01-04 06:59:34'),
(731, 25, 3, '2019-01-04 06:59:34'),
(732, 23, 3, '2019-01-04 06:59:34'),
(733, 26, 3, '2019-01-04 06:59:34'),
(734, 29, 3, '2019-01-04 06:59:34'),
(735, 30, 3, '2019-01-04 06:59:34'),
(736, 5, 3, '2019-01-04 06:59:34'),
(737, 6, 3, '2019-01-04 06:59:34'),
(738, 4, 3, '2019-01-04 06:59:34'),
(739, 15, 3, '2019-01-04 06:59:34'),
(740, 56, 3, '2019-01-04 06:59:34'),
(741, 17, 3, '2019-01-04 06:59:34'),
(742, 8, 3, '2019-01-04 06:59:34'),
(743, 10, 3, '2019-01-04 06:59:34'),
(744, 58, 3, '2019-01-04 06:59:34'),
(745, 57, 3, '2019-01-04 06:59:34'),
(746, 7, 3, '2019-01-04 06:59:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_usertype`
--

CREATE TABLE `permiso_usertype` (
  `id` int(11) NOT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `id_usertype` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso_usertype`
--

INSERT INTO `permiso_usertype` (`id`, `id_permiso`, `id_usertype`, `status`) VALUES
(1, 33, 1, 'active'),
(2, 31, 1, 'active'),
(3, 38, 1, 'active'),
(4, 32, 1, 'active'),
(5, 34, 1, 'active'),
(6, 35, 1, 'active'),
(7, 37, 1, 'active'),
(8, 36, 1, 'active'),
(9, 47, 1, 'active'),
(10, 43, 1, 'active'),
(11, 44, 1, 'active'),
(12, 46, 1, 'active'),
(13, 45, 1, 'active'),
(14, 51, 1, 'active'),
(15, 39, 1, 'active'),
(16, 40, 1, 'active'),
(17, 42, 1, 'active'),
(18, 41, 1, 'active'),
(19, 11, 1, 'active'),
(20, 12, 1, 'active'),
(21, 14, 1, 'active'),
(22, 13, 1, 'active'),
(23, 2, 1, 'active'),
(24, 9, 1, 'active'),
(25, 3, 1, 'active'),
(26, 1, 1, 'active'),
(27, 16, 1, 'active'),
(28, 20, 1, 'active'),
(29, 19, 1, 'active'),
(30, 28, 1, 'active'),
(31, 21, 1, 'active'),
(32, 18, 1, 'active'),
(33, 22, 1, 'active'),
(34, 24, 1, 'active'),
(35, 27, 1, 'active'),
(36, 25, 1, 'active'),
(37, 23, 1, 'active'),
(38, 26, 1, 'active'),
(39, 29, 1, 'active'),
(40, 30, 1, 'active'),
(41, 5, 1, 'active'),
(42, 6, 1, 'active'),
(43, 4, 1, 'active'),
(44, 15, 1, 'active'),
(45, 17, 1, 'active'),
(46, 8, 1, 'active'),
(47, 10, 1, 'active'),
(48, 7, 1, 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `rfc` varchar(100) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refaccion`
--

CREATE TABLE `refaccion` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_submarca` int(11) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` text,
  `status` varchar(45) DEFAULT 'active',
  `modelo` varchar(45) DEFAULT NULL,
  `imagen_url` text,
  `costo_aprox` varchar(45) DEFAULT NULL,
  `costo_real` double DEFAULT NULL,
  `detalles` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `refaccion`
--

INSERT INTO `refaccion` (`id`, `id_marca`, `id_submarca`, `codigo`, `nombre`, `descripcion`, `status`, `modelo`, `imagen_url`, `costo_aprox`, `costo_real`, `detalles`) VALUES
(1, 1, 1, 'ref_1', 'refaccion1', 'prueba de refaccion', 'active', '2018', NULL, '100', 0, 0),
(2, 1, 1, 'ref_2', 'afinacion 2', 'prueba de refaccion 2', 'active', '2017', NULL, '150', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` text,
  `status` varchar(45) DEFAULT 'active',
  `detalles` int(11) DEFAULT '0',
  `id_user` varchar(45) DEFAULT NULL,
  `paquete` int(11) DEFAULT '0',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `codigo`, `nombre`, `descripcion`, `status`, `detalles`, `id_user`, `paquete`, `created_date`, `updated_date`, `deleted_date`) VALUES
(1, NULL, 'N/E', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:10', NULL, NULL),
(2, NULL, 'Afinación Mayor con Scanner', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:10', NULL, NULL),
(3, NULL, 'Afinación del Motor', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:10', NULL, NULL),
(4, NULL, 'Accesorios para autos y sistemas de seguridad', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(5, NULL, 'Cambio y Revisión de Baterías para Autos', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(6, NULL, 'Cambio de Frenos', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(7, NULL, 'Estética automotriz y limpieza profunda', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(8, 'pintura', 'Pintura', NULL, 'active', 1, NULL, 0, '2018-10-10 06:45:11', '2018-12-12 05:26:15', NULL),
(9, NULL, 'Nitrógeno para Llantas', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(10, NULL, 'Sistema de aire acondicionado automotriz', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(11, NULL, 'Sistemas de enfriamiento del motor', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(12, NULL, 'Sistemas de escape', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(13, NULL, 'Cambio de Suspensiones y Amortiguadores', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(14, NULL, 'Cambio de Aceite', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(15, NULL, 'Cambio de Discos y Pastillas de Freno', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(16, NULL, 'Sincronización', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(17, NULL, 'Kit de Embrague', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(18, NULL, 'Cambio Correa de Repartición', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(19, NULL, 'Reparación de Motor', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(20, NULL, 'Cambio de Amortiguadores', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(21, NULL, 'Eléctrica y Electrónica', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(22, NULL, 'Suspensión Mecánica', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(23, NULL, 'Reparación de Caja de Transmisión – Caja de Cambios', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(24, NULL, 'Mecánica General', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(25, NULL, 'Diagnóstico Automotriz', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(26, NULL, 'Revisión Técnico Mecánica', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(27, NULL, 'Peritaje', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(28, NULL, 'Revisión Mecánica', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(29, NULL, 'Lubricación y cambio de aceite', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(30, NULL, 'Reemplazo de acumulador', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(31, NULL, 'Suspensión', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(32, NULL, 'Alineación y Balanceo', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:11', NULL, NULL),
(33, NULL, 'Mofles', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(34, NULL, 'Rectificación y Torneado', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(35, NULL, 'Servicio de Clutch', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(36, NULL, 'Servicio de Diferenciales', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(37, NULL, 'Engrasado', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(38, NULL, 'Rotación', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(39, NULL, 'Revisión, limpieza y ajuste de frenos', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(40, NULL, 'Afinación Fuel Injection', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(41, NULL, 'Lavado de inyectores', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(42, NULL, 'Diagnóstico de fallo de motor por computadora', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(43, NULL, 'Sistema de frenos', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(44, NULL, 'Reparación de Suspensiones', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(45, NULL, 'Cambio de Clutch', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(46, NULL, 'Lavado y engrasado', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(47, NULL, 'Reparación de Marchas y Alternadores', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(48, NULL, 'Cambio de Silenciadores y Mofles', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(49, NULL, 'Reparación de Cajas Estándar', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(50, NULL, 'Revisión de Sistema de Carga (Batería)', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(51, NULL, 'Revisión de Aire Acondicionado', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(52, NULL, 'Mecánica en General', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(53, NULL, 'Arranques.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(54, NULL, 'Alternadores.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(55, NULL, 'Encendido.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(56, NULL, 'Electro ventiladores.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(57, NULL, 'Afinación completa.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(58, NULL, 'Bujías.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(59, NULL, 'Cables.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(60, NULL, 'Problemas de temperatura.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(61, NULL, 'Reparación y rectificación de motores.', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:12', NULL, NULL),
(62, NULL, 'Cambio de Correas de distribución', NULL, 'active', 0, NULL, 0, '2018-10-10 06:45:13', NULL, NULL),
(63, 'pqte_1', 'afinacion 1', 'toda la afinacion', 'active', 0, NULL, 1, '2018-10-16 14:27:12', NULL, NULL),
(64, 'pqte_2', 'afinacion 2', 'toda la afinacion', 'active', 0, NULL, 1, '2018-10-16 18:44:57', NULL, NULL),
(65, 'mano_obra', 'Mano de Obra', '', 'active', 1, NULL, 0, '2018-11-08 18:09:21', '2018-11-08 18:16:14', NULL),
(66, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:11:29', NULL, NULL),
(67, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:11:42', NULL, NULL),
(68, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:11:56', NULL, NULL),
(69, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:12:03', NULL, NULL),
(70, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:12:32', NULL, NULL),
(71, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:12:36', NULL, NULL),
(72, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:12:43', NULL, NULL),
(73, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:36:24', NULL, NULL),
(74, NULL, NULL, NULL, 'active', 0, NULL, 0, '2018-12-12 17:37:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_paquete`
--

CREATE TABLE `servicio_paquete` (
  `id` int(11) NOT NULL,
  `id_serviciopaquete` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_paquete`
--

INSERT INTO `servicio_paquete` (`id`, `id_serviciopaquete`, `id_servicio`, `status`, `created_date`, `deleted_date`) VALUES
(1, 63, 2, 'active', '2018-10-16 14:58:02', NULL),
(2, 63, 3, 'active', '2018-10-16 14:58:02', NULL),
(3, 63, 24, 'active', '2018-10-16 14:58:02', NULL),
(4, 63, 25, 'active', '2018-10-16 14:58:02', NULL),
(5, 63, 35, 'active', '2018-10-16 14:58:02', NULL),
(6, 64, 2, 'active', '2018-10-16 18:45:16', NULL),
(7, 64, 5, 'active', '2018-10-16 18:45:16', NULL),
(8, 64, 20, 'active', '2018-10-16 18:45:16', NULL),
(9, 64, 34, 'active', '2018-10-16 18:45:16', NULL),
(10, 64, 48, 'active', '2018-10-16 18:45:16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` int(11) NOT NULL,
  `id_auto` int(11) DEFAULT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `folio` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` varchar(45) DEFAULT NULL,
  `deleted_date` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_refaccion`
--

CREATE TABLE `solicitud_refaccion` (
  `id` int(11) NOT NULL,
  `id_refaccion` int(11) DEFAULT NULL,
  `cantidad` varchar(10) DEFAULT NULL,
  `precio_recomendado` double DEFAULT NULL,
  `precio_real` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `status_autorizacion` varchar(45) DEFAULT 'pendiente',
  `fecha_estimadaentrega` timestamp NULL DEFAULT NULL,
  `fecha_entrega` timestamp NULL DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `chkIngresa` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_marca`
--

CREATE TABLE `sub_marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sub_marca`
--

INSERT INTO `sub_marca` (`id`, `nombre`, `id_marca`, `status`) VALUES
(1, 'ILX', 1, 'active'),
(2, 'MDX', 1, 'active'),
(3, 'MKX', 1, 'active'),
(4, 'NSX', 1, 'active'),
(5, 'RDX', 1, 'active'),
(6, 'RL', 1, 'active'),
(7, 'RLX', 1, 'active'),
(8, 'TL', 1, 'active'),
(9, 'TSX', 1, 'active'),
(10, 'ZDX', 1, 'active'),
(11, '145', 2, 'active'),
(12, '147', 2, 'active'),
(13, '156', 2, 'active'),
(14, '159', 2, 'active'),
(15, '166', 2, 'active'),
(16, 'Brera', 2, 'active'),
(17, 'Giulietta', 2, 'active'),
(18, 'GT', 2, 'active'),
(19, 'GTV', 2, 'active'),
(20, 'Mito', 2, 'active'),
(21, 'Spider', 2, 'active'),
(22, 'DB9', 3, 'active'),
(23, 'DBS', 3, 'active'),
(24, 'Lagonda', 3, 'active'),
(25, 'Rapide', 3, 'active'),
(26, 'V12 Vantage', 3, 'active'),
(27, 'V8 Vantage', 3, 'active'),
(28, 'Vanquish', 3, 'active'),
(29, 'Virage', 3, 'active'),
(30, 'A1', 4, 'active'),
(31, 'A3', 4, 'active'),
(32, 'A4', 4, 'active'),
(33, 'A5', 4, 'active'),
(34, 'A6', 4, 'active'),
(35, 'A7', 4, 'active'),
(36, 'A8', 4, 'active'),
(37, 'A9', 4, 'active'),
(38, 'Allroad', 4, 'active'),
(39, 'Q3', 4, 'active'),
(40, 'Q5', 4, 'active'),
(41, 'Q6', 4, 'active'),
(42, 'Q7', 4, 'active'),
(43, 'R8', 4, 'active'),
(44, 'RS3 Sportback', 4, 'active'),
(45, 'RS4', 4, 'active'),
(46, 'RS5', 4, 'active'),
(47, 'RS6', 4, 'active'),
(48, 'S1', 4, 'active'),
(49, 'S3', 4, 'active'),
(50, 'S4', 4, 'active'),
(51, 'S5', 4, 'active'),
(52, 'S6', 4, 'active'),
(53, 'S8', 4, 'active'),
(54, 'TT', 4, 'active'),
(55, 'TTS', 4, 'active'),
(56, 'Continental GT', 5, 'active'),
(57, 'Flying Spur', 5, 'active'),
(58, 'M1', 6, 'active'),
(59, 'M3', 6, 'active'),
(60, 'M5', 6, 'active'),
(61, 'M6', 6, 'active'),
(62, 'Serie 1', 6, 'active'),
(63, 'Serie 2', 6, 'active'),
(64, 'Serie 3', 6, 'active'),
(65, 'Serie 4', 6, 'active'),
(66, 'Serie 5', 6, 'active'),
(67, 'Serie 6', 6, 'active'),
(68, 'Serie 7', 6, 'active'),
(69, 'Serie 8', 6, 'active'),
(70, 'X1', 6, 'active'),
(71, 'X3', 6, 'active'),
(72, 'X4', 6, 'active'),
(73, 'X5', 6, 'active'),
(74, 'X5 M', 6, 'active'),
(75, 'X6 ', 6, 'active'),
(76, 'X6 M', 6, 'active'),
(77, 'Z3', 6, 'active'),
(78, 'Z6', 6, 'active'),
(79, 'Enclave', 7, 'active'),
(80, 'LaCrosse', 7, 'active'),
(81, 'Regal', 7, 'active'),
(82, 'Verano', 7, 'active'),
(83, 'BLS', 8, 'active'),
(84, 'Catera', 8, 'active'),
(85, 'CTS', 8, 'active'),
(86, 'CTS Coupe', 8, 'active'),
(87, 'Deville', 8, 'active'),
(88, 'DTS', 8, 'active'),
(89, 'El Dorado', 8, 'active'),
(90, 'Escalade', 8, 'active'),
(91, 'Escalade ESV', 8, 'active'),
(92, 'Escalade EXT', 8, 'active'),
(93, 'Fleetwood', 8, 'active'),
(94, 'Seville', 8, 'active'),
(95, 'SLS', 8, 'active'),
(96, 'SRX', 8, 'active'),
(97, 'STS', 8, 'active'),
(98, 'XRL', 8, 'active'),
(99, 'XTS', 8, 'active'),
(100, '1500', 9, 'active'),
(101, '3500', 9, 'active'),
(102, '454', 9, 'active'),
(103, 'Aerostar', 9, 'active'),
(104, 'Apache', 9, 'active'),
(105, 'Astra', 9, 'active'),
(106, 'Astro Safari', 9, 'active'),
(107, 'Astro Van', 9, 'active'),
(108, 'Avalanche', 9, 'active'),
(109, 'Aveo', 9, 'active'),
(110, 'Beretta', 9, 'active'),
(111, 'Blazer', 9, 'active'),
(112, 'Buick', 9, 'active'),
(113, 'C-15', 9, 'active'),
(114, 'C-20', 9, 'active'),
(115, 'Camaro', 9, 'active'),
(116, 'Caprice', 9, 'active'),
(117, 'Captiva', 9, 'active'),
(118, 'Cavalier', 9, 'active'),
(119, 'Cavalier Z24', 9, 'active'),
(120, 'Celebrity', 9, 'active'),
(121, 'Century', 9, 'active'),
(122, 'Chevelle', 9, 'active'),
(123, 'Chevette', 9, 'active'),
(124, 'Chevy', 9, 'active'),
(125, 'Chevy Nova', 9, 'active'),
(126, 'Chevy Pick Up', 9, 'active'),
(127, 'Chevi Van', 9, 'active'),
(128, 'Cheyenne', 9, 'active'),
(129, 'Colorado', 9, 'active'),
(130, 'Corsa', 9, 'active'),
(131, 'Corvette', 9, 'active'),
(132, 'Cruze', 9, 'active'),
(133, 'Cutlass', 9, 'active'),
(134, 'Epica', 9, 'active'),
(135, 'Equinox', 9, 'active'),
(136, 'Express Van', 9, 'active'),
(137, 'Geo', 9, 'active'),
(138, 'HHR', 9, 'active'),
(139, 'Hi-Top', 9, 'active'),
(140, 'Impala', 9, 'active'),
(141, 'Kodiak', 9, 'active'),
(142, 'Lumina', 9, 'active'),
(143, 'LUV', 9, 'active'),
(144, 'Malibu', 9, 'active'),
(145, 'Matiz', 9, 'active'),
(146, 'Meriva', 9, 'active'),
(147, 'Monte Carlo', 9, 'active'),
(148, 'Monza', 9, 'active'),
(149, 'Oldsmobile', 9, 'active'),
(150, 'Optra', 9, 'active'),
(151, 'Orlando', 9, 'active'),
(152, 'Pick-Up', 9, 'active'),
(153, 'Routan', 9, 'active'),
(154, 'S10', 9, 'active'),
(155, 'Saturn', 9, 'active'),
(156, 'Savana', 9, 'active'),
(157, 'Sierra', 9, 'active'),
(158, 'Silhouette', 9, 'active'),
(159, 'Silverado', 9, 'active'),
(160, 'Sonic', 9, 'active'),
(161, 'Sonora', 9, 'active'),
(162, 'Spark', 9, 'active'),
(163, 'Suburban', 9, 'active'),
(164, 'Tahoe', 9, 'active'),
(165, 'Tigra', 9, 'active'),
(166, 'Tornado', 9, 'active'),
(167, 'Tracker', 9, 'active'),
(168, 'TrailBlazer', 9, 'active'),
(169, 'Transport', 9, 'active'),
(170, 'Traverse', 9, 'active'),
(171, 'Trax', 9, 'active'),
(172, 'Uplander', 9, 'active'),
(173, 'Vanette', 9, 'active'),
(174, 'Vectra', 9, 'active'),
(175, 'Venture', 9, 'active'),
(176, 'Volt', 9, 'active'),
(177, 'Zafira', 9, 'active'),
(178, '200', 10, 'active'),
(179, '300C', 10, 'active'),
(180, '300M', 10, 'active'),
(181, '300S', 10, 'active'),
(182, 'Aspen', 10, 'active'),
(183, 'Atos', 10, 'active'),
(184, 'Barracuda', 10, 'active'),
(185, 'Caravan', 10, 'active'),
(186, 'Cirrus', 10, 'active'),
(187, 'Concorde', 10, 'active'),
(188, 'Crossfire', 10, 'active'),
(189, 'Dart', 10, 'active'),
(190, 'Grand Caravan', 10, 'active'),
(191, 'Grand Voyager', 10, 'active'),
(192, 'Imperial', 10, 'active'),
(193, 'Intrepid', 10, 'active'),
(194, 'Le Baron', 10, 'active'),
(195, 'Magnum', 10, 'active'),
(196, 'Newyorker', 10, 'active'),
(197, 'Pacifica', 10, 'active'),
(198, 'Phantom', 10, 'active'),
(199, 'Plymount', 10, 'active'),
(200, 'PT Cruiser', 10, 'active'),
(201, 'Sebring', 10, 'active'),
(202, 'Shadow', 10, 'active'),
(203, 'Spirit', 10, 'active'),
(204, 'Town & Country', 10, 'active'),
(205, 'Voyager', 10, 'active'),
(206, '1000', 11, 'active'),
(207, 'Acapulco', 11, 'active'),
(208, 'Atos', 11, 'active'),
(209, 'Attitude', 11, 'active'),
(210, 'Avenger', 11, 'active'),
(211, 'Caliber', 11, 'active'),
(212, 'Caravan', 11, 'active'),
(213, 'Challenger', 11, 'active'),
(214, 'Charger', 11, 'active'),
(215, 'Coronet', 11, 'active'),
(216, 'D 100', 11, 'active'),
(217, 'D 150', 11, 'active'),
(218, 'D 250', 11, 'active'),
(219, 'D 350', 11, 'active'),
(220, 'Dakota', 11, 'active'),
(221, 'Dart', 11, 'active'),
(222, 'Durango', 11, 'active'),
(223, 'Grand Caravan', 11, 'active'),
(224, 'H100', 11, 'active'),
(225, 'Intrepid', 11, 'active'),
(226, 'Journey', 11, 'active'),
(227, 'Neon', 11, 'active'),
(228, 'Nitro', 11, 'active'),
(229, 'Pick-Up', 11, 'active'),
(230, 'Power Wagon', 11, 'active'),
(231, 'Ram', 11, 'active'),
(232, 'Stratus', 11, 'active'),
(233, 'Verna', 11, 'active'),
(234, 'Viper', 11, 'active'),
(235, 'F1', 12, 'active'),
(236, 'F4', 12, 'active'),
(237, 'F5', 12, 'active'),
(238, '308', 13, 'active'),
(239, '350', 13, 'active'),
(240, '355', 13, 'active'),
(241, '360', 13, 'active'),
(242, '430', 13, 'active'),
(243, '456', 13, 'active'),
(244, '550', 13, 'active'),
(245, '575', 13, 'active'),
(246, '599', 13, 'active'),
(247, '612', 13, 'active'),
(248, 'California', 13, 'active'),
(249, 'Enzo', 13, 'active'),
(250, 'F150', 13, 'active'),
(251, '500', 14, 'active'),
(252, 'Albea', 14, 'active'),
(253, 'Bravo', 14, 'active'),
(254, 'Ducato', 14, 'active'),
(255, 'Grande Punto', 14, 'active'),
(256, 'Idea', 14, 'active'),
(257, 'Idea Adventure', 14, 'active'),
(258, 'Linea', 14, 'active'),
(259, 'Mio', 14, 'active'),
(260, 'Palio', 14, 'active'),
(261, 'Palio Adventure', 14, 'active'),
(262, 'Panda', 14, 'active'),
(263, 'Punto', 14, 'active'),
(264, 'Stilo', 14, 'active'),
(265, 'Strada', 14, 'active'),
(266, 'Uno', 14, 'active'),
(267, 'Aerostar', 15, 'active'),
(268, 'Bronco', 15, 'active'),
(269, 'Club Wagon', 15, 'active'),
(270, 'Contour', 15, 'active'),
(271, 'Cougar', 15, 'active'),
(272, 'Courier', 15, 'active'),
(273, 'Crown Victoria', 15, 'active'),
(274, 'E-150', 15, 'active'),
(275, 'E-350', 15, 'active'),
(276, 'Econoline', 15, 'active'),
(277, 'EcoSport', 15, 'active'),
(278, 'Edge', 15, 'active'),
(279, 'Escape', 15, 'active'),
(280, 'Escort', 15, 'active'),
(281, 'Excursion', 15, 'active'),
(282, 'Expedition', 15, 'active'),
(283, 'F-100', 15, 'active'),
(284, 'F-150', 15, 'active'),
(285, 'F-200', 15, 'active'),
(286, 'F-250', 15, 'active'),
(287, 'F-350', 15, 'active'),
(288, 'F-450', 15, 'active'),
(289, 'F-550', 15, 'active'),
(290, 'F-600', 15, 'active'),
(291, 'F-800', 15, 'active'),
(292, 'Fairlane', 15, 'active'),
(293, 'Fairmont', 15, 'active'),
(294, 'Falcon', 15, 'active'),
(295, 'Festiva', 15, 'active'),
(296, 'Fiesta', 15, 'active'),
(297, 'Five Hundred', 15, 'active'),
(298, 'Focus', 15, 'active'),
(299, 'Ford GT', 15, 'active'),
(300, 'Freestar', 15, 'active'),
(301, 'Fusion', 15, 'active'),
(302, 'Ghia', 15, 'active'),
(303, 'Grand Marquis', 15, 'active'),
(304, 'Harley Davidson', 15, 'active'),
(305, 'Ikon', 15, 'active'),
(306, 'Ka', 15, 'active'),
(307, 'Lobo', 15, 'active'),
(308, 'Lobo Raptor SVT', 15, 'active'),
(309, 'LTD', 15, 'active'),
(310, 'Maverick', 15, 'active'),
(311, 'Mercury', 15, 'active'),
(312, 'Mondeo', 15, 'active'),
(313, 'Mustang', 15, 'active'),
(314, 'Mystique', 15, 'active'),
(315, 'Pick-Up', 15, 'active'),
(316, 'Police', 15, 'active'),
(317, 'Probe', 15, 'active'),
(318, 'Ranger', 15, 'active'),
(319, 'Sable', 15, 'active'),
(320, 'Taurus', 15, 'active'),
(321, 'Thunderbird', 15, 'active'),
(322, 'Topaz', 15, 'active'),
(323, 'Transit', 15, 'active'),
(324, 'Villager', 15, 'active'),
(325, 'Windstar', 15, 'active'),
(326, 'Acadia', 16, 'active'),
(327, 'AstroVan', 16, 'active'),
(328, 'Canyon', 16, 'active'),
(329, 'Jimmy', 16, 'active'),
(330, 'Pick-Up', 16, 'active'),
(331, 'Savana', 16, 'active'),
(332, 'Sierra', 16, 'active'),
(333, 'Sonoma', 16, 'active'),
(334, 'Terrain', 16, 'active'),
(335, 'Yukon', 16, 'active'),
(336, 'Accord', 17, 'active'),
(337, 'Acura', 17, 'active'),
(338, 'City', 17, 'active'),
(339, 'Civic', 17, 'active'),
(340, 'CR-V', 17, 'active'),
(341, 'CR-Z', 17, 'active'),
(342, 'Crosstour', 17, 'active'),
(343, 'CRX', 17, 'active'),
(344, 'Element', 17, 'active'),
(345, 'Fit', 17, 'active'),
(346, 'Insight', 17, 'active'),
(347, 'Odyssey', 17, 'active'),
(348, 'Passport', 17, 'active'),
(349, 'Pilot', 17, 'active'),
(350, 'Prelude', 17, 'active'),
(351, 'Ridgeline', 17, 'active'),
(352, 'H1', 18, 'active'),
(353, 'H2', 18, 'active'),
(354, 'H3', 18, 'active'),
(355, 'Accent', 19, 'active'),
(356, 'Atos', 19, 'active'),
(357, 'Azera', 19, 'active'),
(358, 'Elantra', 19, 'active'),
(359, 'Equus', 19, 'active'),
(360, 'Genesis', 19, 'active'),
(361, 'Getz', 19, 'active'),
(362, 'H1', 19, 'active'),
(363, 'H100', 19, 'active'),
(364, 'i10', 19, 'active'),
(365, 'i20', 19, 'active'),
(366, 'i30', 19, 'active'),
(367, 'Ix35', 19, 'active'),
(368, 'Matrix', 19, 'active'),
(369, 'Santa Fe', 19, 'active'),
(370, 'Sonata', 19, 'active'),
(371, 'Tucson', 19, 'active'),
(372, 'Veloster', 19, 'active'),
(373, 'Veracruz', 19, 'active'),
(374, 'FX', 20, 'active'),
(375, 'FX 35', 20, 'active'),
(376, 'FX50', 20, 'active'),
(377, 'G37', 20, 'active'),
(378, 'i30', 20, 'active'),
(379, 'I35', 20, 'active'),
(380, 'M37', 20, 'active'),
(381, 'M56', 20, 'active'),
(382, 'Q45', 20, 'active'),
(383, 'QX', 20, 'active'),
(384, 'QX56', 20, 'active'),
(385, 'Amigo', 21, 'active'),
(386, 'Pick-Up', 21, 'active'),
(387, 'Rodeo', 21, 'active'),
(388, 'Trooper', 21, 'active'),
(389, 'F-Type', 22, 'active'),
(390, 'S-Type', 22, 'active'),
(391, 'X-Type', 22, 'active'),
(392, 'XF', 22, 'active'),
(393, 'XJ', 22, 'active'),
(394, 'XK', 22, 'active'),
(395, 'XKR', 22, 'active'),
(396, 'Cherokee', 23, 'active'),
(397, 'Cherokee Sport', 23, 'active'),
(398, 'CJ5', 23, 'active'),
(399, 'CJ7', 23, 'active'),
(400, 'Comanche', 23, 'active'),
(401, 'Commander', 23, 'active'),
(402, 'Compass', 23, 'active'),
(403, 'Grand Cherokee', 23, 'active'),
(404, 'Grand Wagoneer', 23, 'active'),
(405, 'Liberty', 23, 'active'),
(406, 'Patriot', 23, 'active'),
(407, 'Renegado', 23, 'active'),
(408, 'Rubicon', 23, 'active'),
(409, 'Wagonner', 23, 'active'),
(410, 'Willys', 23, 'active'),
(411, 'Wrangler', 23, 'active'),
(412, 'Aventador', 24, 'active'),
(413, 'Cala', 24, 'active'),
(414, 'Cnossus', 24, 'active'),
(415, 'Concept S', 24, 'active'),
(416, 'Diablo', 24, 'active'),
(417, 'Espada', 24, 'active'),
(418, 'Estoque', 24, 'active'),
(419, 'Gallardo', 24, 'active'),
(420, 'Hamann Gallardo', 24, 'active'),
(421, 'Huracan', 24, 'active'),
(422, 'Miura', 24, 'active'),
(423, 'Murcielago', 24, 'active'),
(424, 'Sesto Elemento', 24, 'active'),
(425, 'Defender', 25, 'active'),
(426, 'Discovery', 25, 'active'),
(427, 'Evoque', 25, 'active'),
(428, 'Freelander', 25, 'active'),
(429, 'LR2', 25, 'active'),
(430, 'LR3', 25, 'active'),
(431, 'LR4', 25, 'active'),
(432, 'LRX', 25, 'active'),
(433, 'Range Rover', 25, 'active'),
(434, 'Range Rover Sport', 25, 'active'),
(435, 'ES', 26, 'active'),
(436, 'GS', 26, 'active'),
(437, 'GX', 26, 'active'),
(438, 'IS', 26, 'active'),
(439, 'LS', 26, 'active'),
(440, 'LX', 26, 'active'),
(441, 'RX', 26, 'active'),
(442, 'Aviator', 27, 'active'),
(443, 'Black Wood', 27, 'active'),
(444, 'Continental', 27, 'active'),
(445, 'LS', 27, 'active'),
(446, 'Mark LT', 27, 'active'),
(447, 'Mark VII', 27, 'active'),
(448, 'Mark VIII', 27, 'active'),
(449, 'MKS', 27, 'active'),
(450, 'MKX', 27, 'active'),
(451, 'MKZ', 27, 'active'),
(452, 'Navigator', 27, 'active'),
(453, 'Town Car', 27, 'active'),
(454, 'Zephyr', 27, 'active'),
(455, 'Grancabrio', 28, 'active'),
(456, 'Granturismo', 28, 'active'),
(457, 'Quattroporte', 28, 'active'),
(458, 'Mazda 6', 29, 'active'),
(459, 'CX-5', 29, 'active'),
(460, 'CX-7', 29, 'active'),
(461, 'CX-9', 29, 'active'),
(462, 'Mazda 2', 29, 'active'),
(463, 'Mazda 3', 29, 'active'),
(464, 'Mazda 5', 29, 'active'),
(465, 'Mazda Speed 3', 29, 'active'),
(466, 'MX-5', 29, 'active'),
(467, 'MX-6', 29, 'active'),
(468, 'Pick-Up', 29, 'active'),
(469, 'Protege', 29, 'active'),
(470, '220', 30, 'active'),
(471, '230', 30, 'active'),
(472, '250', 30, 'active'),
(473, '280 SE', 30, 'active'),
(474, '300 D', 30, 'active'),
(475, '300 SE', 30, 'active'),
(476, '450', 30, 'active'),
(477, '450 SL', 30, 'active'),
(478, '450 SLC', 30, 'active'),
(479, '500', 30, 'active'),
(480, '500 SEL', 30, 'active'),
(481, '560 SEC', 30, 'active'),
(482, 'Clase A', 30, 'active'),
(483, 'Clase B', 30, 'active'),
(484, 'Clase C', 30, 'active'),
(485, 'Clase CL', 30, 'active'),
(486, 'Clase CLA', 30, 'active'),
(487, 'Clase CLS', 30, 'active'),
(488, 'Clase E', 30, 'active'),
(489, 'Clase G', 30, 'active'),
(490, 'Clase GL', 30, 'active'),
(491, 'Clase GLK', 30, 'active'),
(492, 'Clase M', 30, 'active'),
(493, 'Clase R', 30, 'active'),
(494, 'Clase S', 30, 'active'),
(495, 'Clase SL', 30, 'active'),
(496, 'Clase SLK', 30, 'active'),
(497, 'Clase SLR', 30, 'active'),
(498, 'CLK', 30, 'active'),
(499, 'GLA', 30, 'active'),
(500, 'ML', 30, 'active'),
(501, 'SLS', 30, 'active'),
(502, 'Smart', 30, 'active'),
(503, 'Sprinter', 30, 'active'),
(504, 'Vito', 30, 'active'),
(505, 'Mariner', 31, 'active'),
(506, 'Milan', 31, 'active'),
(507, 'Montainer', 31, 'active'),
(508, 'Montego', 31, 'active'),
(509, 'Mystique', 31, 'active'),
(510, 'Villager', 31, 'active'),
(511, 'TF', 32, 'active'),
(512, 'ZR', 32, 'active'),
(513, 'ZT', 32, 'active'),
(514, 'Clubmano', 33, 'active'),
(515, 'Cooper', 33, 'active'),
(516, 'Countryman', 33, 'active'),
(517, 'John Cooper Works', 33, 'active'),
(518, '3000 GT', 34, 'active'),
(519, 'Eclipse', 34, 'active'),
(520, 'Endeavor', 34, 'active'),
(521, 'Expo', 34, 'active'),
(522, 'Galant', 34, 'active'),
(523, 'Grandis', 34, 'active'),
(524, 'L200', 34, 'active'),
(525, 'Lancer', 34, 'active'),
(526, 'Mirage', 34, 'active'),
(527, 'Montero', 34, 'active'),
(528, 'Outlander', 34, 'active'),
(529, 'Sigma', 34, 'active'),
(530, 'Wagon Space', 34, 'active'),
(531, '240 SX', 35, 'active'),
(532, '300 ZX', 35, 'active'),
(533, '350 Z', 35, 'active'),
(534, '370Z', 35, 'active'),
(535, 'Almera', 35, 'active'),
(536, 'Altima', 35, 'active'),
(537, 'Aprio', 35, 'active'),
(538, 'Armada', 35, 'active'),
(539, 'Cabstar', 35, 'active'),
(540, 'Doble cabina', 35, 'active'),
(541, 'Frontier', 35, 'active'),
(542, 'Hikari', 35, 'active'),
(543, 'Ichi Van', 35, 'active'),
(544, 'Infiniti', 35, 'active'),
(545, 'Juke', 35, 'active'),
(546, 'Leaf', 35, 'active'),
(547, 'Lucino', 35, 'active'),
(548, 'March', 35, 'active'),
(549, 'Maxima', 35, 'active'),
(550, 'Micra', 35, 'active'),
(551, 'Murano', 35, 'active'),
(552, 'Note', 35, 'active'),
(553, 'NP300', 35, 'active'),
(554, 'Pathfinder', 35, 'active'),
(555, 'Pick-Up', 35, 'active'),
(556, 'Pick-Up Estanquitas', 35, 'active'),
(557, 'Platina', 35, 'active'),
(558, 'Quest', 35, 'active'),
(559, 'Rogue', 35, 'active'),
(560, 'SE-R', 35, 'active'),
(561, 'Sentra', 35, 'active'),
(562, 'Tiida', 35, 'active'),
(563, 'Titan', 35, 'active'),
(564, 'Tsubame', 35, 'active'),
(565, 'Tsuru', 35, 'active'),
(566, 'Tsuru II', 35, 'active'),
(567, 'Urvan', 35, 'active'),
(568, 'Versa', 35, 'active'),
(569, 'X-Terra', 35, 'active'),
(570, 'X-Trail', 35, 'active'),
(571, 'Yuke', 35, 'active'),
(572, '206', 36, 'active'),
(573, '207', 36, 'active'),
(574, '208', 36, 'active'),
(575, '3008', 36, 'active'),
(576, '301', 36, 'active'),
(577, '306', 36, 'active'),
(578, '307', 36, 'active'),
(579, '307 SW', 36, 'active'),
(580, '308', 36, 'active'),
(581, '405', 36, 'active'),
(582, '406', 36, 'active'),
(583, '407', 36, 'active'),
(584, '508', 36, 'active'),
(585, '607', 36, 'active'),
(586, 'Expert', 36, 'active'),
(587, 'Grand Raid', 36, 'active'),
(588, 'Manager', 36, 'active'),
(589, 'Partner', 36, 'active'),
(590, 'RCZ', 36, 'active'),
(591, 'Aztek', 37, 'active'),
(592, 'Boneville', 37, 'active'),
(593, 'Fiero', 37, 'active'),
(594, 'Firebird', 37, 'active'),
(595, 'G3', 37, 'active'),
(596, 'G4', 37, 'active'),
(597, 'G5', 37, 'active'),
(598, 'G6', 37, 'active'),
(599, 'Grand Am', 37, 'active'),
(600, 'Grand Prix', 37, 'active'),
(601, 'Matiz', 37, 'active'),
(602, 'Minivan', 37, 'active'),
(603, 'Montana', 37, 'active'),
(604, 'Solstice', 37, 'active'),
(605, 'Sunfire', 37, 'active'),
(606, 'Torrent', 37, 'active'),
(607, 'Trans Am', 37, 'active'),
(608, 'Trans Sport', 37, 'active'),
(609, '911', 38, 'active'),
(610, '918', 38, 'active'),
(611, '918 SPYDER', 38, 'active'),
(612, '924', 38, 'active'),
(613, '928', 38, 'active'),
(614, '930', 38, 'active'),
(615, 'Boxster', 38, 'active'),
(616, 'Carrera', 38, 'active'),
(617, 'Cayenne', 38, 'active'),
(618, 'Cayman', 38, 'active'),
(619, 'Panamera', 38, 'active'),
(620, 'Speedster', 38, 'active'),
(621, 'Alliance', 39, 'active'),
(622, 'Captur', 39, 'active'),
(623, 'Clio', 39, 'active'),
(624, 'Duster', 39, 'active'),
(625, 'Encore', 39, 'active'),
(626, 'Fluence', 39, 'active'),
(627, 'Kangoo', 39, 'active'),
(628, 'Kangoo Express', 39, 'active'),
(629, 'Koleos', 39, 'active'),
(630, 'Laguna', 39, 'active'),
(631, 'Latitude', 39, 'active'),
(632, 'Megane', 39, 'active'),
(633, 'R10', 39, 'active'),
(634, 'R12', 39, 'active'),
(635, 'R18', 39, 'active'),
(636, 'R5', 39, 'active'),
(637, 'R8', 39, 'active'),
(638, 'Safrane', 39, 'active'),
(639, 'Sandero', 39, 'active'),
(640, 'Scala', 39, 'active'),
(641, 'Scenic', 39, 'active'),
(642, 'Stepway', 39, 'active'),
(643, 'Trafic', 39, 'active'),
(644, 'Wind', 39, 'active'),
(645, 'Zoe', 39, 'active'),
(646, '9-3', 40, 'active'),
(647, '9-4X', 40, 'active'),
(648, '9-5', 40, 'active'),
(649, 'Spyker 9', 40, 'active'),
(650, 'XV Concept', 40, 'active'),
(651, 'Alhambra', 41, 'active'),
(652, 'Altea', 41, 'active'),
(653, 'Bocanegra', 41, 'active'),
(654, 'Cordoba', 41, 'active'),
(655, 'Exeo', 41, 'active'),
(656, 'Freetrack', 41, 'active'),
(657, 'Ibiza', 41, 'active'),
(658, 'Leon', 41, 'active'),
(659, 'Toledo', 41, 'active'),
(660, 'Forfour', 42, 'active'),
(661, 'Fortwo', 42, 'active'),
(662, 'Roadster', 42, 'active'),
(663, 'B9 Tribeca', 43, 'active'),
(664, 'Forester', 43, 'active'),
(665, 'Impreza', 43, 'active'),
(666, 'Legacy', 43, 'active'),
(667, 'Outback', 43, 'active'),
(668, 'XV', 43, 'active'),
(669, 'Aerio', 44, 'active'),
(670, 'Grand Vitara', 44, 'active'),
(671, 'Kizashi', 44, 'active'),
(672, 'Samurai', 44, 'active'),
(673, 'Swift', 44, 'active'),
(674, 'SX4', 44, 'active'),
(675, 'XL7', 44, 'active'),
(676, '4Runner', 45, 'active'),
(677, 'Avalon', 45, 'active'),
(678, 'Avanza', 45, 'active'),
(679, 'Camry', 45, 'active'),
(680, 'Celica', 45, 'active'),
(681, 'Corolla', 45, 'active'),
(682, 'Corona', 45, 'active'),
(683, 'Echo', 45, 'active'),
(684, 'FJ Cruiser', 45, 'active'),
(685, 'Hiace', 45, 'active'),
(686, 'Highlander', 45, 'active'),
(687, 'Hilux', 45, 'active'),
(688, 'Land Cruiser', 45, 'active'),
(689, 'Matrix', 45, 'active'),
(690, 'MR2', 45, 'active'),
(691, 'Paseo', 45, 'active'),
(692, 'Pick-Up', 45, 'active'),
(693, 'Previa', 45, 'active'),
(694, 'Prius', 45, 'active'),
(695, 'RAV4', 45, 'active'),
(696, 'Rush', 45, 'active'),
(697, 'Scion', 45, 'active'),
(698, 'Sequoia', 45, 'active'),
(699, 'Sienna', 45, 'active'),
(700, 'Solara', 45, 'active'),
(701, 'Supra', 45, 'active'),
(702, 'T-100', 45, 'active'),
(703, 'Tacoma', 45, 'active'),
(704, 'Tercel', 45, 'active'),
(705, 'Tundra', 45, 'active'),
(706, 'Yaris', 45, 'active'),
(707, 'Amarok', 46, 'active'),
(708, 'Atlantic', 46, 'active'),
(709, 'Beetle', 46, 'active'),
(710, 'Bora', 46, 'active'),
(711, 'Bora Sportwagen', 46, 'active'),
(712, 'Brasilia', 46, 'active'),
(713, 'Cabriolet', 46, 'active'),
(714, 'Caribe', 46, 'active'),
(715, 'CC', 46, 'active'),
(716, 'Clasico', 46, 'active'),
(717, 'Combi', 46, 'active'),
(718, 'Corsar', 46, 'active'),
(719, 'Crafter', 46, 'active'),
(720, 'Crossfox', 46, 'active'),
(721, 'Derby', 46, 'active'),
(722, 'Eos', 46, 'active'),
(723, 'Eurovan', 46, 'active'),
(724, 'GLI', 46, 'active'),
(725, 'Gol', 46, 'active'),
(726, 'Golf', 46, 'active'),
(727, 'GTI', 46, 'active'),
(728, 'Jetta', 46, 'active'),
(729, 'Lupo', 46, 'active'),
(730, 'New Beetle', 46, 'active'),
(731, 'Passat', 46, 'active'),
(732, 'Phaeton', 46, 'active'),
(733, 'Pick-Up', 46, 'active'),
(734, 'Pointer', 46, 'active'),
(735, 'Pointer Pick-Up', 46, 'active'),
(736, 'Polo', 46, 'active'),
(737, 'Rabbit', 46, 'active'),
(738, 'Routan', 46, 'active'),
(739, 'Saveiro', 46, 'active'),
(740, 'Sedan', 46, 'active'),
(741, 'Sharan', 46, 'active'),
(742, 'Sport Van', 46, 'active'),
(743, 'Tiguan', 46, 'active'),
(744, 'Touareg', 46, 'active'),
(745, 'Transporter', 46, 'active'),
(746, 'Vento', 46, 'active'),
(747, 'VW Van', 46, 'active'),
(748, 'C30', 47, 'active'),
(749, 'C70', 47, 'active'),
(750, 'S40', 47, 'active'),
(751, 'S60', 47, 'active'),
(752, 'S70', 47, 'active'),
(753, 'S80', 47, 'active'),
(754, 'S90', 47, 'active'),
(755, 'V40', 47, 'active'),
(756, 'V50', 47, 'active'),
(757, 'V60', 47, 'active'),
(758, 'V90', 47, 'active'),
(759, 'XC30', 47, 'active'),
(760, 'XC60', 47, 'active'),
(761, 'XC70', 47, 'active'),
(762, 'XC90', 47, 'active'),
(763, 'Forte', 48, 'active'),
(765, 'Prueba', 48, 'active'),
(766, 'Prueba', 48, 'active'),
(767, 'Dakota', 10, 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller`
--

CREATE TABLE `taller` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `numext` varchar(10) DEFAULT NULL,
  `numinte` varchar(10) DEFAULT NULL,
  `colonia` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `rfc` varchar(45) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `logo` text,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `taller`
--

INSERT INTO `taller` (`id`, `nombre`, `calle`, `numext`, `numinte`, `colonia`, `ciudad`, `estado`, `cp`, `rfc`, `correo`, `telefono`, `logo`, `status`, `created_date`) VALUES
(1, 'Taller Default', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2018-09-03 06:05:22'),
(2, 'Centro de ReparaciÃ³n Mastreta  S.A. de C.V. ', 'CallejÃ³n de San Antonio Abad', '35', '', 'TrÃ¡nsito', 'MÃ©xico', 'Ciudad de MÃ©xico', '6820', '', 'atencionaclientes@mastreta.com.mx', '55224012', 'imagenes/LogoMastretaOriginal.png', 'active', '2017-03-10 03:53:02'),
(6, 'Taller de Pruebas', 'Donato Guerra', '1', '507 ', 'JuÃ¡rez', 'MÃ©xico', 'Ciudad de MÃ©xico', '6600', 'GEO000529TRZ', 'edgar.reyes@geohti.com', '5554254525', 'imagenes/logo.png', 'active', '2017-05-01 23:48:21'),
(7, 'Centro de ReparaciÃ³n Mastreta  S.A. de C.V. ', 'CallejÃ³n de San Antonio Abad', '35', '', 'TrÃ¡nsito', 'MÃ©xico', 'Ciudad de MÃ©xico', '6820', '', 'atencionaclientes@mastreta.com.mx', '55224012', 'imagenes/LogoMastretaOriginal.png', 'active', '2017-03-10 03:53:02'),
(8, 'Taller Altas de Prueba', 'Insurgentes Sur', '950', '3', 'Del Valle', 'Benito Juarez', 'Ciudad de MÃ©xico', '3100', '', 'agutierrez@segurosatlas.com.mx', '91775000', '', 'active', '2018-01-18 00:44:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `apellido_pat` varchar(200) DEFAULT NULL,
  `apellido_mat` varchar(200) DEFAULT NULL,
  `initials` varchar(10) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `type` varchar(24) DEFAULT 'root',
  `status` varchar(50) DEFAULT 'active',
  `comision` int(11) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `direccion` text,
  `id_usertype` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `id_taller`, `email`, `nombre`, `apellido_pat`, `apellido_mat`, `initials`, `password`, `type`, `status`, `comision`, `token`, `token_expires`, `created_date`, `updated_date`, `deleted_date`, `direccion`, `id_usertype`) VALUES
(2, 7, 'gerardo.malagon@geohti.com', 'Gerardo Malagon', NULL, NULL, '2739', 'malagon123', 'root', 'active', 0, NULL, NULL, '2017-01-25 02:58:15', NULL, NULL, NULL, 1),
(3, 1, 'admin@admin.com', 'Adminnnn', ' ', ' ', NULL, '$2y$10$Z.9xeA0eXB.DvS4qTo4IqeQfidEp06.X9q0HV3xfeY7krycyFuFWG', 'user', 'active', NULL, '', '2017-11-29 03:55:52', '2018-08-29 19:25:52', '2018-10-16 20:18:31', NULL, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `comentarios` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_type`
--

INSERT INTO `user_type` (`id`, `nombre`, `comentarios`, `status`) VALUES
(1, 'Administrador de sistema', 'Sistemas', 'active'),
(2, 'Jefe Taller', NULL, 'active'),
(3, 'Gerente Administrativo', NULL, 'active'),
(4, 'Almacenista  1', '(refacciones)', 'active'),
(5, 'Almacenista 2', '(materiales de hojalateria y pintura)', 'active'),
(6, 'Operador', '(hojalatero, pintor, mecánico, igualador)', 'active'),
(7, 'Director General', NULL, 'active'),
(8, 'Valuador', NULL, 'active'),
(9, 'Asesor de servicio', NULL, 'active'),
(12, 'eliminar prueba', NULL, 'deleted'),
(13, 'eliminar prueba', NULL, 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_submarca` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_taller` int(11) DEFAULT NULL,
  `id_aseguradora` int(11) DEFAULT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `fecha_promesa` timestamp NULL DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `placas_num` varchar(20) DEFAULT NULL,
  `kilometraje` varchar(100) DEFAULT NULL,
  `vin` varchar(100) DEFAULT NULL,
  `matricula` varchar(100) DEFAULT NULL,
  `TransmisionTipo` varchar(45) DEFAULT NULL,
  `FuncionamientoAC` varchar(45) DEFAULT NULL,
  `VestidurasTipo` varchar(45) DEFAULT NULL,
  `InteriorTipo` varchar(45) DEFAULT NULL,
  `RinTipo` varchar(45) DEFAULT NULL,
  `DirTipo` varchar(45) DEFAULT NULL,
  `Gasolina` varchar(45) DEFAULT NULL,
  `Faros` varchar(20) DEFAULT NULL,
  `Lucesch` varchar(20) DEFAULT NULL,
  `Antena` varchar(20) DEFAULT NULL,
  `EspejosLaterales` varchar(20) DEFAULT NULL,
  `Cristales` varchar(20) DEFAULT NULL,
  `Emblemas` varchar(20) DEFAULT NULL,
  `Llantas` varchar(20) DEFAULT NULL,
  `Taponesrin` varchar(20) DEFAULT NULL,
  `Molduras` varchar(20) DEFAULT NULL,
  `TaponGasolina` varchar(20) DEFAULT NULL,
  `Calaveras` varchar(20) DEFAULT NULL,
  `FarosNiebla` varchar(20) DEFAULT NULL,
  `ComentariosExt` text,
  `Limpiadores` varchar(20) DEFAULT NULL,
  `Flasher` varchar(20) DEFAULT NULL,
  `Calefaccion` varchar(20) DEFAULT NULL,
  `Radio` varchar(20) DEFAULT NULL,
  `Encendedor` varchar(20) DEFAULT NULL,
  `Retrovisor` varchar(20) DEFAULT NULL,
  `Cenicero` varchar(20) DEFAULT NULL,
  `Cinturones` varchar(20) DEFAULT NULL,
  `Reclinables` varchar(20) DEFAULT NULL,
  `Tapetes` varchar(20) DEFAULT NULL,
  `Vestiduras` varchar(20) DEFAULT NULL,
  `Guantera` varchar(20) DEFAULT NULL,
  `ComentariosInt` text,
  `Gato` varchar(20) DEFAULT NULL,
  `ManeralGato` varchar(20) DEFAULT NULL,
  `LlavedeLlantas` varchar(20) DEFAULT NULL,
  `Herramientas` varchar(20) DEFAULT NULL,
  `SenalesReflejantes` varchar(20) DEFAULT NULL,
  `Extinguidor` varchar(20) DEFAULT NULL,
  `LlantaRefaccion` varchar(20) DEFAULT NULL,
  `AlarmaControl` varchar(20) DEFAULT NULL,
  `EquipoAV` varchar(20) DEFAULT NULL,
  `CablesPasaCorriente` varchar(20) DEFAULT NULL,
  `DadoSeg` varchar(20) DEFAULT NULL,
  `ComentariosAcces` text,
  `TaponAceite` varchar(20) DEFAULT NULL,
  `TaponDirHD` varchar(20) DEFAULT NULL,
  `TaponDepFrenos` varchar(20) DEFAULT NULL,
  `TaponLimpiaparabrisas` varchar(20) DEFAULT NULL,
  `Bateria` varchar(20) DEFAULT NULL,
  `MarcaBateria` varchar(100) DEFAULT NULL,
  `Claxon` varchar(20) DEFAULT NULL,
  `ComentariosComp` text,
  `TarjetaCirc` varchar(20) DEFAULT NULL,
  `PolizaNum` varchar(200) DEFAULT NULL,
  `PolizaSeg` varchar(20) DEFAULT NULL,
  `ReporteNum` varchar(45) DEFAULT NULL,
  `siniestro` varchar(150) DEFAULT NULL,
  `deducible` varchar(45) DEFAULT NULL,
  `ManualProp` varchar(20) DEFAULT NULL,
  `TalonVerif` varchar(20) DEFAULT NULL,
  `ComentariosDoc` text,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `id_marca`, `id_submarca`, `id_cliente`, `id_user`, `id_taller`, `id_aseguradora`, `fecha_alta`, `fecha_promesa`, `modelo`, `color`, `placas_num`, `kilometraje`, `vin`, `matricula`, `TransmisionTipo`, `FuncionamientoAC`, `VestidurasTipo`, `InteriorTipo`, `RinTipo`, `DirTipo`, `Gasolina`, `Faros`, `Lucesch`, `Antena`, `EspejosLaterales`, `Cristales`, `Emblemas`, `Llantas`, `Taponesrin`, `Molduras`, `TaponGasolina`, `Calaveras`, `FarosNiebla`, `ComentariosExt`, `Limpiadores`, `Flasher`, `Calefaccion`, `Radio`, `Encendedor`, `Retrovisor`, `Cenicero`, `Cinturones`, `Reclinables`, `Tapetes`, `Vestiduras`, `Guantera`, `ComentariosInt`, `Gato`, `ManeralGato`, `LlavedeLlantas`, `Herramientas`, `SenalesReflejantes`, `Extinguidor`, `LlantaRefaccion`, `AlarmaControl`, `EquipoAV`, `CablesPasaCorriente`, `DadoSeg`, `ComentariosAcces`, `TaponAceite`, `TaponDirHD`, `TaponDepFrenos`, `TaponLimpiaparabrisas`, `Bateria`, `MarcaBateria`, `Claxon`, `ComentariosComp`, `TarjetaCirc`, `PolizaNum`, `PolizaSeg`, `ReporteNum`, `siniestro`, `deducible`, `ManualProp`, `TalonVerif`, `ComentariosDoc`, `status`, `created_date`, `updated_date`, `deleted_date`) VALUES
(238, 1, 5, 7, 3, 1, 1, '2018-09-20 04:00:00', '2018-09-30 04:00:00', '2016', 'negro', '2', '123000', '123456789', 'qwert', 'STD', 'Si', 'Tela', 'Manual', 'Acero', 'Hidraulica', '1/2-3/4', 'No', 'No', '', 'No', 'No', 'No', 'Si', 'No', 'No', 'C/DaÃ±o', 'No', 'Si', 'comentarios exteriores', 'No', 'Si', 'No', 'C/DaÃ±o', 'Si', 'C/DaÃ±o', 'No', 'C/DaÃ±o', 'C/DaÃ±o', 'No', 'C/DaÃ±o', 'Si', 'comentarios interiores', 'No', 'No', 'Si', 'C/DaÃ±o', 'No', 'No', 'No', 'No', 'C/DaÃ±o', 'Si', 'No', 'comentarios accesorios', 'Si', 'No', 'Si', 'No', 'Si', 'duracell', 'Si', 'comentarios componentes', 'Si', NULL, 'No', NULL, NULL, NULL, 'Si', 'Si', 'comentarios documentacion', 'deleted', '2018-09-20 22:31:11', NULL, '2018-11-08 19:04:54'),
(239, 4, 32, 25, 3, 1, 4, '2018-09-27 04:00:00', '2018-09-28 04:00:00', '2016', 'rojo', '', '123000', '2345', 'wsd-2334', '', '', '', '', '', '', '1/4-1/2', 'No', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'comentarios exteriores', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'comentarios interiores', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'comentarios accesorios', 'Si', 'Si', 'Si', 'Si', 'Si', 'duracell', 'Si', 'comentarios componentes', 'Si', NULL, 'Si', NULL, NULL, NULL, 'Si', 'Si', 'coment doc', 'active', '2018-09-27 15:46:40', NULL, NULL),
(240, 13, 239, 36, 2, 1, 2, '2018-09-27 04:00:00', '2018-09-28 04:00:00', '2018', 'negro', '1', '123000', '1234567890', 'qwert-jojo', 'STD', 'No', 'Tela', 'Electrico', 'Acero', 'Hidraulica', '1/4-1/2', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'Si', 'Si', 'Si', 'comentarios exteriores', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'asfd', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'No', 'No', 'comentarios accesorios', 'Si', 'No', 'Si', 'No', 'Si', 'duracell', 'Si', 'comentarios componentes', 'Si', NULL, 'Si', NULL, NULL, NULL, 'Si', 'Si', 'coment doc', 'active', '2018-09-27 16:25:43', NULL, NULL),
(241, 9, 128, 10, 2, 1, 2, '2018-09-27 04:00:00', '2018-09-28 04:00:00', '2018', 'negro', '', '123000', 'asASAAASD23123213', '1212-jojo', '', '', '', '', '', '', '1/4-1/2', '', '', '', '', '', '', '', '', '', '', '', '', 'comentarios exteriores', '', '', '', '', '', '', '', '', '', '', '', '', 'asfd', '', 'Si', '', '', '', '', '', '', '', '', '', 'comentarios accesorios', '', '', '', '', '', 'duracell', '', 'comentarios componentes', '', NULL, '', NULL, NULL, NULL, '', '', 'coment doc', 'active', '2018-09-27 16:27:33', NULL, NULL),
(242, 35, 541, 10, 2, 1, 2, '2018-09-27 04:00:00', '2018-09-28 04:00:00', '2018', 'NARANJA', '1', '123000', 'asASAAASD23123213', '1212-jojo', 'AUT', 'Si', 'Piel', 'Manual', 'Aleacion', 'Mecanica', '1/2-3/4', 'Si', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Si', '', '', 'C/DaÃ±o', 'comentarios exteriores', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'asfd', 'Si', 'Si', '', '', '', '', '', '', '', '', '', 'comentarios accesorios', '', '', '', '', '', 'duracell', '', 'comentarios componentes', '', NULL, '', NULL, NULL, NULL, '', '', 'coment doc', 'active', '2018-09-27 16:29:52', NULL, NULL),
(243, 46, 720, 7, 3, 8, 6, '2018-09-27 04:00:00', '2018-09-29 04:00:00', '2017', 'amarillo', '2', '3456789', '2124312', 'fsdfsdf121', 'STD', 'Si', '', 'Electrico', 'Aleacion', 'Hidraulica', '1/2-3/4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', NULL, 'Si', NULL, NULL, NULL, 'No', 'Si', 'coment doc', 'active', '2018-09-27 16:32:29', NULL, NULL),
(244, 1, 1, 6, 3, 1, 2, '2018-12-12 05:00:00', '2018-12-15 05:00:00', '2018', 'negro', '', '', '', '', 'AUT', 'No', 'Piel', 'Manual', 'Acero', 'Hidraulica', '1/4-1/2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 'active', '2018-12-12 05:27:45', NULL, NULL),
(245, 1, 1, 6, 3, 1, 2, '2018-12-12 05:00:00', '2018-12-15 05:00:00', '2018', 'negro', '', '', '', '', 'AUT', 'No', 'Piel', 'Manual', 'Acero', 'Hidraulica', '1/4-1/2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 'active', '2018-12-12 05:32:31', NULL, NULL),
(246, 1, 1, 6, 3, 1, 2, '2018-12-12 05:00:00', '2018-12-15 05:00:00', '2018', 'negro', '', '', '', '', 'AUT', 'No', 'Piel', 'Manual', 'Acero', 'Hidraulica', '1/4-1/2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', 'active', '2018-12-12 05:32:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_refaccion`
--

CREATE TABLE `vehiculo_refaccion` (
  `id` int(11) NOT NULL,
  `id_vehiculo` int(11) DEFAULT NULL,
  `id_refaccion` int(11) DEFAULT NULL,
  `detalles` text,
  `cantidad` double DEFAULT NULL,
  `costo_aprox` double DEFAULT NULL,
  `costo_real` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo_refaccion`
--

INSERT INTO `vehiculo_refaccion` (`id`, `id_vehiculo`, `id_refaccion`, `detalles`, `cantidad`, `costo_aprox`, `costo_real`, `status`, `created_date`, `updated_date`, `deleted_date`, `updated_user`) VALUES
(1, 246, 1, '', 1, 0, NULL, 'Realizado', '2018-12-12 05:32:52', NULL, NULL, NULL),
(2, 246, 2, '', 1, 0, NULL, 'active', '2018-12-12 05:32:52', NULL, NULL, NULL),
(3, 246, 1, '', 1, 100, NULL, 'deleted', '2018-12-13 05:35:32', NULL, '2018-12-13 06:39:38', NULL),
(4, 246, 1, '', 1, 0, NULL, 'active', '2018-12-13 06:21:30', NULL, NULL, NULL),
(5, 246, 1, '', 1, 0, NULL, 'active', '2018-12-13 22:55:12', NULL, NULL, NULL),
(6, 246, 2, '', 1, 0, NULL, 'active', '2018-12-13 22:55:12', NULL, NULL, NULL);

--
-- Disparadores `vehiculo_refaccion`
--
DELIMITER $$
CREATE TRIGGER `hist_refac` AFTER INSERT ON `vehiculo_refaccion` FOR EACH ROW BEGIN
    INSERT INTO historial_vehiculorefaccion (id_vehiculorefaccion,id_user,status,comentarios) values(NEW.id, null,NEW.status,'Inicial');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_servicio`
--

CREATE TABLE `vehiculo_servicio` (
  `id` int(11) NOT NULL,
  `id_vehiculo` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `detalles` text,
  `total` double DEFAULT NULL,
  `status` varchar(45) DEFAULT 'active',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo_servicio`
--

INSERT INTO `vehiculo_servicio` (`id`, `id_vehiculo`, `id_servicio`, `detalles`, `total`, `status`, `created_date`, `updated_date`, `deleted_date`, `updated_user`) VALUES
(1, 244, 65, 'costado izquierdo', 1000, 'active', '2018-12-12 05:27:45', NULL, NULL, NULL),
(2, 244, 8, 'costado izquierdo', 500, 'active', '2018-12-12 05:27:45', NULL, NULL, NULL),
(3, 244, 65, 'costado derecho', 1000, 'active', '2018-12-12 05:27:45', NULL, NULL, NULL),
(4, 244, 8, 'costado derecho', 500, 'active', '2018-12-12 05:27:45', NULL, NULL, NULL),
(5, 245, 65, 'costado izquierdo', 1000, 'active', '2018-12-12 05:32:31', NULL, NULL, NULL),
(6, 245, 8, 'costado izquierdo', 500, 'active', '2018-12-12 05:32:31', NULL, NULL, NULL),
(7, 245, 65, 'costado derecho', 1000, 'active', '2018-12-12 05:32:31', NULL, NULL, NULL),
(8, 245, 8, 'costado derecho', 500, 'active', '2018-12-12 05:32:31', NULL, NULL, NULL),
(9, 246, 65, 'costado izquierdo', 1000, 'Realizado', '2018-12-12 05:32:52', NULL, NULL, NULL),
(10, 246, 8, 'costado izquierdo', 500, 'Realizado', '2018-12-12 05:32:52', NULL, NULL, NULL),
(11, 246, 65, 'costado derecho', 1000, 'active', '2018-12-12 05:32:52', NULL, NULL, NULL),
(12, 246, 8, 'costado derecho', 500, 'active', '2018-12-12 05:32:52', NULL, NULL, NULL),
(13, 246, 2, '', 1, 'deleted', '2018-12-12 19:49:36', NULL, '2018-12-12 21:23:13', NULL),
(14, 246, 4, '', 2, 'deleted', '2018-12-12 19:49:36', NULL, '2018-12-12 21:23:20', NULL),
(15, 246, 2, '', 1, 'deleted', '2018-12-12 19:51:00', NULL, '2018-12-12 21:23:26', NULL),
(16, 246, 4, '', 2, 'deleted', '2018-12-12 19:51:00', NULL, '2018-12-12 21:23:32', NULL),
(17, 246, 13, '', 1, 'Stand-By', '2018-12-12 19:57:54', NULL, NULL, NULL),
(18, 246, 23, '', 2, 'active', '2018-12-12 19:57:54', NULL, NULL, NULL),
(19, 246, 65, 'asas', 3, 'active', '2018-12-12 19:57:54', NULL, NULL, NULL),
(20, 246, 2, '', 12, 'active', '2018-12-13 22:47:42', NULL, NULL, NULL),
(21, 246, 5, '', 2, 'active', '2018-12-13 22:47:42', NULL, NULL, NULL),
(22, 246, 7, '', 3, 'active', '2018-12-13 22:47:42', NULL, NULL, NULL),
(23, 246, 64, '', 3, 'active', '2018-12-13 22:47:42', NULL, NULL, NULL);

--
-- Disparadores `vehiculo_servicio`
--
DELIMITER $$
CREATE TRIGGER `hist_serv` AFTER INSERT ON `vehiculo_servicio` FOR EACH ROW BEGIN
    INSERT INTO historial_vehiculoservicio (id_vehiculoservicio,id_user,status,comentarios) values(NEW.id, null,NEW.status,'Inicial');
  END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_taller_almacen_dx` (`id_taller`);

--
-- Indices de la tabla `aseguradora`
--
ALTER TABLE `aseguradora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usercliente_dx_idx` (`id_user`);

--
-- Indices de la tabla `detalles_vehiculo`
--
ALTER TABLE `detalles_vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehiculodetallesvehiculo_dx_idx` (`id_vehiculo`),
  ADD KEY `id_userdetallesvehiculo_dx_idx` (`id_user`);

--
-- Indices de la tabla `historial_vehiculorefaccion`
--
ALTER TABLE `historial_vehiculorefaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehiculorefaccion_historialvehiculorefaccion_dx` (`id_vehiculorefaccion`),
  ADD KEY `id_user_historialvehiculorefaccion_dx` (`id_user`);

--
-- Indices de la tabla `historial_vehiculoservicio`
--
ALTER TABLE `historial_vehiculoservicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehiculoservicio_historialvehiculoservicio_dx` (`id_vehiculoservicio`),
  ADD KEY `id_user_historialvehiculoservicio_dx` (`id_user`);

--
-- Indices de la tabla `imagenes_refaccion`
--
ALTER TABLE `imagenes_refaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_refaccion_imagenesrefacc_dx` (`id_refaccion`);

--
-- Indices de la tabla `imagenes_vehiculo`
--
ALTER TABLE `imagenes_vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehiculoimagenes_dx_idx` (`id_vehiculo`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_almacen_inventario_dx` (`id_almacen`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor_pedido_dx` (`id_proveedor`),
  ADD KEY `id_user_pedido_dx` (`id_user`),
  ADD KEY `id_almacen_pedido_dx` (`id_almacen`);

--
-- Indices de la tabla `pedido_refaccion`
--
ALTER TABLE `pedido_refaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido_pedidorefaccion_dx` (`id_pedido`),
  ADD KEY `id_refaccion_pedidorefaccion_dx` (`id_refaccion`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso_user`
--
ALTER TABLE `permiso_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_userpermisouser_dx_idx` (`id_user`),
  ADD KEY `id_permisopermisouser2_dx_idx` (`id_permiso`);

--
-- Indices de la tabla `permiso_usertype`
--
ALTER TABLE `permiso_usertype`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usertypepermisousertype_dx_idx` (`id_usertype`),
  ADD KEY `id_permisopermisousertype_dx_idx` (`id_permiso`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `refaccion`
--
ALTER TABLE `refaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marcarefaccion_dx_idx` (`id_marca`),
  ADD KEY `id_submarcarefaccion_dx_idx` (`id_submarca`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio_paquete`
--
ALTER TABLE `servicio_paquete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_servicioserviciopaquete_dx` (`id_servicio`),
  ADD KEY `id_servpaquete` (`id_serviciopaquete`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_autosolicitud_dx_idx` (`id_auto`),
  ADD KEY `id_usersolicitud_dx_idx` (`id_user`),
  ADD KEY `id_tallersolicitud_dx_idx` (`id_taller`);

--
-- Indices de la tabla `solicitud_refaccion`
--
ALTER TABLE `solicitud_refaccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sub_marca`
--
ALTER TABLE `sub_marca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marcasubmarca_dx_idx` (`id_marca`);

--
-- Indices de la tabla `taller`
--
ALTER TABLE `taller`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_companyuser_dx_idx` (`id_taller`),
  ADD KEY `id_usertype_user_dx_idx` (`id_usertype`);

--
-- Indices de la tabla `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marcaauto_idx` (`id_marca`),
  ADD KEY `id_submarcaauto_dx_idx` (`id_submarca`),
  ADD KEY `id_aseguradoraauto_dx_idx` (`id_aseguradora`),
  ADD KEY `id_sucursalauto_dx_idx` (`id_taller`),
  ADD KEY `id_userauto_dx_idx` (`id_user`),
  ADD KEY `id_clienteauto_dx_idx` (`id_cliente`);

--
-- Indices de la tabla `vehiculo_refaccion`
--
ALTER TABLE `vehiculo_refaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_refaccion_vehiculorefaccion_dx` (`id_refaccion`),
  ADD KEY `id_vehiculo_vehiculorefaccion_dx` (`id_vehiculo`);

--
-- Indices de la tabla `vehiculo_servicio`
--
ALTER TABLE `vehiculo_servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_servicio_vehiculoservicio_dx` (`id_servicio`),
  ADD KEY `id_vehiculo_vehiculoservicio_dx` (`id_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `aseguradora`
--
ALTER TABLE `aseguradora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `detalles_vehiculo`
--
ALTER TABLE `detalles_vehiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_vehiculorefaccion`
--
ALTER TABLE `historial_vehiculorefaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial_vehiculoservicio`
--
ALTER TABLE `historial_vehiculoservicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `imagenes_refaccion`
--
ALTER TABLE `imagenes_refaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `imagenes_vehiculo`
--
ALTER TABLE `imagenes_vehiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_refaccion`
--
ALTER TABLE `pedido_refaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `permiso_user`
--
ALTER TABLE `permiso_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=747;

--
-- AUTO_INCREMENT de la tabla `permiso_usertype`
--
ALTER TABLE `permiso_usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `refaccion`
--
ALTER TABLE `refaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `servicio_paquete`
--
ALTER TABLE `servicio_paquete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sub_marca`
--
ALTER TABLE `sub_marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=768;

--
-- AUTO_INCREMENT de la tabla `taller`
--
ALTER TABLE `taller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de la tabla `vehiculo_refaccion`
--
ALTER TABLE `vehiculo_refaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculo_servicio`
--
ALTER TABLE `vehiculo_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `id_usercliente_dx` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalles_vehiculo`
--
ALTER TABLE `detalles_vehiculo`
  ADD CONSTRAINT `id_userdetallesvehiculo_dx` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_vehiculodetallesauto_dx` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagenes_vehiculo`
--
ALTER TABLE `imagenes_vehiculo`
  ADD CONSTRAINT `id_vehiculoimagenes_dx` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `refaccion`
--
ALTER TABLE `refaccion`
  ADD CONSTRAINT `id_marcarefaccion_dx` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_submarcarefaccion_dx` FOREIGN KEY (`id_submarca`) REFERENCES `sub_marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `id_autosolicitud_dx` FOREIGN KEY (`id_auto`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tallersolicitud_dx` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usersolicitud_dx` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sub_marca`
--
ALTER TABLE `sub_marca`
  ADD CONSTRAINT `id_marcasubmarca_dx` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `id_talleryuser_dx` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usertype_user_dx` FOREIGN KEY (`id_usertype`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `id_aseguradoraauto_dx` FOREIGN KEY (`id_aseguradora`) REFERENCES `aseguradora` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_clienteauto_dx` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_marcaauto_dx` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_submarcaauto_dx` FOREIGN KEY (`id_submarca`) REFERENCES `sub_marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_sucursalauto_dx` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_userauto_dx` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
