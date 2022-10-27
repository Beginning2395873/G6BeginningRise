-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: beginningrise
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES ('adr_hermon4495@outlook.com'),('cam_cormon8326@gmail.com'),('gab_hermor2154@gmail.com'),('juanbodoque@31minutos.com');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
INSERT INTO `carrito` VALUES ('dan_cassal6238@gmail.com',2,'2022-09-16','2022-09-16'),('hug_camvar6943@gmail.com',4,'2022-09-16','2022-09-16'),('lau_rodtor3699@gmail.com',3,'2022-09-16','2022-09-16');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito_productos`
--

LOCK TABLES `carrito_productos` WRITE;
/*!40000 ALTER TABLE `carrito_productos` DISABLE KEYS */;
INSERT INTO `carrito_productos` VALUES ('dan_cassal6238@gmail.com',2),('hug_camvar6943@gmail.com',3),('lau_rodtor3699@gmail.com',4);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES ('dan_cassal6238@gmail.com','Carrera 50 #60 - 34',3129578823),('hug_camvar6943@gmail.com','Diagonal 122 #122 - 24',3206857273),('lau_rodtor3699@gmail.com','Avenida 10 #164 - 11',3501678520),('carlitos@lechuga.com','Carrera 95 #7-96',3224599555);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
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
  `contraseña_persona` varchar(45) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `foto_perfil` blob DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`email_persona`),
  UNIQUE KEY `contraseña_persona` (`contraseña_persona`),
  KEY `tipo_documento_persona` (`tipo_documento_persona`),
  CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`tipo_documento_persona`) REFERENCES `tipo_documento` (`t_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES ('C.C.','1030525089','Adriana Carolina Hernández Monterroza','adr_hermon4495@outlook.com','1234','2022-09-12 19:52:52','2022-09-17 15:47:28','../config/img/persona/adr_hermon.jpg',1),('C.C.','1018424181','Camilo Alberto Cortés Montejo','cam_cormon8326@gmail.com','123456','2022-09-12 19:52:52','2022-09-12 19:52:52','',1),('C.C.','1033255489','Carlitos Lechuga Segundo','carlitos@lechuga.com','lechuga','2022-09-17 14:39:58','2022-09-17 14:58:33','../config/img/persona/carlitos-lechuga.webp',1),('C.E.','E-3718248','Daniel Castiblanco Salgado','dan_cassal6238@gmail.com','12345','2022-09-12 19:52:52','2022-09-12 19:52:52','',1),('C.E.','E-4194180','Gabriel Felipe Herrera Moreno','gab_hermor2154@gmail.com','felipeherrera','2022-09-12 19:52:52','2022-09-12 19:52:52','',1),('T.I.','1026255233','Hugo Camargo','hug_camvar6943@gmail.com','hugocamargo','2022-09-12 19:52:52','2022-09-12 19:52:52','',1),('C.C.','1051447778','Juan Carlos Bodoque','juanbodoque@31minutos.com','bodoque31','2022-09-17 16:00:01','2022-09-17 16:00:41','../config/img/persona/juan-carlos-bodoque.webp',1),('T.I.','1024518426','Laura Fernanda Rodríguez','lau_rodtor3699@gmail.com','55555555','2022-09-12 19:52:52','2022-09-12 19:52:52','',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'M_04','Pavilion Gaming 15-ec1037la',2,'SSD M.2 512GB','Ryzen 5 4600H','8GB de RAM DDR4','15.6\" 120Hz','NVIDIA GeForce GTX 1650Ti 4GB','Li-Poli 3 celdas 52,5 Wh',2800000,'2022-09-16 11:31:15','2022-09-16 11:31:36','../config/img/productos/hp-pgaming-15.png',1),(2,'M_02','Nitro 5 AN517-54-73Z3',2,'SSD M.2 1TB','Intel Core i7-11800H','16GB de RAM DDR4','17.3\" 144Hz','NVIDIA GeForce RTX 3060','Li-Ion 4 celdas',5416700,'2022-09-16 11:31:15','2022-09-16 19:40:31','../config/img/productos/acer-nitro-5.png',1),(3,'M_05','ROG Zephyrus Duo 15 SE GX551',2,'SSD M.2 1TB','Ryzen 9 5900HX','16GB de RAM DDR4','15.6\" 120Hz','NVIDIA GeForce RTX 3080','Li-Ion',15999900,'2022-09-16 11:31:15','2022-09-16 19:41:10','../config/img/productos/rog-zephirus-duo-15.png',1),(4,'M_01','IdeaPad 3 81WA00C3LM',1,'SSD 256GB','Intel Pentium Gold 6405U','8GB de RAM DDR4','14\" 60Hz','Gráficos Integrados Intel UHD Graphics','Li-ion',1449900,'2022-09-16 11:31:15','2022-09-16 19:42:37','../config/img/productos/lenovo-ideapad-3.jpg',1),(5,'M_03','GF65',2,'SSD M.2 512GB','Intel Core i7-10750H','8GB de RAM DDR4','15.6\" 144Hz','NVIDIA GeForce RTX 3060','Li-Poli 3 celdas 51 Wh',5699900,'2022-09-16 11:31:15','2022-09-16 19:43:13','../config/img/productos/msi-gf65.jpg',1),(21,'M_04','Notebook 15-db0011la',1,'1TB HDD','AMD A9-9425 ','8GB DDR4','15.6\" 60Hz','Integrados AMD Radeon R5','Li-Ion 3 Celdas, ',1520000,'2022-09-16 22:33:52','2022-09-16 22:35:07','../config/img/productos/hp-notebook-15.jpg',2),(22,'M_02','Aspire 5 A515-54-56KR',1,'256GB SSD','Intel Core i5 10210U','8GB de RAM DDR4','15.6\" 60Hz','Gráficos Integrados Intel UHD Graphics','Li-Ion 3 Celdas 48Wh',2799900,'2022-09-16 23:28:23','2022-09-16 23:30:58','../config/img/productos/acer-aspire-5.jpg',2);
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
  `contraseña_tienda` varchar(45) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `foto_tienda` mediumblob NOT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`nit_tienda`),
  UNIQUE KEY `email_tienda` (`email_tienda`),
  UNIQUE KEY `contraseña_tienda` (`contraseña_tienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiendas`
--

LOCK TABLES `tiendas` WRITE;
/*!40000 ALTER TABLE `tiendas` DISABLE KEYS */;
INSERT INTO `tiendas` VALUES ('900924451-9','KAMALEON LTDA','Carrera 10 #85 - 9',3125391912,'klt40n35@hotmail.com','KAMALEONLTDA3125391912.','2022-09-12 00:00:00','2022-09-12 00:00:00','',1),('901101602-6','DRAKO TECNOLOGIA SUS','Diagonal 39 #3 - 33',3151469468,'dr4k0tech48@outlook.com','dr4k05864','2022-09-12 00:00:00','2022-09-17 13:39:53','../config/img/tiendas/drako_tec.jpg',1),('901101602-8','Vampix','Avenida 23 #76 - 46',3244228549,'vampixt0re_45@gmail.com','vampix55443987','2022-09-12 00:00:00','2022-09-17 13:43:31','../config/img/tiendas/vampix.jpg',1),('9885552-8','PruebasTech','Calle 26 Sur # 26-26',3215444578,'Pruebas@tech.com','123456','2022-09-17 12:40:47','2022-09-17 13:45:43','../config/img/tiendas/poppy.jpg',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiendas_productos`
--

LOCK TABLES `tiendas_productos` WRITE;
/*!40000 ALTER TABLE `tiendas_productos` DISABLE KEYS */;
INSERT INTO `tiendas_productos` VALUES ('901101602-8',1),('901101602-8',2),('900924451-9',4),('900924451-9',3),('901101602-6',5),('901101602-6',2),('901101602-6',4),('901101602-8',4),('901101602-8',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (2,'Gamer'),(1,'Ofimática');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES ('C.C.','Cédula de Ciudadanía'),('C.E.','Cédula de Extranjería'),('T.I.','Tarjeta de Identidad');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES ('V_0001','dan_cassal6238@gmail.com','901101602-8',2,'2022-09-16 17:20:22'),('V_0012','hug_camvar6943@gmail.com','901101602-8',3,'2022-09-16 17:20:22'),('V_0033','lau_rodtor3699@gmail.com','901101602-8',4,'2022-09-16 17:20:22');
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

-- Dump completed on 2022-09-17 16:05:04
