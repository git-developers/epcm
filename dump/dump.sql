-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.19 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para examen_desarrollador
CREATE DATABASE IF NOT EXISTS `examen_desarrollador` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `examen_desarrollador`;

-- Volcando estructura para tabla examen_desarrollador.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pedido` datetime NOT NULL,
  `usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla examen_desarrollador.pedido: 0 rows
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;

-- Volcando estructura para tabla examen_desarrollador.pedido_detalle
CREATE TABLE IF NOT EXISTS `pedido_detalle` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `producto` int(11) unsigned NOT NULL,
  `pedido` int(11) unsigned NOT NULL,
  `cantidad` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla examen_desarrollador.pedido_detalle: 0 rows
/*!40000 ALTER TABLE `pedido_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_detalle` ENABLE KEYS */;

-- Volcando estructura para tabla examen_desarrollador.producto_catologo
CREATE TABLE IF NOT EXISTS `producto_catologo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  `marca` varchar(120) DEFAULT NULL,
  `tipo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla examen_desarrollador.producto_catologo: 0 rows
/*!40000 ALTER TABLE `producto_catologo` DISABLE KEYS */;
INSERT INTO `producto_catologo` (`id`, `descripcion`, `marca`, `tipo`) VALUES
	(1, 'Llave Inglesa', 'Stealson', 1),
	(2, 'Comba', NULL, 1),
	(3, 'Generador Electrico', NULL, 1),
	(4, 'Camioneta 4x4', 'Toyota', 3);
/*!40000 ALTER TABLE `producto_catologo` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;