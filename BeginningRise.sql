-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: beginningrise2
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administradores` (
  `email_administrador` varchar(45) NOT NULL,
  PRIMARY KEY (`email_administrador`),
  CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`email_administrador`) REFERENCES `persona` (`email_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES ('bing@chilling.com'),('prueba@admin.com');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrito` (
  `email_cliente` varchar(45) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`email_cliente`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `clientes` (`email_cliente`),
  CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrito_productos`
--

DROP TABLE IF EXISTS `carrito_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrito_productos` (
  `email_cliente` varchar(45) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`email_cliente`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `carrito_productos_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `carrito` (`email_cliente`),
  CONSTRAINT `carrito_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito_productos`
--

LOCK TABLES `carrito_productos` WRITE;
/*!40000 ALTER TABLE `carrito_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `email_cliente` varchar(45) NOT NULL,
  `direccion_cliente` varchar(40) NOT NULL,
  `telefono_cliente` bigint(10) NOT NULL,
  KEY `email_cliente` (`email_cliente`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `persona` (`email_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES ('bodoquejuan@outlook.com','Calle 26 Sur #25-49',3066132694);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id_marca` varchar(4) NOT NULL,
  `marca` varchar(15) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_marca`),
  UNIQUE KEY `marca` (`marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES ('M_01','Lenovo',1),('M_02','Acer',1),('M_03','MSI',1),('M_04','HP',1),('M_05','ASUS',1);
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id_producto` int(11) NOT NULL,
  `email_cliente` varchar(45) NOT NULL,
  `nit_tienda` varchar(11) NOT NULL,
  PRIMARY KEY (`id_producto`,`email_cliente`,`nit_tienda`),
  KEY `email_cliente` (`email_cliente`),
  KEY `nit_tienda` (`nit_tienda`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`email_cliente`) REFERENCES `clientes` (`email_cliente`),
  CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`nit_tienda`) REFERENCES `tiendas` (`nit_tienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `tipo_documento_persona` varchar(10) NOT NULL,
  `num_doc_persona` varchar(10) NOT NULL,
  `nombre_persona` varchar(68) DEFAULT NULL,
  `email_persona` varchar(45) NOT NULL,
  `contrasena_persona` varchar(255) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `foto_perfil` blob DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`email_persona`),
  UNIQUE KEY `contrase├▒a_persona` (`contrasena_persona`),
  KEY `tipo_documento_persona` (`tipo_documento_persona`),
  CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`tipo_documento_persona`) REFERENCES `tipo_documento` (`t_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES ('C.E.','46541268','John Xina','bing@chilling.com','$2y$10$WLpr88SmywxqAmxSg4.fZeJ26c//6CimlC.mf90jG43k1ohbO1IVq','2022-11-23 22:40:53','2022-11-23 22:40:53','config/img/persona/johnxina.jpg',1),('C.E.','65125694','Juan Carlos Bodoque','bodoquejuan@outlook.com','$2y$10$m6lzuMsfSz50k4gRBvm5jO4732v5suHqKEqc34w1L5M5aUWM9quXy','2022-12-06 22:06:14','2022-12-06 22:06:14','config/img/persona/bodoque.jpg',1),('C.C.','79325649','Admin Poppy','prueba@admin.com','$2y$10$AM6DPP8uQSwe5nVVx5tMduore0ZGE3bHqKC4oAtZlGjbAyLenUknS','2022-11-24 00:14:53','2022-11-24 19:10:48','config/img/persona/pruebas.jpg',1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_marca` varchar(4) DEFAULT NULL,
  `nombre_producto` varchar(90) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `almacenamiento` varchar(64) NOT NULL,
  `procesador` varchar(64) NOT NULL,
  `ram` varchar(64) NOT NULL,
  `pantalla` varchar(64) NOT NULL,
  `grafica` varchar(64) NOT NULL,
  `bateria` varchar(64) NOT NULL,
  `precio` int(11) NOT NULL,
  `descuento` int(2) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `imagen` mediumblob DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `nombre_producto` (`nombre_producto`),
  KEY `id_marca` (`id_marca`),
  KEY `id_tipo` (`id_tipo`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`),
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (24,'M_02','Aspire 5 A515-54-56KR',1,'SSD 256GB','Intel Core i5 10210U','8GB de RAM DDR4','15.6\" 60Hz','Gr├íficos Integrados Intel UHD Graphics','Li-Ion 3 Celdas 48Wh',2499900,0,'2022-12-07 08:59:25','2022-12-07 08:59:25','config/img/productos/aspire-5-a515-54-56kr.png',1),(25,'M_05','E410',1,'256 GB SSD','Intel┬« Celeron┬« N4020','4GB de RAM','14\" 60Hz','Gr├íficos Integrados Intel UHD Graphics','Ion de litio',1799000,0,'2022-12-07 09:00:39','2022-12-07 09:00:39','config/img/productos/asus-e410.png',1),(27,'M_04','Notebook 15-db0011la',1,'HDD 1TB','AMD A9-9425 ','8GB de RAM DDR4-2666MHz','15.6\" 60Hz','Integrados AMD Radeon R5','Li-Ion 3 celdas y 41 Wh',1680000,0,'2022-12-07 09:02:29','2022-12-07 09:02:29','config/img/productos/hp-15-db0011la.png',1),(28,'M_01','IdeaPad 3 Intel Celeron',1,'1TB HDD','Procesador Intel Celeron N4020','4GB de RAM','14\" 60Hz','Gr├íficos Integrados Intel UHD Graphics','Li-Ion 2 celdas de 35 Wh',1749000,0,'2022-12-07 09:04:21','2022-12-07 09:04:21','config/img/productos/ideapad3-intel-celeron.png',1),(29,'M_01','IdeaPad Gaming 3i 6ta',2,'NVMe 512GB','Intel Core i5-11300H',' 8GB de RAM DDR4-3200MHz','15,6 \" 165Hz','NVIDIA GeForce 1650','Li-Poli de 3 celdas, 45Wh',4099900,0,'2022-12-07 09:06:51','2022-12-07 09:06:51','config/img/productos/lenovo-laptop-ideapad-gaming-3i-gen-6-15-intel-subseries.png',1),(30,'M_02','Nitro 5 AN517-54-73Z3',2,'NVMe 1TB','Intel Core i7-11800H','16GB (2x8GB) de RAM DDR4-3200MHz','17.3\" 144Hz','NVIDIA GeForce RTX 3060','4-Celdas Ion Litio (Li-Ion)',5416619,0,'2022-12-07 09:08:42','2022-12-07 09:08:42','config/img/productos/Nitro-5-A517.webp',1),(31,'M_04','Pavilion Gaming 15-ec1037la',2,'NVMe 512GB','Ryzen 5 4600H','8GB de RAM DDR4-3000MHz','15.6\" 165Hz','NVIDIA GeForce GTX 1650Ti 4GB','Li-Poli 3 celdas y 52,5 Wh',3795789,0,'2022-12-07 09:12:09','2022-12-07 09:12:09','config/img/productos/PAVILION GAMING 15-ec1037la.webp',1),(32,'M_05','ROG Zephyrus Duo 15 SE GX551',2,'NVMe 1TB','AMD Ryzen 9 5900HX','16GB (2x8GB) de RAM DDR4-3200MHz','15.6\" 120Hz','NVIDIA┬« GeForce RTXÔäó 3080','Li-Poli',15999900,0,'2022-12-07 09:16:28','2022-12-07 09:16:28','config/img/productos/ROG-zephyrus-duo-15-se-gx551.png',1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiendas`
--

DROP TABLE IF EXISTS `tiendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiendas` (
  `nit_tienda` varchar(11) NOT NULL,
  `nombre_tienda` varchar(40) NOT NULL,
  `direccion_tienda` varchar(40) NOT NULL,
  `telefono_tienda` bigint(10) NOT NULL,
  `email_tienda` varchar(45) NOT NULL,
  `contrasena_tienda` varchar(255) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `foto_tienda` mediumblob NOT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`nit_tienda`),
  UNIQUE KEY `email_tienda` (`email_tienda`),
  UNIQUE KEY `contrase├▒a_tienda` (`contrasena_tienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiendas`
--

LOCK TABLES `tiendas` WRITE;
/*!40000 ALTER TABLE `tiendas` DISABLE KEYS */;
INSERT INTO `tiendas` VALUES ('9463154887','Vampix','Calle 80 #16-84',3011485697,'vampix@vampix.com','$2y$10$.syHD2KNYaiGlY3lszxs/.n4n.A2o9rfj8WyCpN5EDxgkYzejrGiK','2022-11-23 08:18:03','2022-11-23 08:25:16','config/img/tiendas/vampix.jpg',1);
/*!40000 ALTER TABLE `tiendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiendas_productos`
--

DROP TABLE IF EXISTS `tiendas_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiendas_productos` (
  `nit_tienda` varchar(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  KEY `nit_tienda` (`nit_tienda`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `tiendas_productos_ibfk_1` FOREIGN KEY (`nit_tienda`) REFERENCES `tiendas` (`nit_tienda`),
  CONSTRAINT `tiendas_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiendas_productos`
--

LOCK TABLES `tiendas_productos` WRITE;
/*!40000 ALTER TABLE `tiendas_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiendas_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo`),
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (2,'Gamer'),(1,'Ofim├ítica');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_documento` (
  `t_doc` varchar(10) NOT NULL,
  `nombre_t_doc` varchar(40) NOT NULL,
  PRIMARY KEY (`t_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES ('C.C.','C├®dula de Ciudadan├¡a'),('C.E.','C├®dula de Extranjer├¡a'),('T.I.','Tarjeta de Identidad');
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas` (
  `id_ventas` varchar(8) NOT NULL,
  `email_cliente` varchar(45) NOT NULL,
  `nit_tienda` varchar(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ventas`),
  KEY `email_cliente` (`email_cliente`),
  KEY `nit_tienda` (`nit_tienda`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `clientes` (`email_cliente`),
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`nit_tienda`) REFERENCES `tiendas` (`nit_tienda`),
  CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-07  9:20:41
