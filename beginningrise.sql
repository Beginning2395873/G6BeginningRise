-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2023 a las 06:15:26
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `beginningrise`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `email_administrador` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`email_administrador`) VALUES
('bmmotta0@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `email_cliente` varchar(45) NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_productos`
--

CREATE TABLE `carrito_productos` (
  `email_cliente` varchar(45) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nit_tienda` bigint(11) NOT NULL,
  `cantidad` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `email_cliente` varchar(45) NOT NULL,
  `direccion_cliente` varchar(40) NOT NULL,
  `telefono_cliente` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`email_cliente`, `direccion_cliente`, `telefono_cliente`) VALUES
('bodoquejuan@outlook.com', 'Calle 26 Sur #25-49', 3066132694),
('branmichellmv@gmail.com', 'Calle 30 Sur #26A-28', 3012814712);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` varchar(4) NOT NULL,
  `marca` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `marca`) VALUES
('M_01', 'Lenovo'),
('M_02', 'Acer'),
('M_03', 'MSI'),
('M_04', 'HP'),
('M_05', 'ASUS'),
('M_06', 'DELL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `tipo_documento_persona` varchar(10) NOT NULL,
  `num_doc_persona` bigint(10) NOT NULL,
  `nombre_persona` varchar(68) DEFAULT NULL,
  `email_persona` varchar(45) NOT NULL,
  `contrasena_persona` varchar(255) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `foto_perfil` mediumblob DEFAULT NULL,
  `estado` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`tipo_documento_persona`, `num_doc_persona`, `nombre_persona`, `email_persona`, `contrasena_persona`, `fecha_creacion`, `fecha_actualizacion`, `foto_perfil`, `estado`) VALUES
('C.C.', 52683254, 'Alan José Britto', 'bmmotta0@hotmail.com', '$2y$10$nuw5EdTJoJLzwBN3D5YMMOe7/bFIsh6t9iwALiby5sAkjN37DzY/C', '2023-03-13 12:31:03', '2023-03-23 00:11:43', 0x636f6e6669672f696d672f706572736f6e612f61646d696e2e706e67, 1),
('C.E.', 65125694, 'Juan Benitez', 'bodoquejuan@outlook.com', '$2y$10$YpIweiuqwPzGowYzUqiP9.ZiKc9MhArMXVYftVkiNBxUAvl2qPMDK', '2022-12-06 22:06:14', '2023-03-22 21:26:33', 0x636f6e6669672f696d672f706572736f6e612f626f646f7175652e77656270, 1),
('C.C.', 1000727700, 'Brandon Motta Vega', 'branmichellmv@gmail.com', '$2y$10$8HpADQs8x9rTbJXCYicuQ.QDr1jlzmhZfDEX8vztdTuxVPDYd/Jia', '2023-03-10 15:16:42', '2023-03-23 00:13:53', 0x636f6e6669672f696d672f706572736f6e612f, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_marca` varchar(4) DEFAULT NULL,
  `nombre_producto` varchar(90) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `procesador` varchar(64) NOT NULL,
  `pantalla` varchar(64) NOT NULL,
  `grafica` varchar(64) NOT NULL,
  `bateria` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_marca`, `nombre_producto`, `id_tipo`, `procesador`, `pantalla`, `grafica`, `bateria`) VALUES
(1, 'M_02', 'TravelMate P2 TMP215-53-57F4', 2, 'Intel Core i5-1135G7', '15.6\" 60Hz ', 'Gráficos Intel Iris', 'Li-Ion 3 Celdas 48Wh'),
(2, 'M_02', 'Helios 300 PH315-54-748Y', 1, 'Intel Core i7-11800H 2.3Ghz', '15.6 \" 144 Hz', 'NVIDIA GeForce RTX 3050 Ti', 'Li-Ion 4 celdas'),
(3, 'M_05', 'X415JA', 2, 'Intel Core i3 1005G1', '14\" 60Hz', 'Gráficos Integrados Intel UHD Graphics', '37WHrs, 2S1P, 2-cell Li-ion'),
(4, 'M_05', 'M513IA-BN738', 1, 'AMD Ryzen 7 4700U 2.0Ghz', '15.6\" 60Hz', 'Gráficos integrados AMD Radeon Vega 7', '3 Celdas Li-ion 42Wh'),
(5, 'M_05', 'ROG Zephyrus Duo 15 SE GX551', 1, 'AMD Ryzen 9 5900HX', '15.6\" 144Hz', 'NVIDIA GeForce RTX 3080', 'Ion de litio'),
(6, 'M_06', 'Latitude 15 3520', 1, 'Intel Core i5-1135G7', '15.6\" 60Hz', 'Gráficos Intel Iris', 'Li-Poli 3 celdas 41 Wh'),
(7, 'M_06', 'Inspiron 15', 2, 'AMD Ryzen 5 3450U', '15.6\" 60Hz', 'Integrados Radeon Vega 3', 'Li-Ion'),
(8, 'M_04', '240 G7 11-2001xx', 2, 'AMD Athlon', '14\" 60Hz', 'Integrados Radeon Vega 3', 'Iones de litio'),
(9, 'M_04', '14-cf2506la', 2, 'Intel Celeron N4020', '14\" 40Hz', 'Integrados Intel® UHD 600', 'Iones de litio de 3 celdas y 41 Wh'),
(10, 'M_03', 'Titan GT77HX 13VI-006ES', 1, 'Intel Core i9-13980HX', '17.3\" 144Hz', 'NVIDIA GeForce RTX 4090', '173\" 144Hz'),
(11, 'M_02', 'Nitro 5 AN517-54-73Z3', 1, 'Intel Core i7-11800H 2.3Ghz', '17.3\" 144Hz', 'NVIDIA GeForce RTX 3060', 'Li-Ion 4 celdas'),
(12, 'M_05', 'TUF Gaming F15', 1, 'Intel Core i5-10300H', '15.6\" 144Hz', 'NVIDIA GeForce GTX 1650', '48 Wh, 3S1P, 3 celdas Li-ion'),
(13, 'M_05', 'TUF Dash F15', 1, 'Intel Core i7-11375H', '15.6\" 144Hz', 'NVIDIA GeForce RTX 3050', 'Li-Ion'),
(14, 'M_06', 'Precision 5770', 1, 'Intel Core i5-12600H', '17.3\" 60Hz', 'Intel HD UMA Graphics', '3 Cell, 56 Wh, Lithium Ion'),
(15, 'M_04', '14-cf2512la ', 2, 'Intel Pentium Gold 6405U', '14\" 60Hz', 'Gráficos Intel® UHD', 'Iones de litio'),
(16, 'M_01', 'Legion 5i 7ma Gen', 1, 'Intel Core i7-12700H', '15.6\" 165 Hz', 'NVIDIA GeForce RTX 3060', '4 celdas, 80Wh'),
(17, 'M_01', 'IdeaPad 3 Intel Celeron', 2, 'Intel Celeron N4020', '14\" 60Hz', 'Gráficos Integrados Intel UHD Graphics', '2 celdas de 35 Wh'),
(18, 'M_03', 'Bravo 17', 1, 'AMD Ryzen 7 4800H', '17.3\" 120Hz', 'AMD RADEON RX 5500M', 'Li-Poli'),
(19, 'M_03', 'GF76', 1, 'Intel Core i7 11800H', '17.3\" 240Hz', 'NVIDIA GeForce RTX 3060', 'Li-Poli 535(Whr)'),
(20, 'M_02', 'Swift 5        ', 1, 'Intel Core i7-1165G7        ', '14\" FHD IPS', 'Intel Iris Xe', '56 Wh        '),
(21, 'M_02', 'Aspire 5 A515-54-56KR', 2, 'Intel Core i5 10210U 1.6Ghz', '15.6\" 60Hz', 'Gráficos Integrados Intel UHD Graphics', 'Li-Ion 3 Celdas 48Wh'),
(22, 'M_05', 'E410', 2, 'Intel Celeron N4020', '14\" 60Hz', 'Gráficos Integrados Intel UHD Graphics', 'Ion de litio'),
(23, 'M_06', 'Latitude 14 9430', 1, 'Intel Core i5-1245U', '14\" 60Hz', 'Gráficos Intel Iris', '40 Wh, ExpressCharge™'),
(24, 'M_04', 'PAVILION GAMING 15-ec1037la', 1, 'AMD Ryzen 5 4600H', '15.6\" 165Hz', 'NVIDIA GeForce GTX 1650Ti 4GB', 'Li-Poli 3 celdas y 52,5 Wh'),
(25, 'M_04', 'Notebook 15-db0011la', 2, 'AMD A9-9425', '15.6\" 60Hz', 'Integrados AMD Radeon Vega 5', 'Iones de litio de 3 celdas y 41 Wh'),
(26, 'M_04', '14-dq2021la', 2, 'Intel Core i3-1115G4', '14\" 60Hz', 'Integrados Intel UHD Graphics', 'Iones de litio de 3 celdas y 41 Wh'),
(27, 'M_01', 'IdeaPad Gaming 3i 6ta', 1, 'Intel Core i5-11300H', '15,6 \" 165Hz', 'Integrados Intel UHD Graphics + NVIDIA GeForce 1650', 'Li-Poli de 3 celdas, 45Wh'),
(28, 'M_01', 'IdeaPad 3 81WA00C3LM', 2, 'Intel Pentium Gold 6405U', '14\" 60Hz', 'Gráficos Integrados Intel UHD Graphics', 'Li-Ion'),
(29, 'M_03', 'GF65', 1, 'Intel Core i7-10750H', '15.6\" 144Hz', 'Gráficos NVIDIA GeForce RTX 3060', '3 Celdas Li-Poli 51Whr'),
(30, 'M_03', 'Thin GF63', 1, 'Intel Core i5 9300H', '15.6\" 120Hz', ' NVIDIA GeForce GTX 1650', 'Polímero de litio'),
(31, 'M_06', 'Vostro 3400', 2, 'Core i5 1135 G7', '14\" 120Hz', 'Inter Iris Xe', 'Iones de litio'),
(32, 'M_06', '3505', 2, 'AMD RYZEN 5 3450U ', '15.6  HD LCD', ' AMD RADEON VEGA 8 GRAPHICS', '40 Wh, ExpressCharge™'),
(33, 'M_01', 'IP 5 pro', 1, 'AMD Ryzen 9 5900HX', '15.6\" 60Hz', 'RTX 3050', 'Li-Poli'),
(34, 'M_01', 'ThinkPad X1 Carbon', 1, 'Intel Core i7-1165G7        ', '14\" FHD IPS', 'Intel Iris Xe', '4 Celdas '),
(35, 'M_04', 'Spectre x360', 1, 'Intel Core i7-1165G7        ', '14\" FHD IPS', 'AMD Radeon ', '47.4 Wh'),
(36, 'M_04', 'IPS Pantalla táctil ', 2, 'Intel Core i5-1135G7', '15.6\"', ' Intel Iris Xe', 'Li-Poli de 3 celdas, 45Wh'),
(37, 'M_05', 'Vivobook', 2, ' Intel Core i5-10300H', '15.6\" 144Hz', 'Graficos integrados Intel UHD', '3 Celdas Li-ion 42Wh'),
(38, 'M_04', 'Zbook Firefly', 1, 'Intel Core i7 -1165G7', '15,6\" 144Hz', 'NVIDIA T500', 'Iones de litio'),
(39, 'M_03', 'Stealth 15M', 1, 'Intel Core i7-11375H', '15.6\" 144Hz', 'NVIDIA GeForce RTX 3060', '3 cell , 52Whr'),
(40, 'M_01', 'Yoga Slim 7i Pro', 1, 'Intel Core i7-12700H', '14\" 60Hz', 'Gráficos Intel Iris', '3 Celdas Li-Poli');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `nit_tienda` bigint(11) NOT NULL,
  `nombre_tienda` varchar(40) NOT NULL,
  `direccion_tienda` varchar(40) NOT NULL,
  `telefono_tienda` bigint(10) NOT NULL,
  `email_tienda` varchar(45) NOT NULL,
  `contrasena_tienda` varchar(255) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `foto_tienda` mediumblob NOT NULL,
  `banner_prom` mediumblob DEFAULT NULL,
  `estado` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`nit_tienda`, `nombre_tienda`, `direccion_tienda`, `telefono_tienda`, `email_tienda`, `contrasena_tienda`, `fecha_creacion`, `fecha_actualizacion`, `foto_tienda`, `banner_prom`, `estado`) VALUES
