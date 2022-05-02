-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-05-2022 a las 19:21:05
-- Versión del servidor: 10.2.43-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: orhanoik_SIVIG
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla ajustes_de_inventario
--

CREATE TABLE ajustes_de_inventario (
  id int(11) NOT NULL,
  tipo_movimiento int(11) NOT NULL,
  monto_neto int(11) NOT NULL,
  monto_imp int(11) NOT NULL,
  observaciones text NOT NULL,
  fecha date NOT NULL,
  usuario int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla ajustes_de_inventario
--

INSERT INTO ajustes_de_inventario (id, tipo_movimiento, monto_neto, monto_imp, observaciones, fecha, usuario) VALUES
(1, 4, 600, 116, 'ajuste de inventario', '2021-11-23', 1),
(2, 4, -600, -116, 'ingreso manual', '2021-11-23', 1),
(3, 4, -600, -116, 'ajuste de inventario', '2021-11-23', 1),
(4, 4, 140600, 26715, 'ajuste de inventario al 12 de marzo', '2022-03-12', 1),
(5, 4, 3361, 639, 'regalo', '2022-05-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla articulos
--

CREATE TABLE articulos (
  id int(11) NOT NULL,
  cod_interno varchar(60) NOT NULL,
  cod_barras varchar(60) NOT NULL,
  descripcion varchar(150) NOT NULL,
  costo_neto int(11) NOT NULL,
  costo_imp int(11) NOT NULL,
  venta_neto int(11) NOT NULL,
  venta_imp int(11) NOT NULL,
  stock int(11) NOT NULL,
  activo int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla articulos
--

INSERT INTO articulos (id, cod_interno, cod_barras, descripcion, costo_neto, costo_imp, venta_neto, venta_imp, stock, activo) VALUES
(1, 'test', 'test', 'articulo de pruebas', 150, 29, 1672, 318, 0, 1),
(2, 'hdmi3m', '03206', 'cable hdmi 3m', 1672, 318, 2513, 477, 3, 1),
(3, 'p-340', '6950854602377', 'audifonos manos libres con cable', 2521, 479, 5034, 956, 2, 1),
(4, 'hdmi5m', '4595654570625', 'cable hdmi 5m plano', 1672, 318, 4193, 797, 3, 1),
(5, 'linternazoom', 'linternazoom', 'linterna tactica con zoom con bateria recargable', 3361, 639, 4202, 798, 0, 1),
(6, 'bt-350', 'bt-350', 'receptor de audio bluetooth', 840, 160, 2521, 479, 4, 1),
(7, 'LG-40495', '6957438072083', 'cuaderno cat', 1261, 239, 2513, 477, 2, 1),
(8, 'LG-40516', '6957438072090', 'cuaderno cat grande', 1681, 319, 3353, 637, 1, 1),
(9, 'ec-cl7-blk', '6923450656372', 'set de 7 cuchillos negros', 4874, 926, 9235, 1755, 1, 1),
(10, 'STN-28', '6989532512530', 'audifonos cat', 5874, 1116, 12597, 2393, 0, 1),
(11, 'YE-02', '5555888802543', 'licuadora individual USB', 3193, 607, 7555, 1435, 0, 1),
(12, '82143', '2020123821434', 'dispensador de papel para cocina', 3361, 639, 7555, 1435, 1, 1),
(13, 'CAMIP1', 'CAMIP1', 'camara ip 5 antenas', 13025, 2475, 18478, 3511, 0, 1),
(14, '1604628', '+C11604628', 'camara ip 3 antenas', 12185, 2315, 16807, 3193, 0, 1),
(15, '2701054', '+C12701054', 'foco solar con soporte', 3193, 607, 6714, 1276, 0, 1),
(16, '1618110', '1618110', 'tira led 5 metros  RGB', 2689, 511, 5874, 1116, 3, 1),
(17, 'pesabaño', 'pesabaño', 'pesa de vidrio digital', 3353, 637, 8395, 1595, 0, 1),
(18, 'RS-334', 'RS-334', 'Manguera retractil 15 mt', 2941, 559, 5874, 1116, 0, 1),
(19, 'Focosolar', 'Focosolar', 'Foco solar con sensor de movimiento ', 2101, 399, 4193, 797, 0, 1),
(20, 'RS-434', 'RS-434', 'Olla calentadora cera ', 3782, 718, 8403, 1597, 5, 1),
(21, 'JS-747', '8687807885157', 'Dispensador 4 en 1', 5034, 956, 8395, 1595, 2, 1),
(22, '8018', '8018', 'Organizador microonda', 3361, 639, 6723, 1277, 1, 1),
(23, 'i12', 'i12', 'Audifono bluetooth', 2773, 527, 6714, 1276, 0, 1),
(24, 'Lamp01', 'Lamp 01', 'Lampara de sal usb', 4193, 797, 8395, 1595, 0, 1),
(25, 'TS-19', '+C11604637', 'Parlante  buetoth', 4193, 797, 8395, 1595, 0, 1),
(26, 'BASURERO', '6977009124003', 'Basurero magico ', 840, 160, 1681, 319, 2, 1),
(27, 'PATASLARGAS', 'PATASLARGAS', 'Muñecos navideños patas largas ', 3353, 637, 6714, 1276, 0, 1),
(28, 'NL-2423', '6907662694230', 'Pie de arbol', 700, 133, 1681, 319, 2, 1),
(29, 'limpiadorfacial', '2020123402190', 'limpiador facial USB', 1261, 239, 2513, 477, 3, 1),
(30, 'JD-2178-T', '7858816081828', 'luz solar con control remoto, simula camara', 5042, 958, 10084, 1916, 3, 1),
(31, 'soportebicicleta', 'soportebicicleta', 'soporte bicicleta', 1672, 318, 4193, 797, 6, 1),
(32, 'camelia-blanco-m', 'camelia-blanco-m', 'delantal camelia blanco M', 10084, 1916, 20990, 3988, 1, 1),
(33, 'camelia-blanco-s', 'camelia-blanco-s', 'delantal camelia blanco S', 10084, 1916, 17639, 3351, 1, 1),
(34, 'yris-blanco-xl', 'yris-blanco-xl', 'delantal yris blanco XL', 10924, 2076, 19319, 3671, 1, 1),
(35, 'yris-blanco-l', 'yris-blanco-l', 'delantal yris blanco L', 10084, 1916, 17639, 3351, 1, 1),
(36, 'yris-gris-s', 'yris-gris-s', 'delantal Yris gris S', 10084, 1916, 17639, 3351, 1, 1),
(37, 'yris-gris-m', 'yris-gris-m', 'delantal Yris gris M', 10084, 1916, 17639, 3351, 1, 1),
(38, 'camelia-gris-l', 'camelia-gris-l', 'delantal camelia gris L', 10084, 1916, 17639, 3351, 1, 1),
(39, 'camelia-gris-xl', 'camelia-gris-xl', 'delantal camelia gris XL', 10924, 2076, 19319, 3671, 1, 1),
(40, 'camelia-gris-xxl', 'camelia-gris-xxl', 'delantal camelia gris XXL', 10924, 2076, 19319, 3671, 1, 1),
(41, 'frida-azul-electrico-m', '152DFEEM', 'delantal Frida azul electrico M', 10084, 1916, 17563, 3337, 1, 1),
(42, 'jardin-azul-acero-l', '162DJACACL', 'delantal Jardin azul acero L', 10084, 1916, 17639, 3351, 1, 1),
(43, 'love-azul-acero-l', '117ACL', 'delantal Love azul acero L', 10084, 1916, 17639, 3351, 1, 1),
(44, 'rumy-azul-acero-m', '1299ACM', 'delantal Rumy azul acero M', 10084, 1916, 17639, 3351, 1, 1),
(45, 'jardin-burdeo-xl', 'jardin-burdeo-xl', 'delantal Jardin burdeo XL', 10924, 2076, 19319, 3671, 1, 1),
(46, 'llamita-burdeo-l', '79BUL', 'delantal Llamita burdeo L', 10084, 1916, 17639, 3351, 1, 1),
(47, 'natura-burdeo-s', '52BUS', 'delantal Natura burdeo S', 10084, 1916, 17639, 3351, 2, 1),
(48, 'love-burdeo-m', '110BUM', 'delantal Love burdeo M', 10084, 1916, 17639, 3351, 1, 1),
(49, 'natura-verde-s', '150DNAVS', 'delantal Natura verde S', 10084, 1916, 17639, 3351, 1, 1),
(50, 'jardin-verde-s', '157DJVVS', 'delantal Jardin verde S', 10084, 1916, 17639, 3351, 1, 1),
(51, 'hadita-verde-xl', '127DHAVXL', 'delantal Hadita verde XL', 10924, 2076, 19319, 3671, 1, 1),
(52, 'alicia-verde-m', '165DAVVM', 'delantal Alicia verde m', 10084, 1916, 17639, 3351, 1, 1),
(53, 'hadita-verde-m', '127DHAVM', 'delantal Hadita verde M', 10084, 1916, 17639, 3351, 1, 1),
(54, 'llamita-verde-m', '136DLLAVM', 'delantal Llamita verde M', 10084, 1916, 17639, 3351, 1, 1),
(55, 'hadita-verde-l', '127DHAVL', 'delantal Hadita verde L', 10084, 1916, 17639, 3351, 1, 1),
(56, 'jardin-verde-m', '157DJVVM', 'delantal Jardin verde M', 10084, 1916, 17639, 3351, 1, 1),
(57, 'love-verde-l', '120 DLVL', 'delantal Love verde L', 10084, 1916, 17639, 3351, 1, 1),
(58, 'jardin-verde-l', '157DJVVL', 'delantal Jardin verde L', 10084, 1916, 17639, 3351, 1, 1),
(59, 'llamita-verde-xl', '136DLLAVXL', 'delantal Llamita verde XL', 10924, 2076, 19319, 3671, 1, 1),
(60, 'alicia-verde-l', '165DAVVL', 'delantal Alicia verde L', 10084, 1916, 17639, 3351, 1, 1),
(61, 'hadita-azul-marino-s', '127DHAAS', 'delantal Hadita azul acero S', 10084, 1916, 17639, 3351, 1, 1),
(62, 'llamita-azul-marino-l', '136DLLAAL', 'delantal Llamita azul marino L', 10084, 1916, 17639, 3351, 1, 1),
(63, 'hadita-azul-marino-l', '127DHAAL', 'delantal Hadita azul marino L ', 10084, 1916, 17639, 3351, 1, 1),
(64, 'jardin-manga-larga-azul-marino-l', '1097AML', 'delantal Jardin manga larga azul marino L', 10084, 1916, 17639, 3351, 2, 1),
(65, 'natura-azul-marino-m', '35AMM', 'delantal Natura azul marino M', 10084, 1916, 17639, 3351, 2, 1),
(66, 'fantasia-azul-marino-l', '280ATL', 'delantal Fantasia azul marino L', 10084, 1916, 17639, 3351, 1, 1),
(67, 'pintorcito-azul-marino-l', '293AML', 'delantal Pintorcito azul marino L', 10084, 1916, 17639, 3351, 1, 1),
(68, 'rumy-azul-marino-xl', '236AMXL', 'delantal Rumy azul marino XL', 10924, 2076, 19319, 3671, 1, 1),
(69, 'love-azul-marino-s', '91AMS', 'delantal Love azul marino S', 10084, 1916, 17639, 3351, 1, 1),
(70, 'gatito-lunar-azul-marino-m', '123AMM', 'delantal Gatito Lunar azul marino M', 10084, 1916, 17639, 3351, 1, 1),
(71, 'farfy-azul-marino-s', '244AMS', 'delantal Farfy azul marino S', 10084, 1916, 17639, 3351, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla clientes
--

CREATE TABLE clientes (
  rut varchar(11) NOT NULL,
  nombre varchar(120) NOT NULL,
  giro varchar(90) NOT NULL,
  direccion varchar(120) NOT NULL,
  comuna int(11) NOT NULL,
  region int(11) NOT NULL,
  telefono int(9) NOT NULL,
  mail varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla clientes
--

INSERT INTO clientes (rut, nombre, giro, direccion, comuna, region, telefono, mail) VALUES
('111111-1', 'Cliente Generico', 'Particular', 'N/A', 204, 10, 0, 'contacto@llamativo.cl');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla comunas
--

CREATE TABLE comunas (
  id int(11) NOT NULL,
  comuna varchar(64) NOT NULL,
  region_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla comunas
--

INSERT INTO comunas (id, comuna, region_id) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 1),
(4, 'Putre', 1),
(5, 'Alto Hospicio', 2),
(6, 'Iquique', 2),
(7, 'Cami?a', 2),
(8, 'Colchane', 2),
(9, 'Huara', 2),
(10, 'Pica', 2),
(11, 'Pozo Almonte', 2),
(12, 'Tocopilla', 3),
(13, 'Maria Elena', 3),
(14, 'Calama', 3),
(15, 'Ollague', 3),
(16, 'San Pedro de Atacama', 3),
(17, 'Antofagasta', 3),
(18, 'Mejillones', 3),
(19, 'Sierra Gorda', 3),
(20, 'Taltal', 3),
(21, 'Cha?aral', 4),
(22, 'Diego de Almagro', 4),
(23, 'Copiapo', 4),
(24, 'Caldera', 4),
(25, 'Tierra Amarilla', 4),
(26, 'Vallenar', 4),
(27, 'Alto del Carmen', 4),
(28, 'Freirina', 4),
(29, 'Huasco', 4),
(30, 'La Serena', 5),
(31, 'Coquimbo', 5),
(32, 'Andacollo', 5),
(33, 'La Higuera', 5),
(34, 'Paihuano', 5),
(35, 'Vicu?a', 5),
(36, 'Ovalle', 5),
(37, 'Combarbala', 5),
(38, 'Monte Patria', 5),
(39, 'Punitaqui', 5),
(40, 'Rio Hurtado', 5),
(41, 'Illapel', 5),
(42, 'Canela', 5),
(43, 'Los Vilos', 5),
(44, 'Salamanca', 5),
(45, 'La Ligua', 6),
(46, 'Cabildo', 6),
(47, 'Zapallar', 6),
(48, 'Papudo', 6),
(49, 'Petorca', 6),
(50, 'Los Andes', 6),
(51, 'San Esteban', 6),
(52, 'Calle Larga', 6),
(53, 'Rinconada', 6),
(54, 'San Felipe', 6),
(55, 'Llaillay', 6),
(56, 'Putaendo', 6),
(57, 'Santa Maria', 6),
(58, 'Catemu', 6),
(59, 'Panquehue', 6),
(60, 'Quillota', 6),
(61, 'La Cruz', 6),
(62, 'La Calera', 6),
(63, 'Nogales', 6),
(64, 'Hijuelas', 6),
(65, 'Valparaiso', 6),
(66, 'Vi?a del Mar', 6),
(67, 'Concon', 6),
(68, 'Quintero', 6),
(69, 'Puchuncavi', 6),
(70, 'Casablanca', 6),
(71, 'Juan Fernandez', 6),
(72, 'San Antonio', 6),
(73, 'Cartagena', 6),
(74, 'El Tabo', 6),
(75, 'El Quisco', 6),
(76, 'Algarrobo', 6),
(77, 'Santo Domingo', 6),
(78, 'Isla de Pascua', 6),
(79, 'Quilpue', 6),
(80, 'Limache', 6),
(81, 'Olmue', 6),
(82, 'Villa Alemana', 6),
(83, 'Colina', 7),
(84, 'Lampa', 7),
(85, 'Tiltil', 7),
(86, 'Santiago', 7),
(87, 'Vitacura', 7),
(88, 'San Ramon', 7),
(89, 'San Miguel', 7),
(90, 'San Joaquin', 7),
(91, 'Renca', 7),
(92, 'Recoleta', 7),
(93, 'Quinta Normal', 7),
(94, 'Quilicura', 7),
(95, 'Pudahuel', 7),
(96, 'Providencia', 7),
(97, 'Pe?alolen', 7),
(98, 'Pedro Aguirre Cerda', 7),
(99, '?u?oa', 7),
(100, 'Maipu', 7),
(101, 'Macul', 7),
(102, 'Lo Prado', 7),
(103, 'Lo Espejo', 7),
(104, 'Lo Barnechea', 7),
(105, 'Las Condes', 7),
(106, 'La Reina', 7),
(107, 'La Pintana', 7),
(108, 'La Granja', 7),
(109, 'La Florida', 7),
(110, 'La Cisterna', 7),
(111, 'Independencia', 7),
(112, 'Huechuraba', 7),
(113, 'Estacion Central', 7),
(114, 'El Bosque', 7),
(115, 'Conchali', 7),
(116, 'Cerro Navia', 7),
(117, 'Cerrillos', 7),
(118, 'Puente Alto', 7),
(119, 'San Jose de Maipo', 7),
(120, 'Pirque', 7),
(121, 'San Bernardo', 7),
(122, 'Buin', 7),
(123, 'Paine', 7),
(124, 'Calera de Tango', 7),
(125, 'Melipilla', 7),
(126, 'Alhue', 7),
(127, 'Curacavi', 7),
(128, 'Maria Pinto', 7),
(129, 'San Pedro', 7),
(130, 'Isla de Maipo', 7),
(131, 'El Monte', 7),
(132, 'Padre Hurtado', 7),
(133, 'Pe?aflor', 7),
(134, 'Talagante', 7),
(135, 'Codegua', 8),
(136, 'Coinco', 8),
(137, 'Coltauco', 8),
(138, 'Do?ihue', 8),
(139, 'Graneros', 8),
(140, 'Las Cabras', 8),
(141, 'Machali', 8),
(142, 'Malloa', 8),
(143, 'Mostazal', 8),
(144, 'Olivar', 8),
(145, 'Peumo', 8),
(146, 'Pichidegua', 8),
(147, 'Quinta de Tilcoco', 8),
(148, 'Rancagua', 8),
(149, 'Rengo', 8),
(150, 'Requinoa', 8),
(151, 'San Vicente de Tagua Tagua', 8),
(152, 'Chepica', 8),
(153, 'Chimbarongo', 8),
(154, 'Lolol', 8),
(155, 'Nancagua', 8),
(156, 'Palmilla', 8),
(157, 'Peralillo', 8),
(158, 'Placilla', 8),
(159, 'Pumanque', 8),
(160, 'San Fernando', 8),
(161, 'Santa Cruz', 8),
(162, 'La Estrella', 8),
(163, 'Litueche', 8),
(164, 'Marchigue', 8),
(165, 'Navidad', 8),
(166, 'Paredones', 8),
(167, 'Pichilemu', 8),
(168, 'Curico', 9),
(169, 'Huala?e', 9),
(170, 'Licanten', 9),
(171, 'Molina', 9),
(172, 'Rauco', 9),
(173, 'Romeral', 9),
(174, 'Sagrada Familia', 9),
(175, 'Teno', 9),
(176, 'Vichuquen', 9),
(177, 'Talca', 9),
(178, 'San Clemente', 9),
(179, 'Pelarco', 9),
(180, 'Pencahue', 9),
(181, 'Maule', 9),
(182, 'San Rafael', 9),
(183, 'Curepto', 9),
(184, 'Constitucion', 9),
(185, 'Empedrado', 9),
(186, 'Rio Claro', 9),
(187, 'Linares', 9),
(188, 'San Javier', 9),
(189, 'Parral', 9),
(190, 'Villa Alegre', 9),
(191, 'Longavi', 9),
(192, 'Colbun', 9),
(193, 'Retiro', 9),
(194, 'Yerbas Buenas', 9),
(195, 'Cauquenes', 9),
(196, 'Chanco', 9),
(197, 'Pelluhue', 9),
(198, 'Bulnes', 10),
(199, 'Chillan', 10),
(200, 'Chillan Viejo', 10),
(201, 'El Carmen', 10),
(202, 'Pemuco', 10),
(203, 'Pinto', 10),
(204, 'Quillon', 10),
(205, 'San Ignacio', 10),
(206, 'Yungay', 10),
(207, 'Cobquecura', 10),
(208, 'Coelemu', 10),
(209, 'Ninhue', 10),
(210, 'Portezuelo', 10),
(211, 'Quirihue', 10),
(212, 'Ranquil', 10),
(213, 'Treguaco', 10),
(214, 'San Carlos', 10),
(215, 'Coihueco', 10),
(216, 'San Nicolas', 10),
(217, '?iquen', 10),
(218, 'San Fabian', 10),
(219, 'Alto Biobio', 11),
(220, 'Antuco', 11),
(221, 'Cabrero', 11),
(222, 'Laja', 11),
(223, 'Los Angeles', 11),
(224, 'Mulchen', 11),
(225, 'Nacimiento', 11),
(226, 'Negrete', 11),
(227, 'Quilaco', 11),
(228, 'Quilleco', 11),
(229, 'San Rosendo', 11),
(230, 'Santa Barbara', 11),
(231, 'Tucapel', 11),
(232, 'Yumbel', 11),
(233, 'Concepcion', 11),
(234, 'Coronel', 11),
(235, 'Chiguayante', 11),
(236, 'Florida', 11),
(237, 'Hualpen', 11),
(238, 'Hualqui', 11),
(239, 'Lota', 11),
(240, 'Penco', 11),
(241, 'San Pedro de La Paz', 11),
(242, 'Santa Juana', 11),
(243, 'Talcahuano', 11),
(244, 'Tome', 11),
(245, 'Arauco', 11),
(246, 'Ca?ete', 11),
(247, 'Contulmo', 11),
(248, 'Curanilahue', 11),
(249, 'Lebu', 11),
(250, 'Los Alamos', 11),
(251, 'Tirua', 11),
(252, 'Angol', 12),
(253, 'Collipulli', 12),
(254, 'Curacautin', 12),
(255, 'Ercilla', 12),
(256, 'Lonquimay', 12),
(257, 'Los Sauces', 12),
(258, 'Lumaco', 12),
(259, 'Puren', 12),
(260, 'Renaico', 12),
(261, 'Traiguen', 12),
(262, 'Victoria', 12),
(263, 'Temuco', 12),
(264, 'Carahue', 12),
(265, 'Cholchol', 12),
(266, 'Cunco', 12),
(267, 'Curarrehue', 12),
(268, 'Freire', 12),
(269, 'Galvarino', 12),
(270, 'Gorbea', 12),
(271, 'Lautaro', 12),
(272, 'Loncoche', 12),
(273, 'Melipeuco', 12),
(274, 'Nueva Imperial', 12),
(275, 'Padre Las Casas', 12),
(276, 'Perquenco', 12),
(277, 'Pitrufquen', 12),
(278, 'Pucon', 12),
(279, 'Saavedra', 12),
(280, 'Teodoro Schmidt', 12),
(281, 'Tolten', 12),
(282, 'Vilcun', 12),
(283, 'Villarrica', 12),
(284, 'Valdivia', 13),
(285, 'Corral', 13),
(286, 'Lanco', 13),
(287, 'Los Lagos', 13),
(288, 'Mafil', 13),
(289, 'Mariquina', 13),
(290, 'Paillaco', 13),
(291, 'Panguipulli', 13),
(292, 'La Union', 13),
(293, 'Futrono', 13),
(294, 'Lago Ranco', 13),
(295, 'Rio Bueno', 13),
(297, 'Osorno', 14),
(298, 'Puerto Octay', 14),
(299, 'Purranque', 14),
(300, 'Puyehue', 14),
(301, 'Rio Negro', 14),
(302, 'San Juan de la Costa', 14),
(303, 'San Pablo', 14),
(304, 'Calbuco', 14),
(305, 'Cochamo', 14),
(306, 'Fresia', 14),
(307, 'Frutillar', 14),
(308, 'Llanquihue', 14),
(309, 'Los Muermos', 14),
(310, 'Maullin', 14),
(311, 'Puerto Montt', 14),
(312, 'Puerto Varas', 14),
(313, 'Ancud', 14),
(314, 'Castro', 14),
(315, 'Chonchi', 14),
(316, 'Curaco de Velez', 14),
(317, 'Dalcahue', 14),
(318, 'Puqueldon', 14),
(319, 'Queilen', 14),
(320, 'Quellon', 14),
(321, 'Quemchi', 14),
(322, 'Quinchao', 14),
(323, 'Chaiten', 14),
(324, 'Futaleufu', 14),
(325, 'Hualaihue', 14),
(326, 'Palena', 14),
(327, 'Lago Verde', 15),
(328, 'Coihaique', 15),
(329, 'Aysen', 15),
(330, 'Cisnes', 15),
(331, 'Guaitecas', 15),
(332, 'Rio Iba?ez', 15),
(333, 'Chile Chico', 15),
(334, 'Cochrane', 15),
(335, 'O\'Higgins', 15),
(336, 'Tortel', 15),
(337, 'Natales', 16),
(338, 'Torres del Paine', 16),
(339, 'Laguna Blanca', 16),
(340, 'Punta Arenas', 16),
(341, 'Rio Verde', 16),
(342, 'San Gregorio', 16),
(343, 'Porvenir', 16),
(344, 'Primavera', 16),
(345, 'Timaukel', 16),
(346, 'Cabo de Hornos', 16),
(347, 'Antartica', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla detalle_ajuste
--

CREATE TABLE detalle_ajuste (
  id int(11) NOT NULL,
  id_ajuste int(11) NOT NULL,
  articulo int(11) NOT NULL,
  monto_neto int(11) NOT NULL,
  monto_imp int(11) NOT NULL,
  cantidad int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla detalle_ajuste
--

INSERT INTO detalle_ajuste (id, id_ajuste, articulo, monto_neto, monto_imp, cantidad) VALUES
(1, 1, 1, 600, 116, 4),
(2, 2, 1, -600, -116, -4),
(3, 3, 1, -600, -116, -4),
(4, 4, 6, 840, 160, 1),
(5, 4, 9, 9748, 1852, 2),
(6, 4, 10, 5874, 1116, 1),
(7, 4, 11, 3193, 607, 1),
(8, 4, 13, 13025, 2475, 1),
(9, 4, 14, 24370, 4630, 2),
(10, 4, 15, 12772, 2428, 4),
(11, 4, 17, 3353, 637, 1),
(12, 4, 19, 8404, 1596, 4),
(13, 4, 20, 11346, 2154, 3),
(14, 4, 23, 33276, 6324, 12),
(15, 4, 25, 4193, 797, 1),
(16, 4, 27, 6706, 1274, 2),
(17, 4, 28, 3500, 665, 5),
(18, 5, 5, 3361, 639, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla detalle_recepciones
--

CREATE TABLE detalle_recepciones (
  id int(11) NOT NULL,
  recepcion int(11) NOT NULL,
  articulo int(11) NOT NULL,
  compra_neto int(11) NOT NULL,
  compra_imp int(11) NOT NULL,
  cantidad int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla detalle_recepciones
--

INSERT INTO detalle_recepciones (id, recepcion, articulo, compra_neto, compra_imp, cantidad) VALUES
(1, 2, 2, 1672, 318, 3),
(2, 2, 4, 1672, 318, 3),
(3, 2, 5, 3361, 639, 1),
(4, 2, 6, 840, 160, 5),
(5, 2, 3, 2521, 479, 2),
(6, 2, 7, 1261, 239, 2),
(7, 2, 8, 1681, 319, 1),
(8, 3, 9, 4874, 926, 3),
(9, 3, 10, 5874, 1116, 1),
(10, 3, 12, 3361, 639, 1),
(11, 3, 11, 3193, 607, 1),
(12, 3, 13, 13025, 2475, 2),
(13, 3, 14, 12185, 2315, 2),
(14, 3, 15, 3193, 607, 4),
(15, 3, 16, 2689, 511, 3),
(16, 3, 17, 3353, 637, 1),
(17, 4, 28, 700, 133, 12),
(18, 4, 26, 840, 160, 2),
(19, 4, 25, 4193, 797, 1),
(20, 4, 21, 5034, 956, 2),
(21, 4, 18, 2941, 559, 2),
(22, 4, 19, 2101, 399, 4),
(23, 4, 20, 3782, 718, 7),
(24, 4, 23, 2773, 527, 13),
(25, 4, 27, 3353, 637, 3),
(26, 4, 22, 3361, 639, 2),
(27, 4, 24, 4193, 797, 1),
(28, 5, 29, 1261, 239, 3),
(29, 5, 20, 3782, 718, 2),
(30, 5, 30, 5042, 958, 4),
(31, 5, 31, 1672, 318, 6),
(32, 6, 32, 10084, 1916, 1),
(33, 6, 33, 10084, 1916, 1),
(34, 6, 34, 10924, 2076, 1),
(35, 6, 35, 10084, 1916, 1),
(36, 6, 40, 10924, 2076, 1),
(37, 6, 39, 10924, 2076, 1),
(38, 6, 38, 10084, 1916, 1),
(39, 6, 37, 10084, 1916, 1),
(40, 6, 36, 10084, 1916, 1),
(41, 6, 41, 10084, 1916, 1),
(42, 6, 44, 10084, 1916, 1),
(43, 6, 43, 10084, 1916, 1),
(44, 6, 42, 10084, 1916, 1),
(45, 6, 48, 10084, 1916, 1),
(46, 6, 47, 10084, 1916, 2),
(47, 6, 46, 10084, 1916, 1),
(48, 6, 45, 10924, 2076, 1),
(49, 6, 60, 10084, 1916, 1),
(50, 6, 59, 10924, 2076, 1),
(51, 6, 58, 10084, 1916, 1),
(52, 6, 57, 10084, 1916, 1),
(53, 6, 56, 10084, 1916, 1),
(54, 6, 55, 10084, 1916, 1),
(55, 6, 54, 10084, 1916, 1),
(56, 6, 53, 10084, 1916, 1),
(57, 6, 52, 10084, 1916, 1),
(58, 6, 51, 10924, 2076, 1),
(59, 6, 50, 10084, 1916, 1),
(60, 6, 49, 10084, 1916, 1),
(61, 6, 68, 10924, 2076, 1),
(62, 6, 71, 10084, 1916, 1),
(63, 6, 70, 10084, 1916, 1),
(64, 6, 69, 10084, 1916, 1),
(65, 6, 67, 10084, 1916, 1),
(66, 6, 66, 10084, 1916, 1),
(67, 6, 65, 10084, 1916, 2),
(68, 6, 64, 10084, 1916, 2),
(69, 6, 63, 10084, 1916, 1),
(70, 6, 62, 10084, 1916, 1),
(71, 6, 61, 10084, 1916, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla detalle_ventas
--

CREATE TABLE detalle_ventas (
  id int(11) NOT NULL,
  id_venta int(11) NOT NULL,
  articulo int(11) NOT NULL,
  cantidad int(11) NOT NULL,
  precio_neto int(11) NOT NULL,
  precio_imp int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla detalle_ventas
--

INSERT INTO detalle_ventas (id, id_venta, articulo, cantidad, precio_neto, precio_imp) VALUES
(3, 3, 23, 1, 6714, 1276),
(4, 4, 22, 1, 7555, 1435),
(5, 5, 18, 1, 5874, 1116),
(6, 6, 18, 1, 5874, 1116),
(7, 7, 13, 1, 21008, 3992),
(8, 8, 30, 1, 10084, 1916),
(9, 9, 20, 1, 10084, 1916),
(10, 10, 28, 1, 1681, 319),
(11, 11, 27, 1, 6714, 1276),
(12, 11, 28, 1, 1681, 319),
(13, 12, 28, 1, 1681, 319),
(14, 13, 24, 1, 8395, 1595),
(15, 14, 28, 2, 1681, 319),
(16, 15, 70, 1, 17639, 3351);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla grupospaginas
--

CREATE TABLE grupospaginas (
  idgrupo int(11) NOT NULL,
  nombregrupo varchar(120) NOT NULL,
  imagengrupo varchar(120) NOT NULL,
  posicion int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla grupospaginas
--

INSERT INTO grupospaginas (idgrupo, nombregrupo, imagengrupo, posicion) VALUES
(1, 'Ventas', 'fas fa-file-invoice-dollar', 1),
(2, 'Articulos', 'fas fa-boxes', 2),
(3, 'Proveedores', 'fas fa-truck', 3),
(4, 'Clientes', 'fas fa-user-friends', 4),
(5, 'Reportes', 'fas fa-signal', 5),
(6, 'Configuración', 'fas fa-cogs', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla medios_de_pago
--

CREATE TABLE medios_de_pago (
  id int(11) NOT NULL,
  medio_de_pago varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla medios_de_pago
--

INSERT INTO medios_de_pago (id, medio_de_pago) VALUES
(1, 'Efectivo'),
(2, 'Debito'),
(3, 'Credito'),
(4, 'Transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla movimientos_articulos
--

CREATE TABLE movimientos_articulos (
  id int(11) NOT NULL,
  articulo int(11) NOT NULL,
  movimiento int(11) NOT NULL,
  unidades int(11) NOT NULL,
  fecha date NOT NULL,
  usuario int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla movimientos_articulos
--

INSERT INTO movimientos_articulos (id, articulo, movimiento, unidades, fecha, usuario) VALUES
(3, 2, 1, 3, '2021-11-06', 1),
(4, 4, 1, 3, '2021-11-06', 1),
(5, 5, 1, 1, '2021-11-06', 1),
(6, 6, 1, 5, '2021-11-06', 1),
(7, 3, 1, 2, '2021-11-06', 1),
(8, 7, 1, 2, '2021-11-06', 1),
(9, 8, 1, 1, '2021-11-06', 1),
(10, 9, 1, 3, '2021-11-06', 1),
(11, 10, 1, 1, '2021-11-06', 1),
(12, 12, 1, 1, '2021-11-06', 1),
(13, 11, 1, 1, '2021-11-06', 1),
(14, 13, 1, 2, '2021-11-06', 1),
(15, 14, 1, 2, '2021-11-06', 1),
(16, 15, 1, 4, '2021-11-06', 1),
(17, 16, 1, 3, '2021-11-06', 1),
(18, 17, 1, 1, '2021-11-06', 1),
(19, 28, 1, 12, '2021-11-07', 1),
(20, 26, 1, 2, '2021-11-07', 1),
(21, 25, 1, 1, '2021-11-07', 1),
(22, 21, 1, 2, '2021-11-07', 1),
(23, 18, 1, 2, '2021-11-07', 1),
(24, 19, 1, 4, '2021-11-07', 1),
(25, 20, 1, 7, '2021-11-07', 1),
(26, 23, 1, 13, '2021-11-07', 1),
(27, 27, 1, 3, '2021-11-07', 1),
(28, 22, 1, 2, '2021-11-07', 1),
(29, 24, 1, 1, '2021-11-07', 1),
(30, 23, 2, -1, '2021-11-13', 1),
(31, 22, 2, -1, '2021-11-13', 1),
(32, 18, 2, -1, '2021-11-15', 1),
(33, 29, 1, 3, '2021-11-17', 1),
(34, 20, 1, 2, '2021-11-17', 1),
(35, 30, 1, 4, '2021-11-17', 1),
(36, 31, 1, 6, '2021-11-17', 1),
(37, 18, 2, -1, '2021-11-18', 1),
(38, 13, 2, -1, '2021-11-19', 1),
(39, 30, 2, -1, '2021-11-19', 1),
(40, 20, 2, -1, '2021-11-20', 1),
(41, 1, 4, 4, '2021-11-23', 1),
(42, 1, 4, 4, '2021-11-23', 1),
(43, 1, 4, 4, '2021-11-23', 1),
(44, 28, 2, -1, '2021-11-27', 1),
(45, 27, 2, -1, '2021-12-02', 1),
(46, 28, 2, -1, '2021-12-02', 1),
(47, 28, 2, -1, '2021-12-02', 1),
(48, 24, 2, -1, '2021-12-02', 1),
(49, 28, 2, -2, '2021-12-09', 1),
(50, 6, 4, 1, '2022-03-12', 1),
(51, 9, 4, 2, '2022-03-12', 1),
(52, 10, 4, 1, '2022-03-12', 1),
(53, 11, 4, 1, '2022-03-12', 1),
(54, 13, 4, 1, '2022-03-12', 1),
(55, 14, 4, 2, '2022-03-12', 1),
(56, 15, 4, 4, '2022-03-12', 1),
(57, 17, 4, 1, '2022-03-12', 1),
(58, 19, 4, 4, '2022-03-12', 1),
(59, 20, 4, 3, '2022-03-12', 1),
(60, 23, 4, 12, '2022-03-12', 1),
(61, 25, 4, 1, '2022-03-12', 1),
(62, 27, 4, 2, '2022-03-12', 1),
(63, 28, 4, 5, '2022-03-12', 1),
(64, 32, 1, 1, '2022-03-21', 1),
(65, 33, 1, 1, '2022-03-21', 1),
(66, 34, 1, 1, '2022-03-21', 1),
(67, 35, 1, 1, '2022-03-21', 1),
(68, 40, 1, 1, '2022-03-21', 1),
(69, 39, 1, 1, '2022-03-21', 1),
(70, 38, 1, 1, '2022-03-21', 1),
(71, 37, 1, 1, '2022-03-21', 1),
(72, 36, 1, 1, '2022-03-21', 1),
(73, 41, 1, 1, '2022-03-21', 1),
(74, 44, 1, 1, '2022-03-21', 1),
(75, 43, 1, 1, '2022-03-21', 1),
(76, 42, 1, 1, '2022-03-21', 1),
(77, 48, 1, 1, '2022-03-21', 1),
(78, 47, 1, 2, '2022-03-21', 1),
(79, 46, 1, 1, '2022-03-21', 1),
(80, 45, 1, 1, '2022-03-21', 1),
(81, 60, 1, 1, '2022-03-21', 1),
(82, 59, 1, 1, '2022-03-21', 1),
(83, 58, 1, 1, '2022-03-21', 1),
(84, 57, 1, 1, '2022-03-21', 1),
(85, 56, 1, 1, '2022-03-21', 1),
(86, 55, 1, 1, '2022-03-21', 1),
(87, 54, 1, 1, '2022-03-21', 1),
(88, 53, 1, 1, '2022-03-21', 1),
(89, 52, 1, 1, '2022-03-21', 1),
(90, 51, 1, 1, '2022-03-21', 1),
(91, 50, 1, 1, '2022-03-21', 1),
(92, 49, 1, 1, '2022-03-21', 1),
(93, 68, 1, 1, '2022-03-21', 1),
(94, 71, 1, 1, '2022-03-21', 1),
(95, 70, 1, 1, '2022-03-21', 1),
(96, 69, 1, 1, '2022-03-21', 1),
(97, 67, 1, 1, '2022-03-21', 1),
(98, 66, 1, 1, '2022-03-21', 1),
(99, 65, 1, 2, '2022-03-21', 1),
(100, 64, 1, 2, '2022-03-21', 1),
(101, 63, 1, 1, '2022-03-21', 1),
(102, 62, 1, 1, '2022-03-21', 1),
(103, 61, 1, 1, '2022-03-21', 1),
(104, 70, 2, -1, '2022-04-13', 1),
(105, 5, 4, 1, '2022-05-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla paginas
--

CREATE TABLE paginas (
  IdPagina int(11) NOT NULL,
  NombrePagina varchar(120) NOT NULL,
  Enlacepagina varchar(120) NOT NULL,
  Imagen varchar(60) NOT NULL,
  grupopagina int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla paginas
--

INSERT INTO paginas (IdPagina, NombrePagina, Enlacepagina, Imagen, grupopagina) VALUES
(1, 'Usuarios', 'Usuarios', 'fas fa-users-cog', 6),
(2, 'Proveedores', 'Proveedores', 'fas fa-truck', 3),
(3, 'Clientes', 'Clientes', 'fas fa-user-friends', 4),
(4, 'Articulos', 'Articulos', 'fas fa-boxes', 2),
(5, 'Recepciones', 'Recepciones', 'fas fa-dolly', 2),
(6, 'Ventas', 'Ventas', 'fas fa-file-invoice-dollar', 1),
(7, 'Agregar Venta', 'AgregarVenta', 'fas fa-file-invoice', 1),
(8, 'Agregar recepcion', 'AgregarRecepcion', 'fas fa-dolly-flatbed', 2),
(9, 'Ajustes de inventario', 'AjustesDeInventario', 'fas fa-clipboard-list', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla permisos
--

CREATE TABLE permisos (
  IdPermiso int(11) NOT NULL,
  IdUsuario int(11) NOT NULL,
  Idpagina int(11) NOT NULL,
  Permiso int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla permisos
--

INSERT INTO permisos (IdPermiso, IdUsuario, Idpagina, Permiso) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 2, 1, 1),
(11, 2, 2, 1),
(12, 2, 3, 1),
(13, 2, 4, 1),
(14, 2, 5, 0),
(15, 2, 6, 0),
(16, 2, 7, 0),
(17, 2, 8, 0),
(18, 2, 9, 0),
(28, 3, 1, 0),
(29, 3, 2, 0),
(30, 3, 3, 0),
(31, 3, 4, 0),
(32, 3, 5, 0),
(33, 3, 6, 0),
(34, 3, 7, 0),
(35, 3, 8, 0),
(36, 3, 9, 0),
(37, 4, 1, 0),
(38, 4, 2, 0),
(39, 4, 3, 0),
(40, 4, 4, 0),
(41, 4, 5, 0),
(42, 4, 6, 0),
(43, 4, 7, 0),
(44, 4, 8, 0),
(45, 4, 9, 0),
(46, 5, 1, 1),
(47, 5, 2, 0),
(48, 5, 3, 0),
(49, 5, 4, 0),
(50, 5, 5, 0),
(51, 5, 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla proveedores
--

CREATE TABLE proveedores (
  rut varchar(11) NOT NULL,
  nombre varchar(80) NOT NULL,
  giro varchar(90) NOT NULL,
  direccion varchar(120) NOT NULL,
  comuna int(11) NOT NULL,
  region int(11) NOT NULL,
  telefono int(9) NOT NULL,
  mail varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla proveedores
--

INSERT INTO proveedores (rut, nombre, giro, direccion, comuna, region, telefono, mail) VALUES
('17831089-5', 'paula alejandra ramirez oliveros', 'venta de articulos de ferreteria', 'malleco 9315', 237, 11, 111111113, 'no@tiene.com'),
('26259446-7', 'Maria Jesusa Espinoza Kallapani', 'Confeccion de prendas de vestir', 'Romulo Peña, 871', 1, 1, 994679847, 'contacto@wiltex.cl'),
('66666666-6', 'proveedor generico', 'generico', 'itata 351', 204, 10, 994679847, 'danilo.cid.v@gmail.com'),
('77422976-0', 'Imp. claudio  y paula SPA', 'venta de articulos de ferreteria', 'malleco 9315', 237, 11, 967569845, 'importadoraclaudioypaula@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla recepciones
--

CREATE TABLE recepciones (
  id int(11) NOT NULL,
  proveedor varchar(11) NOT NULL,
  documento int(11) NOT NULL,
  tipo_documento int(11) NOT NULL,
  total_neto int(11) NOT NULL,
  total_imp int(11) NOT NULL,
  unidades_total int(11) NOT NULL,
  observaciones varchar(250) NOT NULL,
  fecha date NOT NULL,
  usuario int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla recepciones
--

INSERT INTO recepciones (id, proveedor, documento, tipo_documento, total_neto, total_imp, unidades_total, observaciones, fecha, usuario) VALUES
(2, '66666666-6', 1, 52, 26838, 5102, 17, 'recepcion inicial', '2021-11-06', 1),
(3, '17831089-5', 154, 33, 101662, 19318, 18, 'compra', '2021-11-06', 1),
(4, '77422976-0', 24, 33, 122124, 23202, 49, 'Compra', '2021-11-07', 1),
(5, '66666666-6', 1, 33, 41547, 7893, 15, 'ingreso manual', '2021-11-17', 1),
(6, '26259446-7', 151, 33, 439492, 83508, 43, 'delantales', '2022-03-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla regiones
--

CREATE TABLE regiones (
  id int(11) NOT NULL,
  region varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla regiones
--

INSERT INTO regiones (id, region) VALUES
(1, 'Arica y Parinacota'),
(2, 'Tarapaca'),
(3, 'Antofagasta'),
(4, 'Atacama'),
(5, 'Coquimbo'),
(6, 'Valparaiso'),
(7, 'Metropolitana de Santiago'),
(8, 'Libertador General Bernardo O\'Higgins'),
(9, 'Maule'),
(10, '?uble'),
(11, 'Biobio'),
(12, 'La Araucania'),
(13, 'Los Rios'),
(14, 'Los Lagos'),
(15, 'Aysen del General Carlos Iba?ez del Campo'),
(16, 'Magallanes y de la Antartica Chilena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tipo_documento
--

CREATE TABLE tipo_documento (
  id int(11) NOT NULL,
  tipo varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla tipo_documento
--

INSERT INTO tipo_documento (id, tipo) VALUES
(33, 'Factura electronica'),
(34, 'Factura exenta'),
(39, 'Boleta electronica'),
(41, 'Boleta exenta electronica'),
(52, 'Guia de despacho electronica'),
(61, 'Nota de credito electronica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tipo_movimiento
--

CREATE TABLE tipo_movimiento (
  id int(11) NOT NULL,
  tipo varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla tipo_movimiento
--

INSERT INTO tipo_movimiento (id, tipo) VALUES
(1, 'Recepcion'),
(2, 'Venta'),
(3, 'Robo'),
(4, 'Ajuste de inventario'),
(5, 'Merma'),
(6, 'Devolucion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla usuarios
--

CREATE TABLE usuarios (
  IdUsuario int(11) NOT NULL,
  User varchar(60) NOT NULL,
  password varchar(60) NOT NULL,
  Nombre varchar(60) NOT NULL,
  Apellidos varchar(80) NOT NULL,
  Activo int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla usuarios
--

INSERT INTO usuarios (IdUsuario, `User`, `password`, Nombre, Apellidos, Activo) VALUES
(1, 'danilo', 'danilo', 'Danilo', 'Cid', 1),
(2, 'ventas', 'ventas', 'Usuario', 'Ventas', 1),
(3, 'reportes', 'reportes', 'Reportes', 'Reportes', 1),
(4, 'reportes', 'reportes', 'Reportes', 'Reportes', 1),
(5, 'test', 'test', 'test', 'test', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla ventas
--

CREATE TABLE ventas (
  id int(11) NOT NULL,
  monto_neto int(11) NOT NULL,
  monto_imp int(11) NOT NULL,
  tipo_documento int(11) NOT NULL,
  documento int(11) NOT NULL,
  cliente varchar(11) NOT NULL,
  medio_pago int(11) NOT NULL,
  fecha date NOT NULL,
  usuario int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla ventas
--

INSERT INTO ventas (id, monto_neto, monto_imp, tipo_documento, documento, cliente, medio_pago, fecha, usuario) VALUES
(3, 6714, 1276, 39, 65, '111111-1', 1, '2021-11-13', 1),
(4, 7555, 1435, 39, 66, '111111-1', 1, '2021-11-13', 1),
(5, 5874, 1116, 39, 67, '111111-1', 1, '2021-11-15', 1),
(6, 5874, 1116, 39, 68, '111111-1', 1, '2021-11-18', 1),
(7, 21008, 3992, 39, 69, '111111-1', 1, '2021-11-19', 1),
(8, 10084, 1916, 39, 70, '111111-1', 1, '2021-11-19', 1),
(9, 10084, 1916, 39, 71, '111111-1', 1, '2021-11-20', 1),
(10, 1681, 319, 39, 72, '111111-1', 1, '2021-11-27', 1),
(11, 8395, 1595, 39, 73, '111111-1', 1, '2021-12-02', 1),
(12, 1681, 319, 39, 74, '111111-1', 1, '2021-12-02', 1),
(13, 8395, 1595, 39, 75, '111111-1', 1, '2021-12-02', 1),
(14, 3361, 639, 39, 76, '111111-1', 1, '2021-12-09', 1),
(15, 17639, 3351, 39, 110, '111111-1', 4, '2022-04-13', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla ajustes_de_inventario
--
ALTER TABLE ajustes_de_inventario
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla articulos
--
ALTER TABLE articulos
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla clientes
--
ALTER TABLE clientes
  ADD PRIMARY KEY (rut);

--
-- Indices de la tabla comunas
--
ALTER TABLE comunas
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla detalle_ajuste
--
ALTER TABLE detalle_ajuste
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla detalle_recepciones
--
ALTER TABLE detalle_recepciones
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla detalle_ventas
--
ALTER TABLE detalle_ventas
  ADD PRIMARY KEY (id),
  ADD KEY detalle_ventas_ibfk_1 (id_venta);

--
-- Indices de la tabla grupospaginas
--
ALTER TABLE grupospaginas
  ADD PRIMARY KEY (idgrupo);

--
-- Indices de la tabla medios_de_pago
--
ALTER TABLE medios_de_pago
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla movimientos_articulos
--
ALTER TABLE movimientos_articulos
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla paginas
--
ALTER TABLE paginas
  ADD PRIMARY KEY (IdPagina);

--
-- Indices de la tabla permisos
--
ALTER TABLE permisos
  ADD PRIMARY KEY (IdPermiso);

--
-- Indices de la tabla proveedores
--
ALTER TABLE proveedores
  ADD PRIMARY KEY (rut);

--
-- Indices de la tabla recepciones
--
ALTER TABLE recepciones
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla regiones
--
ALTER TABLE regiones
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla tipo_documento
--
ALTER TABLE tipo_documento
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla tipo_movimiento
--
ALTER TABLE tipo_movimiento
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla usuarios
--
ALTER TABLE usuarios
  ADD PRIMARY KEY (IdUsuario);

--
-- Indices de la tabla ventas
--
ALTER TABLE ventas
  ADD PRIMARY KEY (id),
  ADD KEY cliente (cliente),
  ADD KEY medio_pago (medio_pago),
  ADD KEY tipo_documento (tipo_documento),
  ADD KEY usuario (usuario);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla ajustes_de_inventario
--
ALTER TABLE ajustes_de_inventario
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla articulos
--
ALTER TABLE articulos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla comunas
--
ALTER TABLE comunas
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT de la tabla detalle_ajuste
--
ALTER TABLE detalle_ajuste
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla detalle_recepciones
--
ALTER TABLE detalle_recepciones
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla detalle_ventas
--
ALTER TABLE detalle_ventas
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla grupospaginas
--
ALTER TABLE grupospaginas
  MODIFY idgrupo int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla medios_de_pago
--
ALTER TABLE medios_de_pago
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla movimientos_articulos
--
ALTER TABLE movimientos_articulos
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla paginas
--
ALTER TABLE paginas
  MODIFY IdPagina int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla permisos
--
ALTER TABLE permisos
  MODIFY IdPermiso int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla recepciones
--
ALTER TABLE recepciones
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla regiones
--
ALTER TABLE regiones
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla tipo_movimiento
--
ALTER TABLE tipo_movimiento
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla usuarios
--
ALTER TABLE usuarios
  MODIFY IdUsuario int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla ventas
--
ALTER TABLE ventas
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla detalle_ventas
--
ALTER TABLE detalle_ventas
  ADD CONSTRAINT detalle_ventas_ibfk_1 FOREIGN KEY (id_venta) REFERENCES ventas (id);

--
-- Filtros para la tabla ventas
--
ALTER TABLE ventas
  ADD CONSTRAINT ventas_ibfk_1 FOREIGN KEY (cliente) REFERENCES clientes (rut),
  ADD CONSTRAINT ventas_ibfk_2 FOREIGN KEY (medio_pago) REFERENCES medios_de_pago (id),
  ADD CONSTRAINT ventas_ibfk_3 FOREIGN KEY (tipo_documento) REFERENCES tipo_documento (id),
  ADD CONSTRAINT ventas_ibfk_4 FOREIGN KEY (usuario) REFERENCES usuarios (IdUsuario);
COMMIT;
