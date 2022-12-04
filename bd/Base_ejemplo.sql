-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla facturacion.anticipos_aplicados
CREATE TABLE IF NOT EXISTS `anticipos_aplicados` (
  `idanticipos_aplicados` int(11) NOT NULL AUTO_INCREMENT,
  `idcomprobantes` int(11) NOT NULL DEFAULT '0',
  `idanticipos` int(11) NOT NULL DEFAULT '0',
  `monto_base` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`idanticipos_aplicados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.anticipos_aplicados: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anticipos_aplicados` DISABLE KEYS */;
/*!40000 ALTER TABLE `anticipos_aplicados` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.comprobantes
CREATE TABLE IF NOT EXISTS `comprobantes` (
  `idcomprobantes` int(11) NOT NULL AUTO_INCREMENT,
  `serie_documento` varchar(4) DEFAULT NULL,
  `numero_documento` varchar(8) DEFAULT NULL,
  `comprobante` varchar(13) DEFAULT NULL,
  `fecha_de_emision` date DEFAULT NULL,
  `hora_de_emision` varchar(8) DEFAULT NULL,
  `fecha_de_vencimiento` date DEFAULT NULL,
  `codigo_tipo_operacion` int(4) unsigned zerofill DEFAULT NULL,
  `codigo_tipo_documento` int(2) unsigned zerofill DEFAULT NULL,
  `codigo_tipo_moneda` varchar(3) DEFAULT NULL,
  `numero_orden_de_compra` varchar(120) DEFAULT NULL,
  `idtipo_cambio` int(11) NOT NULL,
  `identidades` int(11) DEFAULT NULL,
  `total_exportacion` double DEFAULT NULL,
  `total_operaciones_gravadas` double DEFAULT NULL,
  `total_operaciones_inafectas` double DEFAULT NULL,
  `total_operaciones_exoneradas` double DEFAULT NULL,
  `total_operaciones_gratuitas` double DEFAULT NULL,
  `total_igv_operaciones_gratuitas` double DEFAULT NULL,
  `total_impuestos_bolsa_plastica` double DEFAULT NULL,
  `total_igv` double DEFAULT NULL,
  `total_impuestos` double DEFAULT NULL,
  `total_valor` double DEFAULT NULL,
  `total_venta` double DEFAULT NULL,
  `total_pendiente_de_pago` double DEFAULT NULL,
  `codigo_condicion_de_pago` int(2) unsigned zerofill DEFAULT NULL,
  `anticipo` int(1) DEFAULT NULL,
  `saldo_anticipo` double DEFAULT NULL,
  `forma_de_pago` int(2) unsigned zerofill DEFAULT NULL,
  `observaciones` text,
  `vendedor` varchar(60) DEFAULT NULL,
  `caja` varchar(60) DEFAULT NULL,
  `informacion_adicional` text,
  `leyendas_valor` varchar(60) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  `estado` int(2) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`idcomprobantes`),
  UNIQUE KEY `comprobante` (`comprobante`),
  KEY `fk_comprobantes_tipo_cambio1_idx` (`idtipo_cambio`),
  KEY `identidades` (`identidades`),
  CONSTRAINT `fk_entidades_comprobantes` FOREIGN KEY (`identidades`) REFERENCES `entidades` (`identidades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_cambios_comprobantes` FOREIGN KEY (`idtipo_cambio`) REFERENCES `tipo_cambio` (`idtipo_cambio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.comprobantes: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `comprobantes` DISABLE KEYS */;
INSERT INTO `comprobantes` (`idcomprobantes`, `serie_documento`, `numero_documento`, `comprobante`, `fecha_de_emision`, `hora_de_emision`, `fecha_de_vencimiento`, `codigo_tipo_operacion`, `codigo_tipo_documento`, `codigo_tipo_moneda`, `numero_orden_de_compra`, `idtipo_cambio`, `identidades`, `total_exportacion`, `total_operaciones_gravadas`, `total_operaciones_inafectas`, `total_operaciones_exoneradas`, `total_operaciones_gratuitas`, `total_igv_operaciones_gratuitas`, `total_impuestos_bolsa_plastica`, `total_igv`, `total_impuestos`, `total_valor`, `total_venta`, `total_pendiente_de_pago`, `codigo_condicion_de_pago`, `anticipo`, `saldo_anticipo`, `forma_de_pago`, `observaciones`, `vendedor`, `caja`, `informacion_adicional`, `leyendas_valor`, `creado`, `actualizado`, `estado`) VALUES
	(7, 'F001', '378', 'F001-00000378', '2022-10-17', '05:03:17', '2022-12-10', 0101, 01, 'USD', 'OC2024-2021', 261, 8, 0, 195, 0, 0, 0, 0, 0, 35.1, 35.1, 195, 230.1, 230.1, 02, 0, 0, 11, '636abb54-838f-4a03-b57e-38f3eb8af1b6', '', '', 'PT01-2022-000001', '', '2022-12-03 17:03:17', '2022-12-03 17:03:33', 05),
	(8, 'F001', '380', 'F001-00000380', '2022-10-22', '05:59:44', '2022-12-18', 0101, 01, 'USD', 'OC2025-2021', 262, 7, 0, 282, 0, 0, 0, 0, 0, 50.76, 50.76, 282, 332.76, 332.76, 02, 0, 0, 12, '0a3b6870-2bbc-4c12-9e50-3561f2c1d0ce', '', '', 'PT01-2022-000002', '', '2022-12-03 17:59:44', '2022-12-03 18:00:52', 05),
	(9, 'F001', '382', 'F001-00000382', '2022-10-29', '06:13:47', '2022-10-29', 0101, 01, 'PEN', 'OC2026-2021', 263, 4, 0, 565.5, 0, 0, 0, 0, 0, 101.79, 101.79, 565.5, 667.29, 0, 01, 0, 0, 10, 'f93c5dec-643c-4851-9518-7f064fb7ff2a', '', '', 'PT01-2022-000003', '', '2022-12-03 18:13:47', '2022-12-03 18:13:57', 05),
	(10, 'F001', '383', 'F001-00000383', '2022-11-20', '06:44:04', '2022-11-20', 0101, 01, 'USD', 'OC2027-2021', 312, 8, 0, 685.75, 0, 0, 0, 0, 0, 123.44, 123.44, 685.75, 809.19, 0, 01, 0, 0, 10, '29716f06-4f85-4d90-9eea-5570f9314ee7', '', '', 'PT01-2022-000004', '', '2022-12-03 18:44:04', '2022-12-03 18:44:14', 05),
	(11, 'F001', '384', 'F001-00000384', '2022-11-22', '06:47:19', '2023-01-02', 0101, 01, 'PEN', 'OC2028-2021', 314, 4, 0, 320.45, 0, 0, 0, 0, 0, 57.68, 57.68, 320.45, 378.13, 378.13, 02, 0, 0, 13, 'f5b85d92-c685-488a-9673-ed687d8cde38', '', '', 'PT01-2022-000005', '', '2022-12-03 18:47:19', '2022-12-03 18:49:09', 05),
	(12, 'F001', '385', 'F001-00000385', '2022-12-01', '07:03:41', '2022-12-01', 0101, 01, 'USD', 'OC2029-2021', 279, 7, 0, 186, 0, 0, 0, 0, 0, 33.48, 33.48, 186, 219.48, 0, 01, 0, 0, 10, 'ca85d994-8dd9-41be-819e-25be19a9836d', '', '', 'PT01-2022-000006', '', '2022-12-03 19:03:41', '2022-12-03 19:03:52', 05),
	(13, 'F001', '386', 'F001-00000386', '2022-12-02', '07:10:05', '2022-12-18', 0101, 01, 'PEN', 'OC2030-2021', 324, 6, 0, 455, 0, 0, 0, 0, 0, 81.9, 81.9, 455, 536.9, 536.9, 02, 0, 0, 12, 'cebfc4dc-c32a-45f4-aee9-453fdf7b7149', '', '', 'PT01-2022-000007', '', '2022-12-03 19:10:05', '2022-12-03 19:10:16', 05),
	(14, 'F001', '387', 'F001-00000387', '2022-12-03', '07:10:52', '2022-12-18', 0101, 01, 'PEN', 'OC2030-2021', 279, 6, 0, 455, 0, 0, 0, 0, 0, 81.9, 81.9, 455, 536.9, 536.9, 02, 0, 0, 12, '7d0c330a-0139-409e-a511-cb52cc277449', '', '', 'PT01-2022-000007', '', '2022-12-03 19:10:52', '2022-12-03 19:12:05', 05);
/*!40000 ALTER TABLE `comprobantes` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.comprobantes_cargos
CREATE TABLE IF NOT EXISTS `comprobantes_cargos` (
  `idcomprobantes_cargos` int(11) NOT NULL AUTO_INCREMENT,
  `cargos_codigo` varchar(2) DEFAULT NULL,
  `cargos_descripcion` varchar(60) DEFAULT NULL,
  `cargos_factor` double DEFAULT NULL,
  `cargos_monto` double DEFAULT NULL,
  `cargos_base` double DEFAULT NULL,
  `cargos_total` double DEFAULT NULL,
  `idcomprobantes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomprobantes_cargos`),
  KEY `idcomprobantes` (`idcomprobantes`),
  CONSTRAINT `fk_comprobantes_cargos_comprobantes` FOREIGN KEY (`idcomprobantes`) REFERENCES `comprobantes` (`idcomprobantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.comprobantes_cargos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comprobantes_cargos` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprobantes_cargos` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.comprobantes_descuentos
CREATE TABLE IF NOT EXISTS `comprobantes_descuentos` (
  `idcomprobantes_descuentos` int(11) NOT NULL AUTO_INCREMENT,
  `descuentos_codigo` varchar(2) DEFAULT NULL,
  `descuentos_descripcion` varchar(255) DEFAULT NULL,
  `descuentos_factor` double DEFAULT NULL,
  `descuentos_monto` double DEFAULT NULL,
  `descuentos_base` double DEFAULT NULL,
  `descuentos_total` double DEFAULT NULL,
  `idcomprobantes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomprobantes_descuentos`),
  KEY `idcomprobantes` (`idcomprobantes`),
  CONSTRAINT `fk_comprobantes_descuentos_comprobantes` FOREIGN KEY (`idcomprobantes`) REFERENCES `comprobantes` (`idcomprobantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.comprobantes_descuentos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comprobantes_descuentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprobantes_descuentos` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.comprobantes_detalles
CREATE TABLE IF NOT EXISTS `comprobantes_detalles` (
  `idcomprobantes_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text,
  `cantidad` double DEFAULT NULL,
  `um` varchar(4) DEFAULT NULL,
  `valor_unitario` double DEFAULT NULL,
  `idcomprobantes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomprobantes_detalles`),
  KEY `fk_idcomprobantes` (`idcomprobantes`),
  KEY `fk_um` (`um`) USING BTREE,
  CONSTRAINT `fk_idcomprobantes` FOREIGN KEY (`idcomprobantes`) REFERENCES `comprobantes` (`idcomprobantes`),
  CONSTRAINT `fk_um` FOREIGN KEY (`um`) REFERENCES `um` (`simbolo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.comprobantes_detalles: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comprobantes_detalles` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprobantes_detalles` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.comprobantes_detracciones
CREATE TABLE IF NOT EXISTS `comprobantes_detracciones` (
  `idcomprobantes_detracciones` int(11) NOT NULL AUTO_INCREMENT,
  `detraccion_codigo_tipo` varchar(3) DEFAULT NULL,
  `detraccion_porcentaje` double DEFAULT NULL,
  `detraccion_monto` double DEFAULT NULL,
  `detraccion_cod_metodo_pago` varchar(3) DEFAULT NULL,
  `detraccion_cuenta_bancaria` varchar(45) DEFAULT NULL,
  `detraccion_ubigeo_origen` varchar(6) DEFAULT NULL,
  `detraccion_direccion_origen` varchar(255) DEFAULT NULL,
  `detraccion_ubigeo_destino` varchar(6) DEFAULT NULL,
  `detraccion_dieccion_destino` varchar(255) DEFAULT NULL,
  `detraccion_valor_ref_servicio_t` double DEFAULT NULL,
  `detraccion_valor_carga_e` double DEFAULT NULL,
  `detraccion_valor_carga_u` double DEFAULT NULL,
  `detraccion_detalle_viaje` text,
  `idcomprobantes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomprobantes_detracciones`),
  KEY `idcomprobantes` (`idcomprobantes`),
  CONSTRAINT `fk_comprobantes_detracciones_comprobantes` FOREIGN KEY (`idcomprobantes`) REFERENCES `comprobantes` (`idcomprobantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.comprobantes_detracciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comprobantes_detracciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprobantes_detracciones` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.comprobantes_retenciones
CREATE TABLE IF NOT EXISTS `comprobantes_retenciones` (
  `idcomprobantes_retenciones` int(11) NOT NULL AUTO_INCREMENT,
  `retencion_codigo` varchar(2) DEFAULT NULL,
  `retencion_porcentaje` double DEFAULT NULL,
  `retencion_monto` double DEFAULT NULL,
  `retencion_base` double DEFAULT NULL,
  `idcomprobantes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomprobantes_retenciones`),
  KEY `idcomprobantes` (`idcomprobantes`),
  CONSTRAINT `fk_comprobantes_retenciones_comprobantes` FOREIGN KEY (`idcomprobantes`) REFERENCES `comprobantes` (`idcomprobantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.comprobantes_retenciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comprobantes_retenciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprobantes_retenciones` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.comprobantes_series
CREATE TABLE IF NOT EXISTS `comprobantes_series` (
  `idcomprobantes_series` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` int(2) unsigned zerofill DEFAULT '00',
  `serie_documento` varchar(4) DEFAULT NULL,
  `numero_actual` int(11) DEFAULT NULL,
  `exportacion` int(1) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomprobantes_series`),
  UNIQUE KEY `serie_documento` (`serie_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.comprobantes_series: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `comprobantes_series` DISABLE KEYS */;
INSERT INTO `comprobantes_series` (`idcomprobantes_series`, `tipo_documento`, `serie_documento`, `numero_actual`, `exportacion`, `estado`) VALUES
	(1, 01, 'F001', 388, 0, 1),
	(2, 01, 'F002', 1, 0, 1),
	(3, 01, 'F003', 55, 1, 1),
	(5, 03, 'B001', 18, 0, 1),
	(6, 03, 'B002', 1, 0, 1),
	(13, 03, 'B003', 1, 0, 1);
/*!40000 ALTER TABLE `comprobantes_series` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.conductores
CREATE TABLE IF NOT EXISTS `conductores` (
  `idconductores` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(80) DEFAULT NULL,
  `licencia` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `idtransportistas` int(11) NOT NULL,
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idconductores`,`idtransportistas`),
  KEY `fk_conductores_transportistas1_idx` (`idtransportistas`),
  CONSTRAINT `fk_conductores_transportistas1` FOREIGN KEY (`idtransportistas`) REFERENCES `transportistas` (`idtransportistas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.conductores: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `conductores` DISABLE KEYS */;
INSERT INTO `conductores` (`idconductores`, `nombres`, `licencia`, `estado`, `idtransportistas`, `actualizado`) VALUES
	(2, 'JUAN MEZA', 'Q12345678', 1, 2, '2022-10-29 19:18:20'),
	(3, 'PEDRO PEREZ', 'Q44445678', 1, 1, '2022-10-29 19:18:58');
/*!40000 ALTER TABLE `conductores` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.contactos
CREATE TABLE IF NOT EXISTS `contactos` (
  `idcontactos` int(11) NOT NULL AUTO_INCREMENT,
  `nombres_apellidos` varchar(60) NOT NULL,
  `correo` varchar(60) NOT NULL DEFAULT '0',
  `telefono` varchar(20) NOT NULL DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '0',
  `identidades` int(11) NOT NULL,
  `actualizado` datetime NOT NULL,
  PRIMARY KEY (`idcontactos`,`identidades`) USING BTREE,
  KEY `FK_contactos_entidades` (`identidades`),
  CONSTRAINT `FK_contactos_entidades` FOREIGN KEY (`identidades`) REFERENCES `entidades` (`identidades`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.contactos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` (`idcontactos`, `nombres_apellidos`, `correo`, `telefono`, `estado`, `identidades`, `actualizado`) VALUES
	(1, 'ALFREDO VISITACION MEDINA', 'alfredovm@gmail.com', '931802429', 1, 8, '2022-11-12 15:35:25');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.direcciones
CREATE TABLE IF NOT EXISTS `direcciones` (
  `iddirecciones` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(255) DEFAULT NULL,
  `ubigeo` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `identidades` int(11) NOT NULL,
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`iddirecciones`,`identidades`),
  KEY `fk_direcciones_entidades1_idx` (`identidades`),
  CONSTRAINT `fk_direcciones_entidades1` FOREIGN KEY (`identidades`) REFERENCES `entidades` (`identidades`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.direcciones: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
INSERT INTO `direcciones` (`iddirecciones`, `direccion`, `ubigeo`, `estado`, `identidades`, `actualizado`) VALUES
	(1, 'JR. SAN PABLO 185 - LIMA - Lima - Miraflores', '150122', 1, 4, '2022-10-15 20:37:03'),
	(2, 'PANAMERICANA SUR KM. 24.6 MZ. G LT. 2 ASC. DE POSESIONARIOS PLAYA SA - LIMA - Lima - Lurin', '150119', 1, 6, '2022-10-29 19:17:16'),
	(3, 'JR. ANTONIO DE ELIZALDE NRO. 839 - LIMA - Lima - Lima', '150101', 1, 7, '2022-10-29 19:17:45'),
	(4, 'AV BOSQUE HUANCA MZ.C LT.04 ASOC RES PRIMAVERA - LIMA - Lima - El Agustino', '150111', 1, 8, '2022-11-12 15:35:11');
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(240) COLLATE utf32_spanish2_ci NOT NULL DEFAULT '0',
  `ruc` int(11) NOT NULL DEFAULT '0',
  `dom_fiscal` text COLLATE utf32_spanish2_ci NOT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- Volcando datos para la tabla facturacion.empresa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.empresa_locales
CREATE TABLE IF NOT EXISTS `empresa_locales` (
  `idempresa_locales` int(11) NOT NULL AUTO_INCREMENT,
  `local` varchar(120) COLLATE utf32_spanish2_ci NOT NULL DEFAULT '0',
  `direccion` text COLLATE utf32_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `idempresa` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idempresa_locales`),
  KEY `idempresa` (`idempresa`),
  CONSTRAINT `fk_empresa_locales` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

-- Volcando datos para la tabla facturacion.empresa_locales: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa_locales` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa_locales` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.entidades
CREATE TABLE IF NOT EXISTS `entidades` (
  `identidades` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(4) DEFAULT NULL,
  `ruc_dni` varchar(15) DEFAULT NULL,
  `razon_social_nombres` varchar(255) DEFAULT NULL,
  `cliente` tinyint(4) DEFAULT NULL,
  `proveedor` tinyint(4) DEFAULT NULL,
  `codigo_pais` varchar(2) DEFAULT NULL,
  `ubigeo` int(6) unsigned zerofill DEFAULT NULL,
  `direccion_fiscal` varchar(255) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `condicion` varchar(20) DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`identidades`),
  UNIQUE KEY `ruc_dni_UNIQUE` (`ruc_dni`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.entidades: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `entidades` DISABLE KEYS */;
INSERT INTO `entidades` (`identidades`, `tipo_documento`, `ruc_dni`, `razon_social_nombres`, `cliente`, `proveedor`, `codigo_pais`, `ubigeo`, `direccion_fiscal`, `correo`, `telefono`, `estado`, `condicion`, `actualizado`) VALUES
	(4, '6', '20607713872', 'INDA HAUS E.I.R.L.', 1, 0, 'PE', 150140, 'JR. MONTERREY 485 DPTO. 601 URB. CHACARILLA DEL ESTANQUE ', '', '', 'ACTIVO', 'HABIDO', '2022-10-22 21:15:21'),
	(5, '6', '10095872579', 'VILLAVERDE MEDRANO HUGO', 1, 0, 'PE', 150133, 'SECTOR LEONCIO PRADO MZA. U-5 LOTE. 17 URB. PAMPLONA ALTA', '', '', 'ACTIVO', 'HABIDO', '2022-10-14 20:45:21'),
	(6, '6', '20607714194', 'NEMECYS S.A.C.', 1, 0, 'PE', 150119, 'PANAMERICANA SUR KM. 24.6 MZ. G LT. 2 ASC. DE POSESIONARIOS PLAYA SA ', '', '', 'ACTIVO', 'HABIDO', '2022-10-22 21:16:03'),
	(7, '6', '20101936300', 'FERRI PERN S R LTDA', 1, 0, 'PE', 150101, 'JR. ANTONIO DE ELIZALDE NRO. 839', '', '', 'ACTIVO', 'HABIDO', '2022-10-22 19:13:33'),
	(8, '6', '20600453271', 'DATASERVER PERU S.A.C.', 1, 0, 'PE', 150128, 'AV. A NRO. 230 INT. T2 CND. ALTOS DEL RIMAC DPTO. 404', '', '', 'ACTIVO', 'HABIDO', '2022-11-12 15:21:26');
/*!40000 ALTER TABLE `entidades` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.guias
CREATE TABLE IF NOT EXISTS `guias` (
  `idguias` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_emision` date DEFAULT NULL,
  `fecha_traslado` date DEFAULT NULL,
  `serie_guia` int(4) unsigned zerofill DEFAULT NULL,
  `numero_guia` int(11) DEFAULT NULL,
  `guia` varchar(45) DEFAULT NULL,
  `cat_transfer_reason_types_id` int(2) unsigned zerofill DEFAULT NULL,
  `identidades` int(11) DEFAULT NULL,
  `iddirecciones` int(11) NOT NULL,
  `idtransportistas` int(11) NOT NULL,
  `idvehiculos` int(11) NOT NULL,
  `idconductores` int(11) NOT NULL,
  `tipo_documento` int(2) unsigned zerofill DEFAULT NULL,
  `numero_documento` varchar(15) DEFAULT NULL,
  `fecha_documento` date DEFAULT NULL,
  `ocs` varchar(120) DEFAULT NULL,
  `ots` varchar(120) DEFAULT NULL,
  `observacion` text,
  `extras` text,
  `idcomprobantes` int(11) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`idguias`,`iddirecciones`,`idtransportistas`,`idvehiculos`,`idconductores`) USING BTREE,
  UNIQUE KEY `guia` (`guia`),
  KEY `identidades` (`identidades`),
  KEY `fk_guia_transportistas1_idx` (`idtransportistas`) USING BTREE,
  KEY `fk_guia_vehiculos1_idx` (`idvehiculos`) USING BTREE,
  KEY `fk_guia_conductores1_idx` (`idconductores`) USING BTREE,
  KEY `fk_guia_direcciones1_idx` (`iddirecciones`) USING BTREE,
  CONSTRAINT `fk_guia_conductores1` FOREIGN KEY (`idconductores`) REFERENCES `conductores` (`idconductores`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_direcciones1` FOREIGN KEY (`iddirecciones`) REFERENCES `direcciones` (`iddirecciones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_entidades1` FOREIGN KEY (`identidades`) REFERENCES `entidades` (`identidades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_transportistas1` FOREIGN KEY (`idtransportistas`) REFERENCES `transportistas` (`idtransportistas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_vehiculos1` FOREIGN KEY (`idvehiculos`) REFERENCES `vehiculos` (`idvehiculos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.guias: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `guias` DISABLE KEYS */;
INSERT INTO `guias` (`idguias`, `fecha_emision`, `fecha_traslado`, `serie_guia`, `numero_guia`, `guia`, `cat_transfer_reason_types_id`, `identidades`, `iddirecciones`, `idtransportistas`, `idvehiculos`, `idconductores`, `tipo_documento`, `numero_documento`, `fecha_documento`, `ocs`, `ots`, `observacion`, `extras`, `idcomprobantes`, `creado`, `actualizado`, `estado`) VALUES
	(6, '2022-10-17', '2022-10-17', 0001, 1, '0001-00000001', 01, 8, 4, 1, 5, 3, 01, 'F001-00000378', '2022-10-17', 'OC2024-2021', 'PT01-2022-000001', '', '', 0, '2022-12-03 17:02:30', '2022-12-03 17:03:31', 3),
	(7, '2022-10-20', '2022-10-20', 0001, 2, '0001-00000002', 01, 7, 3, 1, 5, 3, 01, 'F001-00000002', '2022-10-20', 'OC2025-2021', 'PT01-2022-000002', '', '', 0, '2022-12-03 17:54:02', '2022-12-03 18:00:52', 3),
	(8, '2022-10-31', '2022-10-31', 0001, 3, '0001-00000003', 01, 4, 1, 2, 3, 2, 01, 'F001-00000003', '2022-10-31', 'OC2026-2021', 'PT01-2022-000003', '', '', 0, '2022-12-03 18:12:34', '2022-12-03 18:13:57', 3),
	(9, '2022-11-20', '2022-11-20', 0001, 4, '0001-00000004', 01, 8, 4, 1, 5, 3, 01, 'F001-00000004', '2022-11-20', 'OC2027-2021', 'PT01-2022-000004', '', '', 0, '2022-12-03 18:16:57', '2022-12-03 18:44:14', 3),
	(10, '2022-11-22', '2022-11-22', 0001, 5, '0001-00000005', 01, 4, 1, 1, 5, 3, 01, 'F001-00000005', '2022-11-22', 'OC2028-2021', 'PT01-2022-000005', '', '', 0, '2022-12-03 18:48:16', '2022-12-03 18:49:09', 3),
	(11, '2022-12-01', '2022-12-01', 0001, 6, '0001-00000006', 01, 7, 3, 1, 5, 3, 01, 'F001-00000006', '2022-12-03', 'OC2029-2021', 'PT01-2022-000006', '', '', 0, '2022-12-03 19:03:03', '2022-12-03 19:03:52', 3),
	(12, '2022-12-01', '2022-12-01', 0001, 7, '0001-00000007', 01, 6, 2, 1, 5, 3, 01, 'F001-00000007', '2022-12-03', 'OC2030-2021', 'PT01-2022-000007', '', '', 0, '2022-12-03 19:09:07', '2022-12-03 19:10:15', 3),
	(13, '2022-12-03', '2022-12-03', 0001, 8, '0001-00000008', 01, 6, 2, 1, 5, 3, 01, 'F001-00000008', '2022-12-03', 'OC2030-2021', 'PT01-2022-000007', '', '', 0, '2022-12-03 19:11:28', '2022-12-03 19:12:05', 3);
/*!40000 ALTER TABLE `guias` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.items
CREATE TABLE IF NOT EXISTS `items` (
  `iditems` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_sunat` varchar(45) DEFAULT NULL,
  `codigo_interno` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `um` varchar(6) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `idcategorias` int(11) NOT NULL DEFAULT '0',
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`iditems`,`idcategorias`) USING BTREE,
  UNIQUE KEY `codigo_interno` (`codigo_interno`),
  KEY `um` (`um`),
  KEY `iditems` (`iditems`),
  KEY `idcategorias` (`idcategorias`),
  CONSTRAINT `FK_items_categorias` FOREIGN KEY (`idcategorias`) REFERENCES `items_categorias` (`idcategorias`),
  CONSTRAINT `FK_items_um` FOREIGN KEY (`um`) REFERENCES `um` (`simbolo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.items: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`iditems`, `codigo_sunat`, `codigo_interno`, `descripcion`, `um`, `estado`, `idcategorias`, `actualizado`) VALUES
	(13, NULL, 'PT01-2022-000001-001', 'PERNOS DE 8 PULGADAS GALVANIZADO', 'NIU', 1, 1, '2022-12-03 16:59:59'),
	(14, NULL, 'PT01-2022-000002-001', 'TUERCA DE 1 PULGADA', 'NIU', 1, 1, '2022-12-03 17:29:32'),
	(15, NULL, 'PT01-2022-000003-001', 'PERNOS DE 2 PULGADAS GALVANIZADO', 'NIU', 1, 1, '2022-12-03 18:11:24'),
	(16, NULL, 'PT01-2022-000004-001', 'TUERCA DE 1 PULGADA', 'NIU', 1, 1, '2022-12-03 18:15:51'),
	(17, NULL, 'PT01-2022-000005-001', 'TUERCA DE 2 PULGADA', 'NIU', 1, 1, '2022-12-03 18:46:05'),
	(18, NULL, 'PT01-2022-000006-001', 'PERNOS DE 2 PULGADAS GALVANIZADO', 'NIU', 1, 1, '2022-12-03 19:02:23'),
	(19, NULL, 'PT01-2022-000007-001', 'PERNOS DE 8 PULGADAS GALVANIZADO', 'NIU', 1, 1, '2022-12-03 19:07:12');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.items_categorias
CREATE TABLE IF NOT EXISTS `items_categorias` (
  `idcategorias` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  `codigo` varchar(6) NOT NULL DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcategorias`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.items_categorias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `items_categorias` DISABLE KEYS */;
INSERT INTO `items_categorias` (`idcategorias`, `categoria`, `codigo`, `estado`) VALUES
	(1, 'TODOS', '001', 1);
/*!40000 ALTER TABLE `items_categorias` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(50) NOT NULL DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmenu`),
  UNIQUE KEY `menu` (`menu`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.menu: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`idmenu`, `menu`, `estado`) VALUES
	(1, 'Tablero', 1),
	(2, 'Ventas', 1),
	(3, 'Comprobantes', 1),
	(4, 'Clientes', 1),
	(5, 'Almacen', 1),
	(6, 'Ordenes', 1),
	(7, 'Guias', 1),
	(8, 'Items', 1),
	(9, 'Transportistas', 1),
	(10, 'Configuracion', 1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.menu_usuarios
CREATE TABLE IF NOT EXISTS `menu_usuarios` (
  `idmenu_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `idmenu` int(11) NOT NULL DEFAULT '0',
  `idusuarios` int(11) NOT NULL DEFAULT '0',
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`idmenu_usuarios`),
  KEY `fk_menu` (`idmenu`),
  KEY `fk_usuarios` (`idusuarios`),
  CONSTRAINT `fk_menu` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`),
  CONSTRAINT `fk_usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.menu_usuarios: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `menu_usuarios` DISABLE KEYS */;
INSERT INTO `menu_usuarios` (`idmenu_usuarios`, `idmenu`, `idusuarios`, `estado`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 1),
	(3, 3, 1, 1),
	(4, 4, 1, 1),
	(5, 5, 1, 1),
	(6, 6, 1, 1),
	(7, 7, 1, 1),
	(8, 8, 1, 1),
	(9, 9, 1, 1),
	(10, 10, 1, 1);
/*!40000 ALTER TABLE `menu_usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.metodos_de_pago
CREATE TABLE IF NOT EXISTS `metodos_de_pago` (
  `idmetodo_de_pago` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) NOT NULL DEFAULT '0',
  `dias` int(2) NOT NULL DEFAULT '0',
  `credito` int(1) NOT NULL DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmetodo_de_pago`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.metodos_de_pago: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `metodos_de_pago` DISABLE KEYS */;
INSERT INTO `metodos_de_pago` (`idmetodo_de_pago`, `descripcion`, `dias`, `credito`, `estado`) VALUES
	(01, 'Efectivo', 0, 0, 1),
	(02, 'Tarjeta de Crédito', 0, 0, 1),
	(03, 'Tarjeta de Débito', 0, 0, 1),
	(04, 'Transferencia', 0, 0, 1),
	(05, 'Factura a 30 días', 30, 1, 1),
	(06, 'Tarjeta Crédito visa', 0, 0, 1),
	(07, 'Contado contraentrega', 0, 0, 1),
	(08, 'A 30 días', 30, 1, 1),
	(09, 'Crédito', 0, 1, 1),
	(10, 'Contado', 0, 0, 1),
	(11, 'FACTURA NEGOCIABLE 07 DIAS', 7, 1, 1),
	(12, 'FACTURA NEGOCIABLE 15 DIAS', 15, 1, 1),
	(13, 'FACTURA NEGOCIABLE 30 DIAS', 30, 1, 1),
	(14, 'FACTURA NEGOCIABLE 45 DIAS', 45, 1, 1),
	(15, 'FACTURA NEGOCIABLE 60 DIAS', 60, 1, 1),
	(16, 'LETRA A 30 DIAS', 30, 1, 1),
	(17, 'LETRA A 45 DIAS', 45, 1, 1),
	(18, 'LETRA A 60 DIAS', 60, 1, 1),
	(19, 'Adelanto 50% - Saldo Contraentrega', 0, 0, 1),
	(20, 'ADELANTO 50% - SALDO CHEQUE A 30 DIAS', 0, 0, 1),
	(21, 'CHEQUE DIFERIDO 15 DIAS', 0, 0, 1),
	(22, 'CHEQUE DIFERIDO 07 DIAS', 0, 0, 1),
	(23, 'CHEQUE DIFERIDO 30 DIAS', 0, 0, 1),
	(24, 'Factoring 30 dìas', 30, 1, 1),
	(25, 'Adelanto 30% - Saldo Contraentrega', 0, 0, 1);
/*!40000 ALTER TABLE `metodos_de_pago` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.monedas
CREATE TABLE IF NOT EXISTS `monedas` (
  `idmonedas` int(11) NOT NULL AUTO_INCREMENT,
  `simbolo` varchar(4) NOT NULL DEFAULT '0',
  `iso` varchar(3) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idmonedas`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.monedas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `monedas` DISABLE KEYS */;
INSERT INTO `monedas` (`idmonedas`, `simbolo`, `iso`, `descripcion`) VALUES
	(1, 'S/', 'PEN', 'Soles'),
	(2, '$', 'USD', 'Dólares Americanos');
/*!40000 ALTER TABLE `monedas` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.motivo_de_traslado
CREATE TABLE IF NOT EXISTS `motivo_de_traslado` (
  `idmotivo_de_traslado` int(2) unsigned zerofill NOT NULL,
  `descripcion` varchar(250) NOT NULL DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmotivo_de_traslado`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.motivo_de_traslado: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `motivo_de_traslado` DISABLE KEYS */;
INSERT INTO `motivo_de_traslado` (`idmotivo_de_traslado`, `descripcion`, `estado`) VALUES
	(01, 'Venta', 1),
	(02, 'Compra', 1),
	(04, 'Traslado entre estableciemientos de la misma empresa', 1),
	(08, 'Importación', 1),
	(09, 'Exportación', 1),
	(13, 'Otros', 1),
	(14, 'Venta sujeta a confirmación del comprador', 1),
	(18, 'Traslado emisor itinerante CP', 1),
	(19, 'Traslado zona primaria', 1);
/*!40000 ALTER TABLE `motivo_de_traslado` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.ordenes
CREATE TABLE IF NOT EXISTS `ordenes` (
  `idordenes` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_emision` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `idordenes_tipos` int(11) NOT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `anio` int(4) DEFAULT NULL,
  `orden` varchar(45) DEFAULT NULL,
  `identidades` int(11) NOT NULL,
  `cotizacion` varchar(45) DEFAULT NULL,
  `orden_compra` varchar(45) DEFAULT NULL,
  `vendedor` varchar(45) DEFAULT 'Oficina',
  `payment_method_types_id` int(2) unsigned zerofill NOT NULL DEFAULT '00' COMMENT 'Desde el Facturador',
  `cat_currency_types_id` varchar(3) DEFAULT NULL COMMENT 'Desde el Facturador',
  `descuento` double(5,2) DEFAULT NULL,
  `exportacion` tinyint(4) DEFAULT NULL,
  `monto` double(12,5) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idordenes`,`idordenes_tipos`,`identidades`) USING BTREE,
  UNIQUE KEY `ot_UNIQUE` (`orden`) USING BTREE,
  KEY `fk_ot_entidades1_idx` (`identidades`),
  KEY `fk_ot_ot_tipos1_idx` (`idordenes_tipos`) USING BTREE,
  CONSTRAINT `fk_ordenes_entidades1` FOREIGN KEY (`identidades`) REFERENCES `entidades` (`identidades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ordenes_ordenes_tipos` FOREIGN KEY (`idordenes_tipos`) REFERENCES `ordenes_tipos` (`idordenes_tipos`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.ordenes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ordenes` DISABLE KEYS */;
INSERT INTO `ordenes` (`idordenes`, `fecha_emision`, `fecha_entrega`, `idordenes_tipos`, `correlativo`, `anio`, `orden`, `identidades`, `cotizacion`, `orden_compra`, `vendedor`, `payment_method_types_id`, `cat_currency_types_id`, `descuento`, `exportacion`, `monto`, `estado`, `creado`, `actualizado`) VALUES
	(7, '2022-10-03', '2022-10-17', 1, 1, 2022, 'PT01-2022-000001', 8, 'COT01-2021', 'OC2024-2021', 'Oficina', 11, 'USD', 0.00, 0, 195.00000, 3, '2022-12-03 16:59:04', '2022-12-03 17:01:45'),
	(8, '2022-10-07', '2022-10-20', 1, 2, 2022, 'PT01-2022-000002', 7, 'COT02-2021', 'OC2025-2021', 'Oficina', 12, 'USD', 0.00, 0, 282.00000, 3, '2022-12-03 17:27:30', '2022-12-03 17:30:34'),
	(9, '2022-10-29', '2022-10-31', 1, 3, 2022, 'PT01-2022-000003', 4, 'COT03-2021', 'OC2026-2021', 'Oficina', 10, 'PEN', 0.00, 0, 565.50000, 3, '2022-12-03 18:10:51', '2022-12-03 18:11:28'),
	(10, '2022-11-12', '2022-11-20', 1, 4, 2022, 'PT01-2022-000004', 8, 'COT04-2021', 'OC2027-2021', 'Oficina', 10, 'USD', 0.00, 0, 685.75000, 3, '2022-12-03 18:15:35', '2022-12-03 18:15:55'),
	(11, '2022-11-15', '2022-11-22', 1, 5, 2022, 'PT01-2022-000005', 4, 'COT05-2021', 'OC2028-2021', 'Oficina', 13, 'PEN', 0.00, 0, 320.45000, 3, '2022-12-03 18:45:32', '2022-12-03 18:46:09'),
	(12, '2022-11-28', '2022-12-01', 1, 6, 2022, 'PT01-2022-000006', 7, 'COT06-2021', 'OC2029-2021', 'Oficina', 10, 'USD', 0.00, 0, 186.00000, 3, '2022-12-03 19:02:03', '2022-12-03 19:02:27'),
	(13, '2022-11-28', '2022-12-01', 1, 7, 2022, 'PT01-2022-000007', 6, 'COT07-2021', 'OC2030-2021', 'Oficina', 12, 'PEN', 0.00, 0, 910.00000, 3, '2022-12-03 19:05:59', '2022-12-03 19:07:16');
/*!40000 ALTER TABLE `ordenes` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.ordenes_detalles
CREATE TABLE IF NOT EXISTS `ordenes_detalles` (
  `idordenes_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_pedido` double(9,2) DEFAULT NULL,
  `cantidad_entregada` double(9,2) DEFAULT NULL,
  `valor_unitario` double(12,6) DEFAULT NULL,
  `idordenes` int(11) NOT NULL,
  `iditems` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idordenes_detalles`,`idordenes`,`iditems`) USING BTREE,
  KEY `fk_ot_detalles_items1_idx` (`iditems`),
  KEY `fk_ot_detalles_ot_idx` (`idordenes`) USING BTREE,
  CONSTRAINT `fk_ordenes_detalles_items1` FOREIGN KEY (`iditems`) REFERENCES `items` (`iditems`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ordenes_detalles_ordenes1` FOREIGN KEY (`idordenes`) REFERENCES `ordenes` (`idordenes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.ordenes_detalles: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `ordenes_detalles` DISABLE KEYS */;
INSERT INTO `ordenes_detalles` (`idordenes_detalles`, `cantidad_pedido`, `cantidad_entregada`, `valor_unitario`, `idordenes`, `iditems`, `estado`, `actualizado`) VALUES
	(13, 60.00, 60.00, 3.250000, 7, 13, 1, '2022-12-03 16:59:59'),
	(14, 150.00, 150.00, 1.880000, 8, 14, 1, '2022-12-03 17:29:32'),
	(15, 150.00, 150.00, 3.770000, 9, 15, 1, '2022-12-03 18:11:24'),
	(16, 325.00, 325.00, 2.110000, 10, 16, 1, '2022-12-03 18:15:51'),
	(17, 85.00, 85.00, 3.770000, 11, 17, 1, '2022-12-03 18:46:05'),
	(18, 120.00, 120.00, 1.550000, 12, 18, 1, '2022-12-03 19:02:23'),
	(19, 200.00, 200.00, 4.550000, 13, 19, 1, '2022-12-03 19:07:12');
/*!40000 ALTER TABLE `ordenes_detalles` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.ordenes_detalles_guia_factura
CREATE TABLE IF NOT EXISTS `ordenes_detalles_guia_factura` (
  `idordenes_detalles` int(11) NOT NULL,
  `idguias` int(11) DEFAULT NULL,
  `cantidad` double(9,2) DEFAULT NULL,
  `idcomprobantes` int(11) DEFAULT NULL,
  KEY `fk_ot_detalles_has_guia_factura1_idx` (`idcomprobantes`) USING BTREE,
  KEY `fk_ot_detalles_has_guia_ot_detalles1_idx` (`idordenes_detalles`) USING BTREE,
  KEY `fk_ot_detalles_has_guia1_idx` (`idguias`) USING BTREE,
  CONSTRAINT `fk_ot_detalles_has_guia1` FOREIGN KEY (`idguias`) REFERENCES `guias` (`idguias`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_ot_detalles_has_guia_factura1` FOREIGN KEY (`idcomprobantes`) REFERENCES `comprobantes` (`idcomprobantes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ot_detalles_has_guia_ot_detalles1` FOREIGN KEY (`idordenes_detalles`) REFERENCES `ordenes_detalles` (`idordenes_detalles`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.ordenes_detalles_guia_factura: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `ordenes_detalles_guia_factura` DISABLE KEYS */;
INSERT INTO `ordenes_detalles_guia_factura` (`idordenes_detalles`, `idguias`, `cantidad`, `idcomprobantes`) VALUES
	(13, 6, 60.00, 7),
	(14, 7, 150.00, 8),
	(15, 8, 150.00, 9),
	(16, 9, 325.00, 10),
	(17, 10, 85.00, 11),
	(18, 11, 120.00, 12),
	(19, 12, 100.00, 13),
	(19, 13, 100.00, 14);
/*!40000 ALTER TABLE `ordenes_detalles_guia_factura` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.ordenes_tipos
CREATE TABLE IF NOT EXISTS `ordenes_tipos` (
  `idordenes_tipos` int(11) NOT NULL AUTO_INCREMENT,
  `orden_tipo` varchar(60) DEFAULT NULL,
  `orden_serie` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`idordenes_tipos`) USING BTREE,
  UNIQUE KEY `ot_tipo_UNIQUE` (`orden_tipo`) USING BTREE,
  UNIQUE KEY `ot_serie_UNIQUE` (`orden_serie`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.ordenes_tipos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `ordenes_tipos` DISABLE KEYS */;
INSERT INTO `ordenes_tipos` (`idordenes_tipos`, `orden_tipo`, `orden_serie`) VALUES
	(1, 'Productos Terceros', 'PT01'),
	(2, 'Producción Propia', 'PP01'),
	(3, 'Matricería', 'PM01'),
	(4, 'Mantenimiento', 'MM01'),
	(5, 'Servicio Externo', 'SS01');
/*!40000 ALTER TABLE `ordenes_tipos` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.tipo_cambio
CREATE TABLE IF NOT EXISTS `tipo_cambio` (
  `idtipo_cambio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `compra` double DEFAULT NULL,
  `venta` double DEFAULT NULL,
  `registrado` datetime DEFAULT NULL,
  PRIMARY KEY (`idtipo_cambio`),
  UNIQUE KEY `fecha_UNIQUE` (`fecha`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.tipo_cambio: ~246 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_cambio` DISABLE KEYS */;
INSERT INTO `tipo_cambio` (`idtipo_cambio`, `fecha`, `compra`, `venta`, `registrado`) VALUES
	(1, '2022-01-01', 3.975, 3.998, '2022-03-22 18:37:32'),
	(2, '2022-01-02', 3.975, 3.998, '2022-03-22 18:37:55'),
	(3, '2022-01-03', 3.975, 3.998, '2022-03-22 18:38:13'),
	(4, '2022-01-04', 3.987, 3.995, '2022-03-22 18:38:29'),
	(5, '2022-01-05', 3.963, 3.968, '2022-03-22 18:38:51'),
	(6, '2022-01-06', 3.953, 3.965, '2022-03-22 18:39:09'),
	(7, '2022-01-07', 3.967, 3.973, '2022-03-22 18:39:23'),
	(8, '2022-01-08', 3.948, 3.955, '2022-03-22 18:39:38'),
	(9, '2022-01-09', 3.948, 3.955, '2022-03-22 18:39:52'),
	(10, '2022-01-10', 3.948, 3.955, '2022-03-22 18:40:10'),
	(11, '2022-01-11', 3.925, 3.933, '2022-03-22 18:40:24'),
	(12, '2022-01-12', 3.919, 3.925, '2022-03-22 18:41:03'),
	(13, '2022-01-13', 3.897, 3.901, '2022-03-22 18:41:25'),
	(14, '2022-01-14', 3.895, 3.9, '2022-03-22 18:42:25'),
	(15, '2022-01-15', 3.879, 3.887, '2022-03-22 18:42:44'),
	(16, '2022-01-16', 3.879, 3.887, '2022-03-22 18:42:59'),
	(17, '2022-01-17', 3.879, 3.887, '2022-03-22 18:43:19'),
	(18, '2022-01-18', 3.846, 3.869, '2022-03-22 18:43:33'),
	(19, '2022-01-19', 3.848, 3.856, '2022-03-22 18:43:55'),
	(20, '2022-01-20', 3.859, 3.866, '2022-03-22 18:46:52'),
	(21, '2022-01-21', 3.851, 3.859, '2022-03-22 18:47:17'),
	(22, '2022-01-22', 3.82, 3.834, '2022-03-22 18:47:47'),
	(23, '2022-01-23', 3.82, 3.834, '2022-03-22 18:51:46'),
	(24, '2022-01-24', 3.82, 3.834, '2022-03-22 18:52:03'),
	(25, '2022-01-25', 3.835, 3.842, '2022-03-22 18:52:19'),
	(26, '2022-01-26', 3.843, 3.852, '2022-03-22 18:52:44'),
	(27, '2022-01-27', 3.84, 3.849, '2022-03-22 18:53:05'),
	(28, '2022-01-28', 3.833, 3.839, '2022-03-22 18:54:23'),
	(29, '2022-01-29', 3.839, 3.849, '2022-03-22 18:54:36'),
	(30, '2022-01-30', 3.839, 3.849, '2022-03-22 18:54:52'),
	(31, '2022-01-31', 3.839, 3.849, '2022-03-22 18:55:05'),
	(32, '2022-02-01', 3.84, 3.846, '2022-03-22 18:57:36'),
	(33, '2022-02-02', 3.866, 3.878, '2022-03-22 18:57:51'),
	(34, '2022-02-03', 3.852, 3.86, '2022-03-22 18:58:09'),
	(35, '2022-02-04', 3.858, 3.863, '2022-03-22 18:58:23'),
	(36, '2022-02-05', 3.867, 3.873, '2022-03-22 18:58:42'),
	(37, '2022-02-06', 3.867, 3.873, '2022-03-22 18:59:24'),
	(38, '2022-02-07', 3.867, 3.873, '2022-03-22 18:59:39'),
	(39, '2022-02-08', 3.839, 3.848, '2022-03-22 18:59:51'),
	(40, '2022-02-09', 3.837, 3.845, '2022-03-22 19:00:09'),
	(41, '2022-02-10', 3.821, 3.834, '2022-03-22 19:00:28'),
	(42, '2022-02-11', 3.756, 3.767, '2022-03-22 19:00:52'),
	(43, '2022-02-12', 3.749, 3.758, '2022-03-22 19:01:10'),
	(44, '2022-02-13', 3.749, 3.758, '2022-03-22 19:01:26'),
	(45, '2022-02-14', 3.749, 3.758, '2022-03-22 19:01:43'),
	(46, '2022-02-15', 3.782, 3.789, '2022-03-22 19:02:12'),
	(47, '2022-02-16', 3.797, 3.806, '2022-03-22 19:02:29'),
	(48, '2022-02-17', 3.769, 3.785, '2022-03-22 19:02:44'),
	(49, '2022-02-18', 3.747, 3.75, '2022-03-22 19:03:25'),
	(50, '2022-02-19', 3.712, 3.726, '2022-03-22 19:03:47'),
	(51, '2022-02-20', 3.712, 3.726, '2022-03-22 19:04:07'),
	(52, '2022-02-21', 3.712, 3.726, '2022-03-22 19:04:22'),
	(53, '2022-02-22', 3.738, 3.752, '2022-03-22 19:04:41'),
	(54, '2022-02-23', 3.737, 3.745, '2022-03-22 19:04:59'),
	(55, '2022-02-24', 3.709, 3.715, '2022-03-22 19:05:17'),
	(56, '2022-02-25', 3.786, 3.788, '2022-03-22 19:05:32'),
	(57, '2022-02-26', 3.753, 3.763, '2022-03-22 19:05:50'),
	(58, '2022-02-27', 3.753, 3.763, '2022-03-22 19:06:04'),
	(59, '2022-02-28', 3.753, 3.763, '2022-03-22 19:06:19'),
	(60, '2022-03-01', 3.753, 3.759, '2022-03-22 19:07:01'),
	(61, '2022-03-02', 3.782, 3.791, '2022-03-22 19:07:16'),
	(62, '2022-03-03', 3.763, 3.77, '2022-03-22 19:07:52'),
	(63, '2022-03-04', 3.725, 3.735, '2022-03-22 19:08:08'),
	(64, '2022-03-05', 3.746, 3.76, '2022-03-22 19:08:20'),
	(65, '2022-03-06', 3.746, 3.76, '2022-03-22 19:08:35'),
	(66, '2022-03-07', 3.746, 3.76, '2022-03-22 19:09:03'),
	(67, '2022-03-08', 3.742, 3.751, '2022-03-22 19:09:20'),
	(68, '2022-03-09', 3.729, 3.736, '2022-03-22 19:09:50'),
	(69, '2022-03-10', 3.714, 3.718, '2022-03-22 19:10:10'),
	(70, '2022-03-11', 3.714, 3.721, '2022-03-22 19:10:24'),
	(71, '2022-03-12', 3.688, 3.698, '2022-03-22 19:10:38'),
	(72, '2022-03-13', 3.688, 3.698, '2022-03-22 19:11:04'),
	(73, '2022-03-14', 3.688, 3.698, '2022-03-22 19:11:17'),
	(74, '2022-03-15', 3.708, 3.715, '2022-03-22 19:11:29'),
	(75, '2022-03-16', 3.726, 3.735, '2022-03-22 19:11:45'),
	(76, '2022-03-17', 3.723, 3.729, '2022-03-22 19:12:11'),
	(77, '2022-03-18', 3.73, 3.736, '2022-03-22 19:12:23'),
	(78, '2022-03-19', 3.761, 3.776, '2022-03-22 19:12:41'),
	(79, '2022-03-20', 3.761, 3.776, '2022-03-22 19:12:55'),
	(80, '2022-03-21', 3.761, 3.776, '2022-03-22 19:13:08'),
	(81, '2022-03-22', 3.782, 3.79, '2022-03-22 19:13:23'),
	(82, '2022-03-23', 3.769, 3.776, '2022-03-22 19:13:41'),
	(83, '2022-03-24', 3.766, 3.773, '2022-03-24 07:33:45'),
	(84, '2022-03-25', 3.743, 3.756, '2022-03-25 09:54:15'),
	(85, '2022-03-26', 3.725, 3.731, '2022-03-26 12:36:43'),
	(86, '2022-03-27', 3.725, 3.731, '2022-03-27 09:08:13'),
	(87, '2022-03-28', 3.725, 3.731, '2022-03-28 00:33:21'),
	(88, '2022-03-29', 3.726, 3.737, '2022-03-29 07:28:17'),
	(89, '2022-03-30', 3.717, 3.724, '2022-03-30 07:17:30'),
	(90, '2022-03-31', 3.723, 3.728, '2022-03-31 09:47:51'),
	(91, '2022-04-01', 3.695, 3.701, '2022-04-01 11:21:40'),
	(92, '2022-04-02', 3.641, 3.663, '2022-04-02 11:22:10'),
	(93, '2022-04-03', 3.641, 3.663, '2022-04-03 11:22:40'),
	(94, '2022-04-04', 3.641, 3.663, '2022-04-04 11:22:57'),
	(95, '2022-04-05', 3.627, 3.634, '2022-04-04 11:23:52'),
	(96, '2022-04-06', 3.686, 3.69, '2022-04-06 11:24:22'),
	(97, '2022-04-07', 3.71, 3.72, '2022-04-07 11:24:52'),
	(98, '2022-04-08', 3.707, 3.714, '2022-04-08 11:25:13'),
	(99, '2022-04-09', 3.709, 3.715, '2022-04-09 11:25:41'),
	(100, '2022-04-10', 3.709, 3.715, '2022-04-10 11:25:57'),
	(101, '2022-04-11', 3.709, 3.715, '2022-04-11 11:26:21'),
	(102, '2022-04-12', 3.709, 3.721, '2022-04-12 11:26:39'),
	(103, '2022-04-13', 3.698, 3.706, '2022-04-13 11:26:53'),
	(104, '2022-04-14', 3.728, 3.736, '2022-04-14 11:27:11'),
	(105, '2022-04-15', 3.728, 3.736, '2022-04-15 11:27:45'),
	(106, '2022-04-16', 3.728, 3.736, '2022-04-16 11:28:05'),
	(107, '2022-04-17', 3.728, 3.736, '2022-04-17 11:28:28'),
	(108, '2022-04-18', 3.728, 3.736, '2022-04-18 11:28:46'),
	(109, '2022-04-19', 3.73, 3.742, '2022-04-19 11:29:08'),
	(110, '2022-04-20', 3.725, 3.736, '2022-04-20 11:29:46'),
	(111, '2022-04-21', 3.702, 3.709, '2022-04-21 11:31:29'),
	(112, '2022-04-22', 3.723, 3.734, '2022-04-22 11:31:49'),
	(113, '2022-04-23', 3.758, 3.766, '2022-04-23 11:32:15'),
	(114, '2022-04-24', 3.758, 3.766, '2022-04-24 11:33:25'),
	(115, '2022-04-25', 3.758, 3.766, '2022-04-25 11:33:58'),
	(116, '2022-04-26', 3.807, 3.815, '2022-04-26 11:34:28'),
	(117, '2022-04-27', 3.811, 3.818, '2022-04-27 11:34:53'),
	(118, '2022-04-28', 3.824, 3.83, '2022-04-28 11:35:30'),
	(119, '2022-04-29', 3.846, 3.852, '2022-04-29 11:35:55'),
	(120, '2022-04-30', 3.83, 3.838, '2022-04-30 11:36:24'),
	(121, '2022-05-01', 3.83, 3.838, '2022-05-01 11:37:01'),
	(122, '2022-05-02', 3.83, 3.838, '2022-05-02 11:37:27'),
	(123, '2022-05-03', 3.838, 3.848, '2022-05-03 11:37:44'),
	(124, '2022-05-04', 3.824, 3.826, '2022-05-04 11:38:01'),
	(125, '2022-05-05', 3.797, 3.805, '2022-05-05 11:38:17'),
	(126, '2022-05-06', 3.786, 3.79, '2022-05-06 11:38:33'),
	(127, '2022-05-07', 3.803, 3.811, '2022-05-07 11:38:47'),
	(128, '2022-05-08', 3.803, 3.811, '2022-05-08 11:39:00'),
	(129, '2022-05-09', 3.803, 3.811, '2022-05-09 11:39:14'),
	(130, '2022-05-10', 3.814, 3.814, '2022-05-10 11:39:25'),
	(131, '2022-05-11', 3.81, 3.816, '2022-05-11 11:39:37'),
	(132, '2022-05-12', 3.78, 3.788, '2022-05-16 00:54:27'),
	(133, '2022-05-13', 3.795, 3.801, '2022-05-20 15:08:30'),
	(134, '2022-05-14', 3.772, 3.786, '2022-05-22 23:52:18'),
	(135, '2022-05-15', 3.772, 3.786, '2022-05-22 23:52:40'),
	(136, '2022-05-16', 3.772, 3.786, '2022-05-22 23:52:54'),
	(137, '2022-05-17', 3.777, 3.787, '2022-05-22 23:53:13'),
	(138, '2022-05-18', 3.755, 3.762, '2022-05-22 23:53:31'),
	(139, '2022-05-19', 3.766, 3.772, '2022-05-22 23:53:47'),
	(140, '2022-05-20', 3.745, 3.754, '2022-05-22 23:53:59'),
	(141, '2022-05-21', 3.728, 3.738, '2022-05-22 23:54:12'),
	(142, '2022-05-22', 3.728, 3.738, '2022-05-22 23:54:26'),
	(143, '2022-05-23', 3.728, 3.738, '2022-05-22 23:54:42'),
	(144, '2022-05-24', 3.711, 3.72, '2022-05-24 09:32:10'),
	(145, '2022-05-25', 3.713, 3.719, '2022-05-25 07:32:53'),
	(146, '2022-05-26', 3.685, 3.694, '2022-05-26 02:46:21'),
	(147, '2022-05-27', 3.657, 3.663, '2022-05-27 12:41:04'),
	(148, '2022-05-28', 3.663, 3.669, '2022-05-28 12:43:33'),
	(149, '2022-05-29', 3.663, 3.669, '2022-05-29 12:44:43'),
	(150, '2022-05-30', 3.663, 3.669, '2022-05-30 12:45:48'),
	(151, '2022-05-31', 3.665, 3.683, '2022-05-31 12:46:20'),
	(152, '2022-06-01', 3.695, 3.707, '2022-06-01 12:47:01'),
	(153, '2022-06-02', 3.718, 3.726, '2022-06-02 12:47:25'),
	(154, '2022-06-03', 3.707, 3.714, '2022-06-03 12:47:59'),
	(155, '2022-06-04', 3.702, 3.712, '2022-06-04 12:48:21'),
	(156, '2022-06-05', 3.702, 3.712, '2022-06-05 12:48:45'),
	(157, '2022-06-06', 3.702, 3.712, '2022-06-06 12:49:05'),
	(158, '2022-06-07', 3.724, 3.731, '2022-06-07 12:49:30'),
	(159, '2022-06-08', 3.747, 3.755, '2022-06-08 12:49:51'),
	(160, '2022-06-09', 3.751, 3.758, '2022-06-09 12:50:12'),
	(161, '2022-06-10', 3.749, 3.756, '2022-06-10 12:51:05'),
	(162, '2022-06-11', 3.765, 3.778, '2022-06-11 12:51:20'),
	(163, '2022-06-12', 3.765, 3.778, '2022-06-12 12:51:35'),
	(164, '2022-06-13', 3.765, 3.778, '2022-06-13 12:51:51'),
	(165, '2022-06-14', 3.779, 3.783, '2022-06-14 12:52:15'),
	(166, '2022-06-15', 3.751, 3.759, '2022-06-15 12:52:32'),
	(167, '2022-06-16', 3.719, 3.731, '2022-06-16 12:53:07'),
	(168, '2022-06-17', 3.718, 3.727, '2022-06-17 12:53:23'),
	(169, '2022-06-18', 3.715, 3.728, '2022-06-18 12:53:44'),
	(170, '2022-06-19', 3.715, 3.728, '2022-06-19 12:54:05'),
	(171, '2022-06-20', 3.715, 3.728, '2022-06-20 12:54:43'),
	(172, '2022-06-21', 3.714, 3.729, '2022-06-21 12:55:07'),
	(173, '2022-06-22', 3.717, 3.724, '2022-06-22 12:55:27'),
	(174, '2022-06-23', 3.724, 3.753, '2022-06-23 12:55:53'),
	(175, '2022-06-24', 3.747, 3.753, '2022-06-24 12:56:13'),
	(176, '2022-06-25', 3.774, 3.782, '2022-06-25 12:56:47'),
	(177, '2022-06-26', 3.774, 3.782, '2022-06-26 12:57:12'),
	(178, '2022-06-27', 3.774, 3.782, '2022-06-27 12:57:34'),
	(179, '2022-06-28', 3.783, 3.791, '2022-06-28 12:57:59'),
	(180, '2022-06-29', 3.77, 3.788, '2022-06-29 12:58:21'),
	(181, '2022-06-30', 3.77, 3.788, '2022-06-30 12:58:42'),
	(182, '2022-07-01', 3.82, 3.83, '2022-07-01 12:59:39'),
	(183, '2022-07-02', 3.843, 3.854, '2022-07-02 12:59:55'),
	(184, '2022-07-03', 3.843, 3.854, '2022-07-03 13:00:14'),
	(185, '2022-07-04', 3.843, 3.854, '2022-07-04 13:00:27'),
	(186, '2022-07-05', 3.827, 3.839, '2022-07-05 13:00:50'),
	(187, '2022-07-06', 3.856, 3.862, '2022-07-06 13:01:03'),
	(188, '2022-07-07', 3.878, 3.888, '2022-07-07 13:01:17'),
	(189, '2022-07-08', 3.881, 3.888, '2022-07-08 13:01:31'),
	(190, '2022-07-09', 3.897, 3.905, '2022-07-09 13:01:47'),
	(191, '2022-07-10', 3.897, 3.905, '2022-07-10 13:02:02'),
	(192, '2022-07-11', 3.897, 3.905, '2022-07-11 13:02:16'),
	(193, '2022-07-12', 3.928, 3.939, '2022-07-12 13:02:22'),
	(194, '2022-07-13', 3.965, 3.972, '2022-07-13 00:46:03'),
	(195, '2022-07-14', 3.959, 3.968, '2022-07-14 08:16:28'),
	(196, '2022-07-15', 3.951, 3.958, '2022-07-15 16:15:06'),
	(197, '2022-07-21', 3.878, 3.888, '2022-07-21 12:07:30'),
	(198, '2022-07-22', 3.905, 3.914, '2022-07-22 14:28:14'),
	(199, '2022-07-25', 3.91, 3.918, '2022-07-25 13:40:15'),
	(200, '2022-07-26', 3.91, 3.919, '2022-07-26 13:42:18'),
	(201, '2022-07-27', 3.911, 3.921, '2022-07-27 13:09:55'),
	(202, '2022-08-01', 3.916, 3.925, '2022-08-01 13:38:00'),
	(203, '2022-08-02', 3.885, 3.897, '2022-08-02 13:03:58'),
	(204, '2022-08-03', 3.914, 3.919, '2022-08-03 13:09:54'),
	(205, '2022-08-05', 3.885, 3.897, '2022-08-05 16:18:06'),
	(206, '2022-08-09', 3.911, 3.916, '2022-08-09 19:09:59'),
	(207, '2022-07-16', 3.884, 3.906, '2022-08-09 20:27:26'),
	(208, '2022-07-17', 3.884, 3.906, '2022-08-09 20:28:09'),
	(209, '2022-07-18', 3.884, 3.906, '2022-08-09 20:28:18'),
	(210, '2022-07-19', 3.884, 3.892, '2022-08-09 20:29:21'),
	(211, '2022-07-20', 3.866, 3.878, '2022-08-09 20:29:47'),
	(212, '2022-07-23', 3.91, 3.918, '2022-08-09 20:30:40'),
	(213, '2022-07-24', 3.91, 3.918, '2022-08-09 20:30:56'),
	(214, '2022-07-28', 3.916, 3.925, '2022-08-09 20:32:15'),
	(215, '2022-07-29', 3.916, 3.925, '2022-08-09 20:32:35'),
	(216, '2022-07-30', 3.916, 3.925, '2022-08-09 20:32:55'),
	(217, '2022-07-31', 3.916, 3.925, '2022-08-09 20:33:11'),
	(218, '2022-08-04', 3.914, 3.92, '2022-08-09 20:35:10'),
	(219, '2022-08-06', 3.896, 3.905, '2022-08-09 20:35:40'),
	(220, '2022-08-07', 3.896, 3.905, '2022-08-09 20:36:04'),
	(221, '2022-08-08', 3.896, 3.905, '2022-08-09 20:36:19'),
	(222, '2022-08-10', 3.927, 3.932, '2022-08-10 13:01:53'),
	(223, '2022-08-11', 3.893, 3.899, '2022-08-11 12:48:53'),
	(224, '2022-08-12', 3.882, 3.888, '2022-08-12 05:17:39'),
	(225, '2022-08-15', 3.859, 3.865, '2022-08-15 13:18:02'),
	(226, '2022-08-16', 3.849, 3.856, '2022-08-16 12:56:39'),
	(227, '2022-08-17', 3.858, 3.86, '2022-08-17 08:02:35'),
	(228, '2022-08-18', 3.838, 3.847, '2022-08-18 13:59:08'),
	(229, '2022-08-19', 3.838, 3.847, '2022-08-19 13:39:24'),
	(230, '2022-08-22', 3.85, 3.857, '2022-08-22 14:07:49'),
	(231, '2022-08-23', 3.869, 3.88, '2022-08-23 00:01:21'),
	(232, '2022-08-24', 3.856, 3.864, '2022-08-24 06:57:14'),
	(233, '2022-08-25', 3.861, 3.867, '2022-08-25 06:55:22'),
	(234, '2022-08-26', 3.849, 3.861, '2022-08-26 07:23:29'),
	(235, '2022-08-27', 3.836, 3.847, '2022-08-27 11:43:47'),
	(236, '2022-08-28', 3.836, 3.847, '2022-08-28 19:29:25'),
	(237, '2022-08-29', 3.836, 3.847, '2022-08-29 00:10:42'),
	(238, '2022-08-30', 3.829, 3.838, '2022-08-30 09:36:55'),
	(239, '2022-08-31', 3.829, 3.838, '2022-08-31 09:02:46'),
	(240, '2022-09-01', 3.839, 3.847, '2022-09-01 06:37:58'),
	(241, '2022-09-02', 3.859, 3.865, '2022-09-02 07:43:43'),
	(242, '2022-09-03', 3.866, 3.876, '2022-09-03 17:19:55'),
	(243, '2022-09-04', 3.866, 3.876, '2022-09-04 10:35:47'),
	(244, '2022-09-05', 3.866, 3.876, '2022-09-05 07:04:47'),
	(245, '2022-09-17', 3.875, 3.883, '2022-09-17 12:50:18'),
	(254, '2022-10-01', 3.978, 3.984, '2022-10-01 20:31:01'),
	(255, '2022-10-02', 3.978, 3.984, '2022-10-02 09:44:03'),
	(256, '2022-10-03', 3.978, 3.984, '2022-10-03 17:05:44'),
	(257, '2022-10-04', 3.963, 3.969, '2022-10-04 17:52:37'),
	(258, '2022-10-05', 3.948, 3.955, '2022-10-05 07:57:49'),
	(259, '2022-10-15', 3.984, 3.992, '2022-10-15 19:47:59'),
	(260, '2022-10-16', 3.984, 3.992, '2022-10-16 19:14:00'),
	(261, '2022-10-17', 3.984, 3.992, '2022-10-17 11:08:47'),
	(262, '2022-10-22', 3.979, 3.984, '2022-10-22 18:54:57'),
	(263, '2022-10-29', 3.97, 3.978, '2022-10-29 19:13:16'),
	(269, '2022-10-06', 3.96, 3.966, '2022-12-03 18:19:14'),
	(270, '2022-10-07', 3.977, 3.983, '2022-12-03 18:19:25'),
	(271, '2022-10-08', 3.972, 3.98, '2022-12-03 18:19:38'),
	(272, '2022-10-09', 3.972, 3.98, '2022-12-03 18:19:52'),
	(273, '2022-10-10', 3.972, 3.98, '2022-12-03 18:20:05'),
	(274, '2022-10-11', 3.959, 3.967, '2022-12-03 18:20:23'),
	(275, '2022-10-12', 3.968, 3.972, '2022-12-03 18:20:57'),
	(276, '2022-10-13', 3.981, 3.984, '2022-12-03 18:21:10'),
	(277, '2022-10-14', 3.982, 3.987, '2022-12-03 18:21:22'),
	(279, '2022-12-03', 3.826, 3.835, '2022-12-03 18:22:10'),
	(280, '2022-10-18', 3.977, 3.985, '2022-12-03 18:22:39'),
	(281, '2022-10-19', 3.973, 3.979, '2022-12-03 18:22:52'),
	(282, '2022-10-20', 3.981, 3.985, '2022-12-03 18:23:08'),
	(283, '2022-10-21', 3.973, 3.978, '2022-12-03 18:23:32'),
	(284, '2022-10-23', 3.979, 3.984, '2022-12-03 18:24:01'),
	(285, '2022-10-24', 3.979, 3.984, '2022-12-03 18:24:17'),
	(286, '2022-10-25', 3.994, 4.003, '2022-12-03 18:24:31'),
	(287, '2022-10-26', 3.992, 4.002, '2022-12-03 18:24:52'),
	(288, '2022-10-27', 3.988, 3.996, '2022-12-03 18:25:09'),
	(289, '2022-10-28', 3.976, 3.987, '2022-12-03 18:25:23'),
	(290, '2022-10-30', 3.97, 3.978, '2022-12-03 18:25:38'),
	(291, '2022-10-31', 3.97, 3.978, '2022-12-03 18:25:50'),
	(292, '2022-11-01', 3.984, 3.993, '2022-12-03 18:26:15'),
	(293, '2022-11-02', 3.984, 3.993, '2022-12-03 18:27:23'),
	(295, '2022-11-03', 3.968, 3.976, '2022-12-03 18:33:48'),
	(296, '2022-11-04', 3.965, 3.973, '2022-12-03 18:33:59'),
	(297, '2022-11-05', 3.953, 3.962, '2022-12-03 18:34:22'),
	(298, '2022-11-06', 3.953, 3.962, '2022-12-03 18:35:45'),
	(299, '2022-11-07', 3.953, 3.962, '2022-12-03 18:36:46'),
	(300, '2022-11-08', 3.949, 3.957, '2022-12-03 18:37:02'),
	(301, '2022-11-09', 3.924, 3.936, '2022-12-03 18:37:13'),
	(302, '2022-11-10', 3.911, 3.918, '2022-12-03 18:37:49'),
	(303, '2022-11-11', 3.866, 3.87, '2022-12-03 18:38:01'),
	(304, '2022-11-12', 3.854, 3.86, '2022-12-03 18:38:10'),
	(305, '2022-11-13', 3.854, 3.86, '2022-12-03 18:38:22'),
	(306, '2022-11-14', 3.854, 3.86, '2022-12-03 18:38:32'),
	(307, '2022-11-15', 3.856, 3.86, '2022-12-03 18:38:46'),
	(308, '2022-11-16', 3.833, 3.838, '2022-12-03 18:38:57'),
	(309, '2022-11-17', 3.837, 3.842, '2022-12-03 18:39:11'),
	(310, '2022-11-18', 3.84, 3.845, '2022-12-03 18:39:21'),
	(311, '2022-11-19', 3.827, 3.841, '2022-12-03 18:39:36'),
	(312, '2022-11-20', 3.827, 3.841, '2022-12-03 18:39:51'),
	(313, '2022-11-21', 3.827, 3.841, '2022-12-03 18:40:03'),
	(314, '2022-11-22', 3.831, 3.838, '2022-12-03 18:40:13'),
	(315, '2022-11-23', 3.842, 3.846, '2022-12-03 18:40:39'),
	(316, '2022-11-24', 3.848, 3.852, '2022-12-03 18:40:51'),
	(317, '2022-11-25', 3.839, 3.85, '2022-12-03 18:41:21'),
	(318, '2022-11-26', 3.865, 3.873, '2022-12-03 18:41:33'),
	(319, '2022-11-27', 3.865, 3.873, '2022-12-03 18:41:46'),
	(320, '2022-11-28', 3.865, 3.873, '2022-12-03 18:41:54'),
	(321, '2022-11-30', 3.84, 3.847, '2022-12-03 18:42:06'),
	(322, '2022-11-29', 3.851, 3.861, '2022-12-03 18:42:18'),
	(323, '2022-12-01', 3.849, 3.854, '2022-12-03 18:42:41'),
	(324, '2022-12-02', 3.827, 3.836, '2022-12-03 18:42:56');
/*!40000 ALTER TABLE `tipo_cambio` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.transportistas
CREATE TABLE IF NOT EXISTS `transportistas` (
  `idtransportistas` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) DEFAULT NULL,
  `ruc` varchar(45) DEFAULT NULL,
  `ubigeo` int(6) unsigned zerofill DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `estado` varchar(24) DEFAULT NULL,
  `condicion` varchar(24) DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idtransportistas`),
  UNIQUE KEY `ruc_UNIQUE` (`ruc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.transportistas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `transportistas` DISABLE KEYS */;
INSERT INTO `transportistas` (`idtransportistas`, `razon_social`, `ruc`, `ubigeo`, `direccion`, `estado`, `condicion`, `actualizado`) VALUES
	(1, 'NEMECYS S.A.C.', '20607714194', 150119, 'PANAMERICANA SUR MZ. G LT. 2 ASC. DE POSESIONARIOS PLAYA SA KM. 24.6, LIMA - LIMA - LURIN', 'ACTIVO', 'HABIDO', '2022-10-15 20:28:08'),
	(2, 'INDA HAUS E.I.R.L.', '20607713872', 150140, 'JR. MONTERREY NRO. 485 URB. CHACARILLA DEL ESTANQUE DPTO. 601, LIMA - LIMA - SANTIAGO DE SURCO', 'ACTIVO', 'HABIDO', '2022-10-15 20:37:24');
/*!40000 ALTER TABLE `transportistas` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.um
CREATE TABLE IF NOT EXISTS `um` (
  `idum` int(11) NOT NULL AUTO_INCREMENT,
  `simbolo` varchar(4) DEFAULT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idum`),
  KEY `simbolo` (`simbolo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.um: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `um` DISABLE KEYS */;
INSERT INTO `um` (`idum`, `simbolo`, `descripcion`, `estado`, `actualizado`) VALUES
	(1, 'NIU', 'Unidades', 1, '2022-12-03 13:11:38'),
	(2, 'KGM', 'Kilogramos', 1, '2022-11-08 07:40:17'),
	(3, 'LTR', 'Litros', 1, '2022-11-08 07:40:31'),
	(4, 'MTR', 'Metros', 1, '2022-11-08 07:40:48'),
	(5, 'ZZ', 'Servicios', 1, '2022-11-08 07:41:08'),
	(6, 'BO', 'Botellas', 1, '2022-11-23 00:49:31'),
	(7, 'SET', 'Juego', 1, '2022-11-23 00:55:18'),
	(8, 'PK', 'Paquete', 1, '2022-11-23 00:55:15'),
	(9, 'C62', 'Piezas', 1, '2022-11-23 00:58:57'),
	(10, 'CY', 'Cilindro', 1, '2022-11-23 01:20:35'),
	(11, 'PR', 'Pares', 1, '2022-11-10 11:35:41');
/*!40000 ALTER TABLE `um` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `creado` datetime DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  PRIMARY KEY (`idusuarios`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`idusuarios`, `usuario`, `password`, `nombres`, `apellidos`, `dni`, `token`, `creado`, `actualizado`, `estado`) VALUES
	(1, 'Alfredo', '123456', 'ALFREDO', 'VISITACION MEDINA', '99999999', 'gSrXVdDzYAfNZiajWsohZkebGKtmfBuQ635MwUdbUzByh2wHNG', '2022-03-27 14:41:16', '2022-03-27 14:41:17', 1),
	(2, 'Richard', '123456', 'RICHARD', 'ROMERO ORTIZ', '84848484', '0', '2022-12-03 14:16:54', '2022-12-03 14:16:54', 2),
	(3, 'Gerente', '123456', 'JUAN', 'PEREZ VILLEGAS', '78787899', 'gSrXVdDzYAfNZiajWsohZkebGKtmfBuQ635MwUdbUzByh2wHNG', '2022-12-03 15:47:23', '2022-12-03 15:47:23', 3),
	(4, 'Vendedor', '123456', 'JOSE', 'LOPEZ ARTEAGA', '41512466', 'gSrXVdDzYAfNZiajWsohZkebGKtmfBuQ635MwUdbUzByh2wHNG', '2022-12-03 15:47:23', '2022-12-03 15:47:23', 4),
	(5, 'Logistica', '123456', 'ELENA', 'CAMPOS', '15151555', '0', '2022-12-03 15:47:23', '2022-12-03 15:47:23', 5);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla facturacion.vehiculos
CREATE TABLE IF NOT EXISTS `vehiculos` (
  `idvehiculos` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(45) DEFAULT NULL,
  `placa` varchar(8) DEFAULT NULL,
  `inscripcion` varchar(15) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `idtransportistas` int(11) NOT NULL,
  `actualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idvehiculos`,`idtransportistas`),
  KEY `fk_vehiculos_transportistas1_idx` (`idtransportistas`),
  CONSTRAINT `fk_vehiculos_transportistas1` FOREIGN KEY (`idtransportistas`) REFERENCES `transportistas` (`idtransportistas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla facturacion.vehiculos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` (`idvehiculos`, `marca`, `placa`, `inscripcion`, `estado`, `idtransportistas`, `actualizado`) VALUES
	(3, 'HYUNDAI', 'ABC-444', '1515151516', 1, 2, '2022-10-15 20:37:42'),
	(4, 'HYUNDAI', 'ABC-123', '1515151515', 1, 2, '2022-10-29 19:18:02'),
	(5, 'HYUNDAI', 'ABC-345', '1515151517', 1, 1, '2022-10-29 19:18:33');
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