(9009554091, 'Andromeda PC', 'Transversal 71 #116 - 40', 3223096136, 'pcandromeda88@gmail.com', '$2y$10$nilZeE7DyeoQC5Y/LrY0t./cHHpdIMWync/6aEGg4ju3qERoj1i2a', '2023-03-05 21:42:07', '2023-03-05 23:18:43', 0x636f6e6669672f696d672f7469656e6461732f416e64726f6d6564612e706e67, 0x636f6e6669672f696d672f62616e6e6572732f616e64726f6d6564612e6a7067, 1),
(9011016026, 'CyP SAS', 'Carrera 64 #28 - 28', 3112778366, 'cyperi@outlook.com', '$2y$10$ip1QwKAoLW2D15mMQRQpauhwiBTe1wYAmJjvIXwjp8M16KDnoQTgK', '2023-03-05 21:39:11', '2023-03-05 23:18:21', 0x636f6e6669672f696d672f7469656e6461732f6379702e706e67, 0x636f6e6669672f696d672f62616e6e6572732f6379702e6a7067, 1),
(9100710098, 'tech tom', 'calle 13', 3108676758, 'mottaproplayer@gmail.com', '$2y$10$m0VLWOd2crHM8r4SG3HRkO9sTBdVuofiVxxQDC.rVnOufmpc4KJgW', '2023-03-17 16:29:30', '2023-03-17 16:29:30', 0x636f6e6669672f696d672f7469656e6461732f54656368546f6d2e706e67, NULL, 1),
(9463154887, 'Vampix', 'Calle 80 #16-86', 3219481984, 'vampix@vampix.com', '$2y$10$p0W5sp4Meu7wBxLnnn7e3es5ljYzsddRAghLZXu0t1OehZ6AK3xWy', '2022-11-23 08:18:03', '2023-03-22 21:26:54', 0x636f6e6669672f696d672f7469656e6461732f76616d7069782e6a7067, 0x636f6e6669672f696d672f62616e6e6572732f76616d706978202832292e6a7067, 1),
(9885365489, 'Drako Tech SAS', 'Diagonal 39 #3-33', 3143676772, 'drakotech@drak.com', '$2y$10$ZdKyXxCg1bFsSzR0l9r8ZepetrZO2WBCog/DmdGm8jR4QAuQpvxmi', '2023-03-01 12:52:51', '2023-03-05 23:10:07', 0x636f6e6669672f696d672f7469656e6461732f6472616b6f5f7465632e6a7067, 0x636f6e6669672f696d672f62616e6e6572732f6472616b6f7465632e6a7067, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas_productos`
--

CREATE TABLE `tiendas_productos` (
  `nit_tienda` bigint(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `almacenamiento` varchar(64) NOT NULL,
  `ram` varchar(64) NOT NULL,
  `precio` bigint(11) NOT NULL,
  `descuento` int(2) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `imagen` mediumblob DEFAULT NULL,
  `estado` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiendas_productos`
--

INSERT INTO `tiendas_productos` (`nit_tienda`, `id_producto`, `almacenamiento`, `ram`, `precio`, `descuento`, `fecha_creacion`, `fecha_actualizacion`, `imagen`, `estado`) VALUES
(9009554091, 31, 'SSD 1TB', '8GB DDR4', 2527999, 6, '2023-03-09 00:46:41', '2023-03-09 00:56:56', 0x636f6e6669672f696d672f70726f647563746f732f44656c6c2d566f7374726f2d333430302e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 2),
(9009554091, 32, 'SSD 1TB', '16GB DDR4', 2039900, 0, '2023-03-09 00:47:54', '2023-03-09 00:47:54', 0x636f6e6669672f696d672f70726f647563746f732f44656c6c2d333530352e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 1),
(9009554091, 33, 'SSD 1TB', '32GB DDR5', 6959130, 45, '2023-03-09 00:48:50', '2023-03-09 00:57:14', 0x636f6e6669672f696d672f70726f647563746f732f4c656e6f766f2d49502d352d70726f2e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 2),
(9009554091, 34, 'SSD 500GB', '16GB DDR4 ', 7093282, 0, '2023-03-09 00:50:21', '2023-03-09 00:50:21', 0x636f6e6669672f696d672f70726f647563746f732f4c656e6f766f2d5468696e6b5061642d58312d436172626f6e2e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 1),
(9009554091, 35, 'SSD 500GB', '16GB DDR4', 7566483, 5, '2023-03-09 00:51:29', '2023-03-09 00:57:05', 0x636f6e6669672f696d672f70726f647563746f732f485020537065637472652e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 2),
(9009554091, 36, 'SSD 1TB', '16GB DDR4', 3411290, 10, '2023-03-09 00:52:54', '2023-03-09 00:57:35', 0x636f6e6669672f696d672f70726f647563746f732f48502d4950532e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 2),
(9009554091, 37, 'SSD 500GB', '16GB DRR4', 3099000, 2, '2023-03-09 00:54:19', '2023-03-09 00:57:52', 0x636f6e6669672f696d672f70726f647563746f732f417375732d5669766f626f6f6b2e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 2),
(9009554091, 38, ' NVMe  500GB', '16GB DDR4-3200', 5599000, 0, '2023-03-09 00:55:12', '2023-03-09 00:55:12', 0x636f6e6669672f696d672f70726f647563746f732f4850207a626f6f6b2e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 1),
(9009554091, 39, 'NVMe 1TB', '8GB DDR4-3200MHz', 11435409, 15, '2023-03-09 00:56:01', '2023-03-09 00:57:25', 0x636f6e6669672f696d672f70726f647563746f732f4d53492d537465616c74682d31354d5f3030312e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 2),
(9009554091, 40, 'SSD 1TB', '16GB  LPDDR5-4800', 4499900, 0, '2023-03-09 00:56:46', '2023-03-09 00:56:46', 0x636f6e6669672f696d672f70726f647563746f732f596f676120536c696d2037692050726f2e7063616e64726f6d656461383840676d61696c2e636f6d2e706e67, 1),
(9011016026, 21, 'NVMe 250GB', '8GB DDR4-2400MHz', 2799900, 1, '2023-03-09 00:29:32', '2023-03-09 00:44:48', 0x636f6e6669672f696d672f70726f647563746f732f413531352d35342d35364b522e637970657269406f75746c6f6f6b2e636f6d2e706e67, 2),
(9011016026, 22, 'SSD 250GB', '4GB DDR4', 1799000, 0, '2023-03-09 00:30:25', '2023-03-09 00:30:25', 0x636f6e6669672f696d672f70726f647563746f732f453431302e637970657269406f75746c6f6f6b2e636f6d2e706e67, 1),
(9011016026, 23, 'NVMe 500GB', '32GB LPDDR5-5200MHz', 13323175, 60, '2023-03-09 00:31:19', '2023-03-09 00:44:58', 0x636f6e6669672f696d672f70726f647563746f732f4c6174697475646520313420393433302e637970657269406f75746c6f6f6b2e636f6d2e706e67, 2),
(9011016026, 24, 'NVMe 500GB', '8GB DDR4-3000MHz', 3795789, 0, '2023-03-09 00:32:05', '2023-03-09 00:32:05', 0x636f6e6669672f696d672f70726f647563746f732f504156494c494f4e2047414d494e472031352d6563313033376c612e637970657269406f75746c6f6f6b2e636f6d2e706e67, 1),
(9011016026, 25, 'HDD 1TB', '8GB DDR4-2666MHz', 1680000, 0, '2023-03-09 00:32:53', '2023-03-09 00:32:53', 0x636f6e6669672f696d672f70726f647563746f732f4e6f7465626f6f6b2031352d6462303031316c612e637970657269406f75746c6f6f6b2e636f6d2e706e67, 1),
(9011016026, 26, 'NVMe 500GB', '4GB DDR4-3200 MHz', 2800000, 11, '2023-03-09 00:40:50', '2023-03-09 00:40:50', 0x636f6e6669672f696d672f70726f647563746f732f31342d6471323032316c612e637970657269406f75746c6f6f6b2e636f6d2e706e67, 1),
(9011016026, 27, 'NVMe 500GB', '8GB DDR4-3200MHz', 4099901, 9, '2023-03-09 00:41:45', '2023-03-09 00:45:08', 0x636f6e6669672f696d672f70726f647563746f732f496465615061642047616d696e67203369203674612e637970657269406f75746c6f6f6b2e636f6d2e706e67, 2),
(9011016026, 28, 'SSD 250GB', '8GB DDR4', 1449000, 5, '2023-03-09 00:42:37', '2023-03-09 00:45:27', 0x636f6e6669672f696d672f70726f647563746f732f4964656150616420332038315741303043334c4d2e637970657269406f75746c6f6f6b2e636f6d2e706e67, 2),
(9011016026, 29, 'NVMe 500GB', '8GB DDR4-3200MHz', 5699999, 15, '2023-03-09 00:43:34', '2023-03-09 00:45:17', 0x636f6e6669672f696d672f70726f647563746f732f474636352e637970657269406f75746c6f6f6b2e636f6d2e706e67, 2),
(9011016026, 30, 'SSD 250GB', '8 GB DRR4-3200MHz', 3499000, 0, '2023-03-09 00:44:34', '2023-03-09 00:44:34', 0x636f6e6669672f696d672f70726f647563746f732f4d53492d5468696e2d474636332e637970657269406f75746c6f6f6b2e636f6d2e706e67, 1),
(9100710098, 1, 'SSD 500GB', '8GB DDR4', 2673000, 0, '2023-03-17 16:31:47', '2023-03-17 16:33:59', 0x636f6e6669672f696d672f70726f647563746f732f74726176656c6d6174652d70325f746d703231352d35325f66702d626c315f3031612d312e74656368746f6d40676d61696c2e636f6d2e706e67, 0),
(9463154887, 1, 'SSD 250GB', '8GB DDR4', 3000000, 50, '2023-03-09 00:06:22', '2023-03-21 19:56:50', 0x636f6e6669672f696d672f70726f647563746f732f74726176656c6d6174652d70325f746d703231352d35325f66702d626c315f3031612d312e76616d7069784076616d7069782e636f6d2e706e67, 2),
(9463154887, 2, 'NVMe 1TB', '16GB DDR4', 6790000, 5, '2023-03-09 00:07:07', '2023-03-09 00:15:30', 0x636f6e6669672f696d672f70726f647563746f732f68656c696f732d3330302d70682d3331352d35342d373438792e76616d7069784076616d7069782e636f6d2e706e67, 2),
(9463154887, 3, 'SSD 120GB', '4GB DDR4', 1899000, 0, '2023-03-09 00:08:04', '2023-03-09 00:08:04', 0x636f6e6669672f696d672f70726f647563746f732f583431354a412e76616d7069784076616d7069782e636f6d2e706e67, 1),
(9463154887, 4, 'NVMe 500GB', '8GB DDR4', 3010740, 0, '2023-03-09 00:08:45', '2023-03-09 00:08:45', 0x636f6e6669672f696d672f70726f647563746f732f617375732d6d35313369612d626e3733382e76616d7069784076616d7069782e636f6d2e706e67, 1),
(9463154887, 5, 'NVMe 1TB', '16GB DDR4', 15999000, 15, '2023-03-09 00:09:56', '2023-03-09 00:15:36', 0x636f6e6669672f696d672f70726f647563746f732f524f472d7a657068797275732d64756f2e76616d7069784076616d7069782e636f6d2e706e67, 2),
(9463154887, 6, 'NVMe 250GB', 'NVMe 250GB', 4872026, 7, '2023-03-09 00:10:48', '2023-03-09 00:16:39', 0x636f6e6669672f696d672f70726f647563746f732f4c6174697475646520313520333532302e76616d7069784076616d7069782e636f6d2e706e67, 2),
(9463154887, 7, 'SSD 250GB', '6GB DDR4', 1730000, 0, '2023-03-09 00:11:29', '2023-03-09 00:11:29', 0x636f6e6669672f696d672f70726f647563746f732f496e737069726f6e2031352e76616d7069784076616d7069782e636f6d2e706e67, 1),
(9463154887, 8, 'HDD 500GB', '8GB DDR4', 1220000, 4, '2023-03-09 00:12:32', '2023-03-09 00:16:48', 0x636f6e6669672f696d672f70726f647563746f732f3234302047372031312d3230303178782e76616d7069784076616d7069782e636f6d2e706e67, 1),
(9463154887, 9, 'NVMe 250GB', '4 GBDDR4-3200 MHz', 1599900, 0, '2023-03-09 00:13:30', '2023-03-09 00:13:30', 0x636f6e6669672f696d672f70726f647563746f732f31342d6366323530366c612e76616d7069784076616d7069782e636f6d2e706e67, 1),
(9463154887, 10, 'NVMe 2TB', '32GB DDR5', 30672000, 42, '2023-03-09 00:15:13', '2023-03-09 00:16:19', 0x636f6e6669672f696d672f70726f647563746f732f546974616e2047543737485820313356492d30303645532e76616d7069784076616d7069782e636f6d2e706e67, 2),
(9463154887, 11, 'NVMe 500GB', '16GB DDR4', 5499000, 0, '2023-03-10 13:59:47', '2023-03-10 14:09:59', 0x636f6e6669672f696d672f70726f647563746f732f4e6974726f2d352d414e3531372d35342d37325a332e76616d7069784076616d7069782e636f6d2e706e67, 1),
(9463154887, 39, 'NVMe 1TB', '8GB DDR4-3200MHz', 11435409, 0, '2023-03-10 15:30:25', '2023-03-10 15:30:25', 0x636f6e6669672f696d672f70726f647563746f732f474636352e76616d7069784076616d7069782e636f6d2e706e67, 1),
(9885365489, 11, 'NVMe 500GB', '16GB DDR4', 5416619, 0, '2023-03-09 00:18:28', '2023-03-21 19:42:57', 0x636f6e6669672f696d672f70726f647563746f732f4e6974726f2d352d414e3531372d35342d37325a332e6472616b6f74656368406472616b2e636f6d2e706e67, 1),
(9885365489, 12, 'NVMe 500GB', '8GB DDR4-3000MHz', 4799000, 16, '2023-03-09 00:19:16', '2023-03-09 00:27:08', 0x636f6e6669672f696d672f70726f647563746f732f5455462d67616d696e672d6631352e6472616b6f74656368406472616b2e636f6d2e706e67, 2),
(9885365489, 13, 'NVMe 500GB', '16GB DDR4', 5499000, 0, '2023-03-09 00:20:08', '2023-03-09 00:20:08', 0x636f6e6669672f696d672f70726f647563746f732f5455462d646173682d6631352e6472616b6f74656368406472616b2e636f6d2e706e67, 1),
(9885365489, 14, 'NVMe 250GB', '8GB DDR5- 4800MHz', 13042018, 14, '2023-03-09 00:21:07', '2023-03-09 00:27:19', 0x636f6e6669672f696d672f70726f647563746f732f507265636973696f6e20353737302e6472616b6f74656368406472616b2e636f6d2e706e67, 2),
(9885365489, 15, 'NVMe 250GB', '8GB DDR4-2400 MHz', 1699000, 0, '2023-03-09 00:22:13', '2023-03-09 00:22:13', 0x636f6e6669672f696d672f70726f647563746f732f31342d6366323531326c61202e6472616b6f74656368406472616b2e636f6d2e706e67, 1),
(9885365489, 16, 'NVMe 500GB', '8GB DDR5-4800MHz', 8199900, 30, '2023-03-09 00:23:02', '2023-03-09 00:27:31', 0x636f6e6669672f696d672f70726f647563746f732f4c6567696f6e20356920376d612047656e2e6472616b6f74656368406472616b2e636f6d2e706e67, 2),
(9885365489, 17, 'HDD 1TB', '4GB DDR4', 1749000, 0, '2023-03-09 00:24:18', '2023-03-09 00:24:18', 0x636f6e6669672f696d672f70726f647563746f732f49646561506164203320496e74656c2043656c65726f6e2e6472616b6f74656368406472616b2e636f6d2e706e67, 1),
(9885365489, 18, 'NVMe 500GB', '16GB DDR4', 6875000, 0, '2023-03-09 00:25:10', '2023-03-09 00:25:10', 0x636f6e6669672f696d672f70726f647563746f732f427261766f2031372e6472616b6f74656368406472616b2e636f6d2e706e67, 1),
(9885365489, 19, 'SSD 1TB', '16GB DDR4', 6999999, 0, '2023-03-09 00:25:58', '2023-03-09 00:25:58', 0x636f6e6669672f696d672f70726f647563746f732f474637362e6472616b6f74656368406472616b2e636f6d2e706e67, 1),
(9885365489, 20, '1 TB SSD        ', '16 GB DDR4-3000MHz', 6146880, 50, '2023-03-09 00:26:47', '2023-03-09 00:27:42', 0x636f6e6669672f696d672f70726f647563746f732f416365722d73776966742d332e6472616b6f74656368406472616b2e636f6d2e706e67, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `tipo`) VALUES
(1, 'Gamer'),
(2, 'Ofimátítica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `t_doc` varchar(10) NOT NULL,
  `nombre_t_doc` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`t_doc`, `nombre_t_doc`) VALUES
('C.C.', 'Cédula de Ciudadanía'),
('C.E.', 'Cédula de Extranjería'),
('T.I.', 'Tarjeta de Identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(8) NOT NULL,
  `email_cliente` varchar(45) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `email_cliente`, `fecha`) VALUES
(219001, 'bodoquejuan@outlook.com', '2023-03-09 23:45:22'),
(219002, 'bodoquejuan@outlook.com', '2023-03-09 23:49:03'),
(219003, 'branmichellmv@gmail.com', '2023-03-10 15:21:41'),
(219004, 'bodoquejuan@outlook.com', '2023-03-12 21:41:48'),
(219005, 'bodoquejuan@outlook.com', '2023-03-12 21:42:55'),
(219006, 'bodoquejuan@outlook.com', '2023-03-17 16:51:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_productos`
--

CREATE TABLE `ventas_productos` (
  `id_venta` int(8) NOT NULL,
  `nit_tienda` bigint(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_productos`
--

INSERT INTO `ventas_productos` (`id_venta`, `nit_tienda`, `id_producto`, `cantidad`) VALUES
(219001, 9463154887, 1, 1),
(219001, 9463154887, 2, 2),
(219001, 9463154887, 3, 1),
(219002, 9009554091, 31, 1),
(219002, 9011016026, 23, 1),
(219002, 9463154887, 1, 1),
(219002, 9885365489, 20, 1),
(219003, 9463154887, 2, 2),
(219004, 9009554091, 33, 1),
(219004, 9885365489, 20, 1),
(219005, 9011016026, 23, 2),
(219006, 9011016026, 23, 2),
(219006, 9463154887, 1, 1),
(219006, 9463154887, 2, 1),
(219006, 9463154887, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votaciones`
--

CREATE TABLE `votaciones` (
  `id_producto` int(11) NOT NULL,
  `nit_tienda` bigint(11) NOT NULL,
  `cantidad_votantes` bigint(10) NOT NULL DEFAULT 0,
  `puntuacion_total` bigint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `votaciones`
--

INSERT INTO `votaciones` (`id_producto`, `nit_tienda`, `cantidad_votantes`, `puntuacion_total`) VALUES
(1, 9463154887, 61, 223),
(2, 9463154887, 80, 325),
(3, 9463154887, 136, 596),
(4, 9463154887, 184, 724),
(5, 9463154887, 73, 291),
(6, 9463154887, 167, 689),
(7, 9463154887, 110, 476),
(8, 9463154887, 201, 826),
(9, 9463154887, 144, 565),
(10, 9463154887, 88, 366),
(11, 9885365489, 110, 446),
(12, 9885365489, 175, 701),
(13, 9885365489, 251, 851),
(14, 9885365489, 87, 307),
(15, 9885365489, 120, 336),
(16, 9885365489, 275, 875),
(17, 9885365489, 260, 860),
(18, 9885365489, 279, 897),
(19, 9885365489, 196, 946),
(20, 9885365489, 250, 850),
(21, 9011016026, 169, 620),
(22, 9011016026, 186, 920),
(23, 9011016026, 155, 728),
(24, 9011016026, 180, 891),
(25, 9011016026, 174, 870),
(26, 9011016026, 144, 511),
(27, 9011016026, 134, 528),
(28, 9011016026, 100, 418),
(29, 9011016026, 103, 390),
(30, 9011016026, 77, 360),
(31, 9009554091, 100, 510),
(32, 9009554091, 213, 815),
(33, 9009554091, 301, 913),
(34, 9009554091, 86, 421),
(35, 9009554091, 270, 862),
(36, 9009554091, 45, 240),
(37, 9009554091, 150, 590),
(38, 9009554091, 80, 332),
(39, 9009554091, 112, 561),
(40, 9009554091, 90, 375),
(11, 9463154887, 70, 340),
(39, 9463154887, 99, 489),
(1, 9100710098, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`email_administrador`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`email_cliente`);

--
-- Indices de la tabla `carrito_productos`
--
ALTER TABLE `carrito_productos`
  ADD KEY `carrito_productos_ibfk_1` (`email_cliente`),
  ADD KEY `carrito_productos_ibfk_2` (`id_producto`),
  ADD KEY `carrito_productos_ibfk_3` (`nit_tienda`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`email_cliente`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`email_persona`),
  ADD UNIQUE KEY `contrasena_persona` (`contrasena_persona`),
  ADD KEY `tipo_documento_persona` (`tipo_documento_persona`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `nombre_producto` (`nombre_producto`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`nit_tienda`),
  ADD UNIQUE KEY `email_tienda` (`email_tienda`),
  ADD UNIQUE KEY `contrasena_tienda` (`contrasena_tienda`);

--
-- Indices de la tabla `tiendas_productos`
--
ALTER TABLE `tiendas_productos`
  ADD PRIMARY KEY (`nit_tienda`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`),
  ADD UNIQUE KEY `tipo` (`tipo`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`t_doc`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `email_cliente` (`email_cliente`);

--
-- Indices de la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  ADD PRIMARY KEY (`id_venta`,`nit_tienda`,`id_producto`),
  ADD KEY `nit_tienda` (`nit_tienda`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `votaciones`
--
ALTER TABLE `votaciones`
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `nit_tienda` (`nit_tienda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`email_administrador`) REFERENCES `persona` (`email_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `clientes` (`email_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito_productos`
--
ALTER TABLE `carrito_productos`
  ADD CONSTRAINT `carrito_productos_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `carrito` (`email_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_productos_ibfk_2` FOREIGN KEY (`nit_tienda`) REFERENCES `tiendas_productos` (`nit_tienda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `persona` (`email_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`tipo_documento_persona`) REFERENCES `tipo_documento` (`t_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `clientes` (`email_cliente`);

--
-- Filtros para la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  ADD CONSTRAINT `ventas_productos_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `ventas_productos_ibfk_2` FOREIGN KEY (`nit_tienda`) REFERENCES `tiendas_productos` (`nit_tienda`),
  ADD CONSTRAINT `ventas_productos_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `tiendas_productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
