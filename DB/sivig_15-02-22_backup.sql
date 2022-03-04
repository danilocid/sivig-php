

CREATE TABLE `ajustes_de_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_movimiento` int(11) NOT NULL,
  `monto_neto` int(11) NOT NULL,
  `monto_imp` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_interno` varchar(60) NOT NULL,
  `cod_barras` varchar(60) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `costo_neto` int(11) NOT NULL,
  `costo_imp` int(11) NOT NULL,
  `venta_neto` int(11) NOT NULL,
  `venta_imp` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;



CREATE TABLE `clientes` (
  `rut` varchar(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `giro` varchar(90) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `comuna` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `telefono` int(9) NOT NULL,
  `mail` varchar(80) NOT NULL,
  PRIMARY KEY (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `comunas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comuna` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=latin1;



CREATE TABLE `detalle_ajuste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ajuste` int(11) NOT NULL,
  `articulo` int(11) NOT NULL,
  `monto_neto` int(11) NOT NULL,
  `monto_imp` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;



CREATE TABLE `detalle_recepciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recepcion` int(11) NOT NULL,
  `articulo` int(11) NOT NULL,
  `compra_neto` int(11) NOT NULL,
  `compra_imp` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;



CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_neto` int(11) NOT NULL,
  `precio_imp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;



CREATE TABLE `grupospaginas` (
  `idgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombregrupo` varchar(120) NOT NULL,
  `imagengrupo` varchar(120) NOT NULL,
  `posicion` int(11) NOT NULL,
  PRIMARY KEY (`idgrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;



CREATE TABLE `medios_de_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medio_de_pago` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



CREATE TABLE `movimientos_articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articulo` int(11) NOT NULL,
  `movimiento` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;



CREATE TABLE `paginas` (
  `IdPagina` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePagina` varchar(120) NOT NULL,
  `Enlacepagina` varchar(120) NOT NULL,
  `Imagen` varchar(60) NOT NULL,
  `grupopagina` int(11) NOT NULL,
  PRIMARY KEY (`IdPagina`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;



CREATE TABLE `permisos` (
  `IdPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) NOT NULL,
  `Idpagina` int(11) NOT NULL,
  `Permiso` int(11) NOT NULL,
  PRIMARY KEY (`IdPermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;



CREATE TABLE `proveedores` (
  `rut` varchar(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `giro` varchar(90) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `comuna` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `telefono` int(9) NOT NULL,
  `mail` varchar(80) NOT NULL,
  PRIMARY KEY (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `recepciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `total_neto` int(11) NOT NULL,
  `total_imp` int(11) NOT NULL,
  `unidades_total` int(11) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;



CREATE TABLE `regiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;



CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `tipo_movimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;



CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `User` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `Nombre` varchar(60) NOT NULL,
  `Apellidos` varchar(80) NOT NULL,
  `Activo` int(11) NOT NULL,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;



CREATE TABLE `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto_neto` int(11) NOT NULL,
  `monto_imp` int(11) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `cliente` varchar(11) NOT NULL,
  `medio_pago` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente` (`cliente`),
  KEY `medio_pago` (`medio_pago`),
  KEY `tipo_documento` (`tipo_documento`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`rut`),
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`medio_pago`) REFERENCES `medios_de_pago` (`id`),
  CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`tipo_documento`) REFERENCES `tipo_documento` (`id`),
  CONSTRAINT `ventas_ibfk_4` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO ajustes_de_inventario VALUES("1","4","150","29","ajuste de pruebas","2022-02-08","1");
INSERT INTO ajustes_de_inventario VALUES("2","4","150","29","ajuste de pruebas","2022-02-08","1");
INSERT INTO ajustes_de_inventario VALUES("3","4","-150","-29","ajuste de pruebas","2022-02-08","1");

INSERT INTO articulos VALUES("1","test","test","articulo de pruebas","150","29","1672","318","-5","1");
INSERT INTO articulos VALUES("2","hdmi3m","03206","cable hdmi 3m","1672","318","2513","477","3","1");
INSERT INTO articulos VALUES("3","p-340","6950854602377","audifonos manos libres con cable","2521","479","5034","956","2","1");
INSERT INTO articulos VALUES("4","hdmi5m","4595654570625","cable hdmi 5m plano","1672","318","4193","797","3","1");
INSERT INTO articulos VALUES("5","linternazoom","linternazoom","linterna tactica con zoom con bateria recargable","3361","639","4202","798","1","1");
INSERT INTO articulos VALUES("6","bt-350","bt-350","receptor de audio bluetooth","840","160","2521","479","5","1");
INSERT INTO articulos VALUES("7","LG-40495","6957438072083","cuaderno cat","1261","239","2513","477","2","1");
INSERT INTO articulos VALUES("8","LG-40516","6957438072090","cuaderno cat grande","1681","319","3353","637","1","1");
INSERT INTO articulos VALUES("9","ec-cl7-blk","6923450656372","set de 7 cuchillos negros","4874","926","9235","1755","3","1");
INSERT INTO articulos VALUES("10","STN-28","6989532512530","audifonos cat","5874","1116","12597","2393","1","1");
INSERT INTO articulos VALUES("11","YE-02","5555888802543","licuadora individual USB","3193","607","7555","1435","1","1");
INSERT INTO articulos VALUES("12","82143","2020123821434","dispensador de papel para cocina","3361","639","7555","1435","1","1");
INSERT INTO articulos VALUES("13","CAMIP1","CAMIP1","camara ip 5 antenas","13025","2475","18478","3511","1","1");
INSERT INTO articulos VALUES("14","1604628","+C11604628","camara ip 3 antenas","12185","2315","16807","3193","2","1");
INSERT INTO articulos VALUES("15","2701054","+C12701054","foco solar con soporte","3193","607","6714","1276","4","1");
INSERT INTO articulos VALUES("16","1618110","1618110","tira led 5 metros  RGB","2689","511","5874","1116","3","1");
INSERT INTO articulos VALUES("17","pesaba?o","pesaba?o","pesa de vidrio digital","3353","637","8395","1595","1","1");
INSERT INTO articulos VALUES("18","RS-334","RS-334","Manguera retractil 15 mt","2941","559","5874","1116","0","1");
INSERT INTO articulos VALUES("19","Focosolar","Focosolar","Foco solar con sensor de movimiento ","2101","399","4193","797","4","1");
INSERT INTO articulos VALUES("20","RS-434","RS-434","Olla calentadora cera ","3782","718","8403","1597","8","1");
INSERT INTO articulos VALUES("21","JS-747","8687807885157","Dispensador 4 en 1","5034","956","8395","1595","2","1");
INSERT INTO articulos VALUES("22","8018","8018","Organizador microonda","3361","639","6723","1277","1","1");
INSERT INTO articulos VALUES("23","i12","i12","Audifono bluetooth","2773","527","6714","1276","12","1");
INSERT INTO articulos VALUES("24","Lamp01","Lamp 01","Lampara de sal usb","4193","797","8395","1595","1","1");
INSERT INTO articulos VALUES("25","TS-19","+C11604637","Parlante  buetoth","4193","797","8395","1595","1","1");
INSERT INTO articulos VALUES("26","BASURERO","6977009124003","Basurero magico ","840","160","1681","319","2","1");
INSERT INTO articulos VALUES("27","PATASLARGAS","PATASLARGAS","Mu?ecos navide?os patas largas ","3353","637","6714","1276","3","1");
INSERT INTO articulos VALUES("28","NL-2423","6907662694230","Pie de arbol","700","133","1681","319","12","1");
INSERT INTO articulos VALUES("29","limpiadorfacial","2020123402190","limpiador facial USB","1261","239","2513","477","3","1");
INSERT INTO articulos VALUES("30","JD-2178-T","7858816081828","luz solar con control remoto, simula camara","5042","958","10084","1916","3","1");
INSERT INTO articulos VALUES("31","soportebicicleta","soportebicicleta","soporte bicicleta","1672","318","4193","797","6","1");

INSERT INTO clientes VALUES("111111-1","Cliente Generico","Particular","N/A","204","10","0","contacto@llamativo.cl");

INSERT INTO comunas VALUES("1","Arica","1");
INSERT INTO comunas VALUES("2","Camarones","1");
INSERT INTO comunas VALUES("3","General Lagos","1");
INSERT INTO comunas VALUES("4","Putre","1");
INSERT INTO comunas VALUES("5","Alto Hospicio","2");
INSERT INTO comunas VALUES("6","Iquique","2");
INSERT INTO comunas VALUES("7","Cami?a","2");
INSERT INTO comunas VALUES("8","Colchane","2");
INSERT INTO comunas VALUES("9","Huara","2");
INSERT INTO comunas VALUES("10","Pica","2");
INSERT INTO comunas VALUES("11","Pozo Almonte","2");
INSERT INTO comunas VALUES("12","Tocopilla","3");
INSERT INTO comunas VALUES("13","Maria Elena","3");
INSERT INTO comunas VALUES("14","Calama","3");
INSERT INTO comunas VALUES("15","Ollague","3");
INSERT INTO comunas VALUES("16","San Pedro de Atacama","3");
INSERT INTO comunas VALUES("17","Antofagasta","3");
INSERT INTO comunas VALUES("18","Mejillones","3");
INSERT INTO comunas VALUES("19","Sierra Gorda","3");
INSERT INTO comunas VALUES("20","Taltal","3");
INSERT INTO comunas VALUES("21","Cha?aral","4");
INSERT INTO comunas VALUES("22","Diego de Almagro","4");
INSERT INTO comunas VALUES("23","Copiapo","4");
INSERT INTO comunas VALUES("24","Caldera","4");
INSERT INTO comunas VALUES("25","Tierra Amarilla","4");
INSERT INTO comunas VALUES("26","Vallenar","4");
INSERT INTO comunas VALUES("27","Alto del Carmen","4");
INSERT INTO comunas VALUES("28","Freirina","4");
INSERT INTO comunas VALUES("29","Huasco","4");
INSERT INTO comunas VALUES("30","La Serena","5");
INSERT INTO comunas VALUES("31","Coquimbo","5");
INSERT INTO comunas VALUES("32","Andacollo","5");
INSERT INTO comunas VALUES("33","La Higuera","5");
INSERT INTO comunas VALUES("34","Paihuano","5");
INSERT INTO comunas VALUES("35","Vicu?a","5");
INSERT INTO comunas VALUES("36","Ovalle","5");
INSERT INTO comunas VALUES("37","Combarbala","5");
INSERT INTO comunas VALUES("38","Monte Patria","5");
INSERT INTO comunas VALUES("39","Punitaqui","5");
INSERT INTO comunas VALUES("40","Rio Hurtado","5");
INSERT INTO comunas VALUES("41","Illapel","5");
INSERT INTO comunas VALUES("42","Canela","5");
INSERT INTO comunas VALUES("43","Los Vilos","5");
INSERT INTO comunas VALUES("44","Salamanca","5");
INSERT INTO comunas VALUES("45","La Ligua","6");
INSERT INTO comunas VALUES("46","Cabildo","6");
INSERT INTO comunas VALUES("47","Zapallar","6");
INSERT INTO comunas VALUES("48","Papudo","6");
INSERT INTO comunas VALUES("49","Petorca","6");
INSERT INTO comunas VALUES("50","Los Andes","6");
INSERT INTO comunas VALUES("51","San Esteban","6");
INSERT INTO comunas VALUES("52","Calle Larga","6");
INSERT INTO comunas VALUES("53","Rinconada","6");
INSERT INTO comunas VALUES("54","San Felipe","6");
INSERT INTO comunas VALUES("55","Llaillay","6");
INSERT INTO comunas VALUES("56","Putaendo","6");
INSERT INTO comunas VALUES("57","Santa Maria","6");
INSERT INTO comunas VALUES("58","Catemu","6");
INSERT INTO comunas VALUES("59","Panquehue","6");
INSERT INTO comunas VALUES("60","Quillota","6");
INSERT INTO comunas VALUES("61","La Cruz","6");
INSERT INTO comunas VALUES("62","La Calera","6");
INSERT INTO comunas VALUES("63","Nogales","6");
INSERT INTO comunas VALUES("64","Hijuelas","6");
INSERT INTO comunas VALUES("65","Valparaiso","6");
INSERT INTO comunas VALUES("66","Vi?a del Mar","6");
INSERT INTO comunas VALUES("67","Concon","6");
INSERT INTO comunas VALUES("68","Quintero","6");
INSERT INTO comunas VALUES("69","Puchuncavi","6");
INSERT INTO comunas VALUES("70","Casablanca","6");
INSERT INTO comunas VALUES("71","Juan Fernandez","6");
INSERT INTO comunas VALUES("72","San Antonio","6");
INSERT INTO comunas VALUES("73","Cartagena","6");
INSERT INTO comunas VALUES("74","El Tabo","6");
INSERT INTO comunas VALUES("75","El Quisco","6");
INSERT INTO comunas VALUES("76","Algarrobo","6");
INSERT INTO comunas VALUES("77","Santo Domingo","6");
INSERT INTO comunas VALUES("78","Isla de Pascua","6");
INSERT INTO comunas VALUES("79","Quilpue","6");
INSERT INTO comunas VALUES("80","Limache","6");
INSERT INTO comunas VALUES("81","Olmue","6");
INSERT INTO comunas VALUES("82","Villa Alemana","6");
INSERT INTO comunas VALUES("83","Colina","7");
INSERT INTO comunas VALUES("84","Lampa","7");
INSERT INTO comunas VALUES("85","Tiltil","7");
INSERT INTO comunas VALUES("86","Santiago","7");
INSERT INTO comunas VALUES("87","Vitacura","7");
INSERT INTO comunas VALUES("88","San Ramon","7");
INSERT INTO comunas VALUES("89","San Miguel","7");
INSERT INTO comunas VALUES("90","San Joaquin","7");
INSERT INTO comunas VALUES("91","Renca","7");
INSERT INTO comunas VALUES("92","Recoleta","7");
INSERT INTO comunas VALUES("93","Quinta Normal","7");
INSERT INTO comunas VALUES("94","Quilicura","7");
INSERT INTO comunas VALUES("95","Pudahuel","7");
INSERT INTO comunas VALUES("96","Providencia","7");
INSERT INTO comunas VALUES("97","Pe?alolen","7");
INSERT INTO comunas VALUES("98","Pedro Aguirre Cerda","7");
INSERT INTO comunas VALUES("99","?u?oa","7");
INSERT INTO comunas VALUES("100","Maipu","7");
INSERT INTO comunas VALUES("101","Macul","7");
INSERT INTO comunas VALUES("102","Lo Prado","7");
INSERT INTO comunas VALUES("103","Lo Espejo","7");
INSERT INTO comunas VALUES("104","Lo Barnechea","7");
INSERT INTO comunas VALUES("105","Las Condes","7");
INSERT INTO comunas VALUES("106","La Reina","7");
INSERT INTO comunas VALUES("107","La Pintana","7");
INSERT INTO comunas VALUES("108","La Granja","7");
INSERT INTO comunas VALUES("109","La Florida","7");
INSERT INTO comunas VALUES("110","La Cisterna","7");
INSERT INTO comunas VALUES("111","Independencia","7");
INSERT INTO comunas VALUES("112","Huechuraba","7");
INSERT INTO comunas VALUES("113","Estacion Central","7");
INSERT INTO comunas VALUES("114","El Bosque","7");
INSERT INTO comunas VALUES("115","Conchali","7");
INSERT INTO comunas VALUES("116","Cerro Navia","7");
INSERT INTO comunas VALUES("117","Cerrillos","7");
INSERT INTO comunas VALUES("118","Puente Alto","7");
INSERT INTO comunas VALUES("119","San Jose de Maipo","7");
INSERT INTO comunas VALUES("120","Pirque","7");
INSERT INTO comunas VALUES("121","San Bernardo","7");
INSERT INTO comunas VALUES("122","Buin","7");
INSERT INTO comunas VALUES("123","Paine","7");
INSERT INTO comunas VALUES("124","Calera de Tango","7");
INSERT INTO comunas VALUES("125","Melipilla","7");
INSERT INTO comunas VALUES("126","Alhue","7");
INSERT INTO comunas VALUES("127","Curacavi","7");
INSERT INTO comunas VALUES("128","Maria Pinto","7");
INSERT INTO comunas VALUES("129","San Pedro","7");
INSERT INTO comunas VALUES("130","Isla de Maipo","7");
INSERT INTO comunas VALUES("131","El Monte","7");
INSERT INTO comunas VALUES("132","Padre Hurtado","7");
INSERT INTO comunas VALUES("133","Pe?aflor","7");
INSERT INTO comunas VALUES("134","Talagante","7");
INSERT INTO comunas VALUES("135","Codegua","8");
INSERT INTO comunas VALUES("136","Coinco","8");
INSERT INTO comunas VALUES("137","Coltauco","8");
INSERT INTO comunas VALUES("138","Do?ihue","8");
INSERT INTO comunas VALUES("139","Graneros","8");
INSERT INTO comunas VALUES("140","Las Cabras","8");
INSERT INTO comunas VALUES("141","Machali","8");
INSERT INTO comunas VALUES("142","Malloa","8");
INSERT INTO comunas VALUES("143","Mostazal","8");
INSERT INTO comunas VALUES("144","Olivar","8");
INSERT INTO comunas VALUES("145","Peumo","8");
INSERT INTO comunas VALUES("146","Pichidegua","8");
INSERT INTO comunas VALUES("147","Quinta de Tilcoco","8");
INSERT INTO comunas VALUES("148","Rancagua","8");
INSERT INTO comunas VALUES("149","Rengo","8");
INSERT INTO comunas VALUES("150","Requinoa","8");
INSERT INTO comunas VALUES("151","San Vicente de Tagua Tagua","8");
INSERT INTO comunas VALUES("152","Chepica","8");
INSERT INTO comunas VALUES("153","Chimbarongo","8");
INSERT INTO comunas VALUES("154","Lolol","8");
INSERT INTO comunas VALUES("155","Nancagua","8");
INSERT INTO comunas VALUES("156","Palmilla","8");
INSERT INTO comunas VALUES("157","Peralillo","8");
INSERT INTO comunas VALUES("158","Placilla","8");
INSERT INTO comunas VALUES("159","Pumanque","8");
INSERT INTO comunas VALUES("160","San Fernando","8");
INSERT INTO comunas VALUES("161","Santa Cruz","8");
INSERT INTO comunas VALUES("162","La Estrella","8");
INSERT INTO comunas VALUES("163","Litueche","8");
INSERT INTO comunas VALUES("164","Marchigue","8");
INSERT INTO comunas VALUES("165","Navidad","8");
INSERT INTO comunas VALUES("166","Paredones","8");
INSERT INTO comunas VALUES("167","Pichilemu","8");
INSERT INTO comunas VALUES("168","Curico","9");
INSERT INTO comunas VALUES("169","Huala?e","9");
INSERT INTO comunas VALUES("170","Licanten","9");
INSERT INTO comunas VALUES("171","Molina","9");
INSERT INTO comunas VALUES("172","Rauco","9");
INSERT INTO comunas VALUES("173","Romeral","9");
INSERT INTO comunas VALUES("174","Sagrada Familia","9");
INSERT INTO comunas VALUES("175","Teno","9");
INSERT INTO comunas VALUES("176","Vichuquen","9");
INSERT INTO comunas VALUES("177","Talca","9");
INSERT INTO comunas VALUES("178","San Clemente","9");
INSERT INTO comunas VALUES("179","Pelarco","9");
INSERT INTO comunas VALUES("180","Pencahue","9");
INSERT INTO comunas VALUES("181","Maule","9");
INSERT INTO comunas VALUES("182","San Rafael","9");
INSERT INTO comunas VALUES("183","Curepto","9");
INSERT INTO comunas VALUES("184","Constitucion","9");
INSERT INTO comunas VALUES("185","Empedrado","9");
INSERT INTO comunas VALUES("186","Rio Claro","9");
INSERT INTO comunas VALUES("187","Linares","9");
INSERT INTO comunas VALUES("188","San Javier","9");
INSERT INTO comunas VALUES("189","Parral","9");
INSERT INTO comunas VALUES("190","Villa Alegre","9");
INSERT INTO comunas VALUES("191","Longavi","9");
INSERT INTO comunas VALUES("192","Colbun","9");
INSERT INTO comunas VALUES("193","Retiro","9");
INSERT INTO comunas VALUES("194","Yerbas Buenas","9");
INSERT INTO comunas VALUES("195","Cauquenes","9");
INSERT INTO comunas VALUES("196","Chanco","9");
INSERT INTO comunas VALUES("197","Pelluhue","9");
INSERT INTO comunas VALUES("198","Bulnes","10");
INSERT INTO comunas VALUES("199","Chillan","10");
INSERT INTO comunas VALUES("200","Chillan Viejo","10");
INSERT INTO comunas VALUES("201","El Carmen","10");
INSERT INTO comunas VALUES("202","Pemuco","10");
INSERT INTO comunas VALUES("203","Pinto","10");
INSERT INTO comunas VALUES("204","Quillon","10");
INSERT INTO comunas VALUES("205","San Ignacio","10");
INSERT INTO comunas VALUES("206","Yungay","10");
INSERT INTO comunas VALUES("207","Cobquecura","10");
INSERT INTO comunas VALUES("208","Coelemu","10");
INSERT INTO comunas VALUES("209","Ninhue","10");
INSERT INTO comunas VALUES("210","Portezuelo","10");
INSERT INTO comunas VALUES("211","Quirihue","10");
INSERT INTO comunas VALUES("212","Ranquil","10");
INSERT INTO comunas VALUES("213","Treguaco","10");
INSERT INTO comunas VALUES("214","San Carlos","10");
INSERT INTO comunas VALUES("215","Coihueco","10");
INSERT INTO comunas VALUES("216","San Nicolas","10");
INSERT INTO comunas VALUES("217","?iquen","10");
INSERT INTO comunas VALUES("218","San Fabian","10");
INSERT INTO comunas VALUES("219","Alto Biobio","11");
INSERT INTO comunas VALUES("220","Antuco","11");
INSERT INTO comunas VALUES("221","Cabrero","11");
INSERT INTO comunas VALUES("222","Laja","11");
INSERT INTO comunas VALUES("223","Los Angeles","11");
INSERT INTO comunas VALUES("224","Mulchen","11");
INSERT INTO comunas VALUES("225","Nacimiento","11");
INSERT INTO comunas VALUES("226","Negrete","11");
INSERT INTO comunas VALUES("227","Quilaco","11");
INSERT INTO comunas VALUES("228","Quilleco","11");
INSERT INTO comunas VALUES("229","San Rosendo","11");
INSERT INTO comunas VALUES("230","Santa Barbara","11");
INSERT INTO comunas VALUES("231","Tucapel","11");
INSERT INTO comunas VALUES("232","Yumbel","11");
INSERT INTO comunas VALUES("233","Concepcion","11");
INSERT INTO comunas VALUES("234","Coronel","11");
INSERT INTO comunas VALUES("235","Chiguayante","11");
INSERT INTO comunas VALUES("236","Florida","11");
INSERT INTO comunas VALUES("237","Hualpen","11");
INSERT INTO comunas VALUES("238","Hualqui","11");
INSERT INTO comunas VALUES("239","Lota","11");
INSERT INTO comunas VALUES("240","Penco","11");
INSERT INTO comunas VALUES("241","San Pedro de La Paz","11");
INSERT INTO comunas VALUES("242","Santa Juana","11");
INSERT INTO comunas VALUES("243","Talcahuano","11");
INSERT INTO comunas VALUES("244","Tome","11");
INSERT INTO comunas VALUES("245","Arauco","11");
INSERT INTO comunas VALUES("246","Ca?ete","11");
INSERT INTO comunas VALUES("247","Contulmo","11");
INSERT INTO comunas VALUES("248","Curanilahue","11");
INSERT INTO comunas VALUES("249","Lebu","11");
INSERT INTO comunas VALUES("250","Los Alamos","11");
INSERT INTO comunas VALUES("251","Tirua","11");
INSERT INTO comunas VALUES("252","Angol","12");
INSERT INTO comunas VALUES("253","Collipulli","12");
INSERT INTO comunas VALUES("254","Curacautin","12");
INSERT INTO comunas VALUES("255","Ercilla","12");
INSERT INTO comunas VALUES("256","Lonquimay","12");
INSERT INTO comunas VALUES("257","Los Sauces","12");
INSERT INTO comunas VALUES("258","Lumaco","12");
INSERT INTO comunas VALUES("259","Puren","12");
INSERT INTO comunas VALUES("260","Renaico","12");
INSERT INTO comunas VALUES("261","Traiguen","12");
INSERT INTO comunas VALUES("262","Victoria","12");
INSERT INTO comunas VALUES("263","Temuco","12");
INSERT INTO comunas VALUES("264","Carahue","12");
INSERT INTO comunas VALUES("265","Cholchol","12");
INSERT INTO comunas VALUES("266","Cunco","12");
INSERT INTO comunas VALUES("267","Curarrehue","12");
INSERT INTO comunas VALUES("268","Freire","12");
INSERT INTO comunas VALUES("269","Galvarino","12");
INSERT INTO comunas VALUES("270","Gorbea","12");
INSERT INTO comunas VALUES("271","Lautaro","12");
INSERT INTO comunas VALUES("272","Loncoche","12");
INSERT INTO comunas VALUES("273","Melipeuco","12");
INSERT INTO comunas VALUES("274","Nueva Imperial","12");
INSERT INTO comunas VALUES("275","Padre Las Casas","12");
INSERT INTO comunas VALUES("276","Perquenco","12");
INSERT INTO comunas VALUES("277","Pitrufquen","12");
INSERT INTO comunas VALUES("278","Pucon","12");
INSERT INTO comunas VALUES("279","Saavedra","12");
INSERT INTO comunas VALUES("280","Teodoro Schmidt","12");
INSERT INTO comunas VALUES("281","Tolten","12");
INSERT INTO comunas VALUES("282","Vilcun","12");
INSERT INTO comunas VALUES("283","Villarrica","12");
INSERT INTO comunas VALUES("284","Valdivia","13");
INSERT INTO comunas VALUES("285","Corral","13");
INSERT INTO comunas VALUES("286","Lanco","13");
INSERT INTO comunas VALUES("287","Los Lagos","13");
INSERT INTO comunas VALUES("288","Mafil","13");
INSERT INTO comunas VALUES("289","Mariquina","13");
INSERT INTO comunas VALUES("290","Paillaco","13");
INSERT INTO comunas VALUES("291","Panguipulli","13");
INSERT INTO comunas VALUES("292","La Union","13");
INSERT INTO comunas VALUES("293","Futrono","13");
INSERT INTO comunas VALUES("294","Lago Ranco","13");
INSERT INTO comunas VALUES("295","Rio Bueno","13");
INSERT INTO comunas VALUES("297","Osorno","14");
INSERT INTO comunas VALUES("298","Puerto Octay","14");
INSERT INTO comunas VALUES("299","Purranque","14");
INSERT INTO comunas VALUES("300","Puyehue","14");
INSERT INTO comunas VALUES("301","Rio Negro","14");
INSERT INTO comunas VALUES("302","San Juan de la Costa","14");
INSERT INTO comunas VALUES("303","San Pablo","14");
INSERT INTO comunas VALUES("304","Calbuco","14");
INSERT INTO comunas VALUES("305","Cochamo","14");
INSERT INTO comunas VALUES("306","Fresia","14");
INSERT INTO comunas VALUES("307","Frutillar","14");
INSERT INTO comunas VALUES("308","Llanquihue","14");
INSERT INTO comunas VALUES("309","Los Muermos","14");
INSERT INTO comunas VALUES("310","Maullin","14");
INSERT INTO comunas VALUES("311","Puerto Montt","14");
INSERT INTO comunas VALUES("312","Puerto Varas","14");
INSERT INTO comunas VALUES("313","Ancud","14");
INSERT INTO comunas VALUES("314","Castro","14");
INSERT INTO comunas VALUES("315","Chonchi","14");
INSERT INTO comunas VALUES("316","Curaco de Velez","14");
INSERT INTO comunas VALUES("317","Dalcahue","14");
INSERT INTO comunas VALUES("318","Puqueldon","14");
INSERT INTO comunas VALUES("319","Queilen","14");
INSERT INTO comunas VALUES("320","Quellon","14");
INSERT INTO comunas VALUES("321","Quemchi","14");
INSERT INTO comunas VALUES("322","Quinchao","14");
INSERT INTO comunas VALUES("323","Chaiten","14");
INSERT INTO comunas VALUES("324","Futaleufu","14");
INSERT INTO comunas VALUES("325","Hualaihue","14");
INSERT INTO comunas VALUES("326","Palena","14");
INSERT INTO comunas VALUES("327","Lago Verde","15");
INSERT INTO comunas VALUES("328","Coihaique","15");
INSERT INTO comunas VALUES("329","Aysen","15");
INSERT INTO comunas VALUES("330","Cisnes","15");
INSERT INTO comunas VALUES("331","Guaitecas","15");
INSERT INTO comunas VALUES("332","Rio Iba?ez","15");
INSERT INTO comunas VALUES("333","Chile Chico","15");
INSERT INTO comunas VALUES("334","Cochrane","15");
INSERT INTO comunas VALUES("335","O'Higgins","15");
INSERT INTO comunas VALUES("336","Tortel","15");
INSERT INTO comunas VALUES("337","Natales","16");
INSERT INTO comunas VALUES("338","Torres del Paine","16");
INSERT INTO comunas VALUES("339","Laguna Blanca","16");
INSERT INTO comunas VALUES("340","Punta Arenas","16");
INSERT INTO comunas VALUES("341","Rio Verde","16");
INSERT INTO comunas VALUES("342","San Gregorio","16");
INSERT INTO comunas VALUES("343","Porvenir","16");
INSERT INTO comunas VALUES("344","Primavera","16");
INSERT INTO comunas VALUES("345","Timaukel","16");
INSERT INTO comunas VALUES("346","Cabo de Hornos","16");
INSERT INTO comunas VALUES("347","Antartica","16");

INSERT INTO detalle_ajuste VALUES("1","1","1","150","29","1");
INSERT INTO detalle_ajuste VALUES("2","2","1","150","29","1");
INSERT INTO detalle_ajuste VALUES("3","3","1","-150","-29","-1");

INSERT INTO detalle_recepciones VALUES("1","2","2","1672","318","3");
INSERT INTO detalle_recepciones VALUES("2","2","4","1672","318","3");
INSERT INTO detalle_recepciones VALUES("3","2","5","3361","639","1");
INSERT INTO detalle_recepciones VALUES("4","2","6","840","160","5");
INSERT INTO detalle_recepciones VALUES("5","2","3","2521","479","2");
INSERT INTO detalle_recepciones VALUES("6","2","7","1261","239","2");
INSERT INTO detalle_recepciones VALUES("7","2","8","1681","319","1");
INSERT INTO detalle_recepciones VALUES("8","3","9","4874","926","3");
INSERT INTO detalle_recepciones VALUES("9","3","10","5874","1116","1");
INSERT INTO detalle_recepciones VALUES("10","3","12","3361","639","1");
INSERT INTO detalle_recepciones VALUES("11","3","11","3193","607","1");
INSERT INTO detalle_recepciones VALUES("12","3","13","13025","2475","2");
INSERT INTO detalle_recepciones VALUES("13","3","14","12185","2315","2");
INSERT INTO detalle_recepciones VALUES("14","3","15","3193","607","4");
INSERT INTO detalle_recepciones VALUES("15","3","16","2689","511","3");
INSERT INTO detalle_recepciones VALUES("16","3","17","3353","637","1");
INSERT INTO detalle_recepciones VALUES("17","4","28","700","133","12");
INSERT INTO detalle_recepciones VALUES("18","4","26","840","160","2");
INSERT INTO detalle_recepciones VALUES("19","4","25","4193","797","1");
INSERT INTO detalle_recepciones VALUES("20","4","21","5034","956","2");
INSERT INTO detalle_recepciones VALUES("21","4","18","2941","559","2");
INSERT INTO detalle_recepciones VALUES("22","4","19","2101","399","4");
INSERT INTO detalle_recepciones VALUES("23","4","20","3782","718","7");
INSERT INTO detalle_recepciones VALUES("24","4","23","2773","527","13");
INSERT INTO detalle_recepciones VALUES("25","4","27","3353","637","3");
INSERT INTO detalle_recepciones VALUES("26","4","22","3361","639","2");
INSERT INTO detalle_recepciones VALUES("27","4","24","4193","797","1");
INSERT INTO detalle_recepciones VALUES("28","5","29","1261","239","3");
INSERT INTO detalle_recepciones VALUES("29","5","20","3782","718","2");
INSERT INTO detalle_recepciones VALUES("30","5","30","5042","958","4");
INSERT INTO detalle_recepciones VALUES("31","5","31","1672","318","6");

INSERT INTO detalle_ventas VALUES("3","3","23","1","6714","1276");
INSERT INTO detalle_ventas VALUES("4","4","22","1","7555","1435");
INSERT INTO detalle_ventas VALUES("5","5","18","1","5874","1116");
INSERT INTO detalle_ventas VALUES("6","6","18","1","5874","1116");
INSERT INTO detalle_ventas VALUES("7","7","13","1","21008","3992");
INSERT INTO detalle_ventas VALUES("8","8","30","1","10084","1916");
INSERT INTO detalle_ventas VALUES("9","9","20","1","10084","1916");

INSERT INTO grupospaginas VALUES("1","Ventas","fas fa-file-invoice-dollar","1");
INSERT INTO grupospaginas VALUES("2","Articulos","fas fa-boxes","2");
INSERT INTO grupospaginas VALUES("3","Proveedores","fas fa-truck","3");
INSERT INTO grupospaginas VALUES("4","Clientes","fas fa-user-friends","4");
INSERT INTO grupospaginas VALUES("5","Reportes","fas fa-signal","5");
INSERT INTO grupospaginas VALUES("6","Configuraci?n","fas fa-cogs","6");

INSERT INTO medios_de_pago VALUES("1","Efectivo");
INSERT INTO medios_de_pago VALUES("2","Debito");
INSERT INTO medios_de_pago VALUES("3","Credito");
INSERT INTO medios_de_pago VALUES("4","Transferencia");

INSERT INTO movimientos_articulos VALUES("3","2","1","3","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("4","4","1","3","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("5","5","1","1","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("6","6","1","5","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("7","3","1","2","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("8","7","1","2","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("9","8","1","1","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("10","9","1","3","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("11","10","1","1","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("12","12","1","1","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("13","11","1","1","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("14","13","1","2","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("15","14","1","2","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("16","15","1","4","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("17","16","1","3","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("18","17","1","1","2021-11-06","1");
INSERT INTO movimientos_articulos VALUES("19","28","1","12","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("20","26","1","2","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("21","25","1","1","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("22","21","1","2","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("23","18","1","2","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("24","19","1","4","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("25","20","1","7","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("26","23","1","13","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("27","27","1","3","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("28","22","1","2","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("29","24","1","1","2021-11-07","1");
INSERT INTO movimientos_articulos VALUES("30","23","2","-1","2021-11-13","1");
INSERT INTO movimientos_articulos VALUES("31","22","2","-1","2021-11-13","1");
INSERT INTO movimientos_articulos VALUES("32","18","2","-1","2021-11-15","1");
INSERT INTO movimientos_articulos VALUES("33","29","1","3","2021-11-17","1");
INSERT INTO movimientos_articulos VALUES("34","20","1","2","2021-11-17","1");
INSERT INTO movimientos_articulos VALUES("35","30","1","4","2021-11-17","1");
INSERT INTO movimientos_articulos VALUES("36","31","1","6","2021-11-17","1");
INSERT INTO movimientos_articulos VALUES("37","18","2","-1","2021-11-18","1");
INSERT INTO movimientos_articulos VALUES("38","13","2","-1","2021-11-19","1");
INSERT INTO movimientos_articulos VALUES("39","30","2","-1","2021-11-19","1");
INSERT INTO movimientos_articulos VALUES("40","20","2","-1","2021-11-20","1");
INSERT INTO movimientos_articulos VALUES("41","1","4","1","2022-02-08","1");
INSERT INTO movimientos_articulos VALUES("42","1","4","1","2022-02-08","1");
INSERT INTO movimientos_articulos VALUES("43","1","4","1","2022-02-08","1");

INSERT INTO paginas VALUES("1","Usuarios","Usuarios","fas fa-users-cog","6");
INSERT INTO paginas VALUES("2","Proveedores","Proveedores","fas fa-truck","3");
INSERT INTO paginas VALUES("3","Clientes","Clientes","fas fa-user-friends","4");
INSERT INTO paginas VALUES("4","Articulos","Articulos","fas fa-boxes","2");
INSERT INTO paginas VALUES("5","Recepciones","Recepciones","fas fa-dolly","2");
INSERT INTO paginas VALUES("6","Ventas","Ventas","fas fa-file-invoice-dollar","1");
INSERT INTO paginas VALUES("7","Agregar Venta","AgregarVenta","fas fa-file-invoice","1");
INSERT INTO paginas VALUES("8","Agregar recepcion","AgregarRecepcion","fas fa-dolly-flatbed","2");
INSERT INTO paginas VALUES("9","Ajustes de inventario","AjustesDeInventario","fas fa-clipboard-list","2");

INSERT INTO permisos VALUES("1","1","1","1");
INSERT INTO permisos VALUES("2","1","2","1");
INSERT INTO permisos VALUES("3","1","3","1");
INSERT INTO permisos VALUES("4","1","4","1");
INSERT INTO permisos VALUES("5","1","5","1");
INSERT INTO permisos VALUES("6","1","6","1");
INSERT INTO permisos VALUES("7","1","7","1");
INSERT INTO permisos VALUES("8","1","8","1");
INSERT INTO permisos VALUES("9","1","9","1");
INSERT INTO permisos VALUES("10","2","1","1");
INSERT INTO permisos VALUES("11","2","2","1");
INSERT INTO permisos VALUES("12","2","3","1");
INSERT INTO permisos VALUES("13","2","4","1");
INSERT INTO permisos VALUES("14","2","5","0");
INSERT INTO permisos VALUES("15","2","6","0");
INSERT INTO permisos VALUES("16","2","7","0");
INSERT INTO permisos VALUES("17","2","8","0");
INSERT INTO permisos VALUES("18","2","9","0");
INSERT INTO permisos VALUES("28","3","1","0");
INSERT INTO permisos VALUES("29","3","2","0");
INSERT INTO permisos VALUES("30","3","3","0");
INSERT INTO permisos VALUES("31","3","4","0");
INSERT INTO permisos VALUES("32","3","5","0");
INSERT INTO permisos VALUES("33","3","6","0");
INSERT INTO permisos VALUES("34","3","7","0");
INSERT INTO permisos VALUES("35","3","8","0");
INSERT INTO permisos VALUES("36","3","9","0");
INSERT INTO permisos VALUES("37","4","1","0");
INSERT INTO permisos VALUES("38","4","2","0");
INSERT INTO permisos VALUES("39","4","3","0");
INSERT INTO permisos VALUES("40","4","4","0");
INSERT INTO permisos VALUES("41","4","5","0");
INSERT INTO permisos VALUES("42","4","6","0");
INSERT INTO permisos VALUES("43","4","7","0");
INSERT INTO permisos VALUES("44","4","8","0");
INSERT INTO permisos VALUES("45","4","9","0");
INSERT INTO permisos VALUES("46","5","1","1");
INSERT INTO permisos VALUES("47","5","2","0");
INSERT INTO permisos VALUES("48","5","3","0");
INSERT INTO permisos VALUES("49","5","4","0");
INSERT INTO permisos VALUES("50","5","5","0");
INSERT INTO permisos VALUES("51","5","6","0");

INSERT INTO proveedores VALUES("17831089-5","paula alejandra ramirez oliveros","venta de articulos de ferreteria","malleco 9315","237","11","111111113","no@tiene.com");
INSERT INTO proveedores VALUES("66666666-6","proveedor generico","generico","itata 351","204","10","994679847","danilo.cid.v@gmail.com");
INSERT INTO proveedores VALUES("77422976-0","Imp. claudio  y paula SPA","venta de articulos de ferreteria","malleco 9315","237","11","967569845","importadoraclaudioypaula@gmail.com");

INSERT INTO recepciones VALUES("2","66666666-6","1","52","26838","5102","17","recepcion inicial","2021-11-06","1");
INSERT INTO recepciones VALUES("3","17831089-5","154","33","101662","19318","18","compra","2021-11-06","1");
INSERT INTO recepciones VALUES("4","77422976-0","24","33","122124","23202","49","Compra","2021-11-07","1");
INSERT INTO recepciones VALUES("5","66666666-6","1","33","41547","7893","15","ingreso manual","2021-11-17","1");

INSERT INTO regiones VALUES("1","Arica y Parinacota");
INSERT INTO regiones VALUES("2","Tarapaca");
INSERT INTO regiones VALUES("3","Antofagasta");
INSERT INTO regiones VALUES("4","Atacama");
INSERT INTO regiones VALUES("5","Coquimbo");
INSERT INTO regiones VALUES("6","Valparaiso");
INSERT INTO regiones VALUES("7","Metropolitana de Santiago");
INSERT INTO regiones VALUES("8","Libertador General Bernardo O'Higgins");
INSERT INTO regiones VALUES("9","Maule");
INSERT INTO regiones VALUES("10","?uble");
INSERT INTO regiones VALUES("11","Biobio");
INSERT INTO regiones VALUES("12","La Araucania");
INSERT INTO regiones VALUES("13","Los Rios");
INSERT INTO regiones VALUES("14","Los Lagos");
INSERT INTO regiones VALUES("15","Aysen del General Carlos Iba?ez del Campo");
INSERT INTO regiones VALUES("16","Magallanes y de la Antartica Chilena");

INSERT INTO tipo_documento VALUES("33","Factura electronica");
INSERT INTO tipo_documento VALUES("34","Factura exenta");
INSERT INTO tipo_documento VALUES("39","Boleta electronica");
INSERT INTO tipo_documento VALUES("41","Boleta exenta electronica");
INSERT INTO tipo_documento VALUES("52","Guia de despacho electronica");
INSERT INTO tipo_documento VALUES("61","Nota de credito electronica");

INSERT INTO tipo_movimiento VALUES("1","Recepcion");
INSERT INTO tipo_movimiento VALUES("2","Venta");
INSERT INTO tipo_movimiento VALUES("3","Robo");
INSERT INTO tipo_movimiento VALUES("4","Ajuste de inventario");
INSERT INTO tipo_movimiento VALUES("5","Merma");
INSERT INTO tipo_movimiento VALUES("6","Devolucion");

INSERT INTO usuarios VALUES("1","danilo","danilo","Danilo","Cid","1");
INSERT INTO usuarios VALUES("2","ventas","ventas","Usuario","Ventas","1");
INSERT INTO usuarios VALUES("3","reportes","reportes","Reportes","Reportes","1");
INSERT INTO usuarios VALUES("4","reportes","reportes","Reportes","Reportes","1");
INSERT INTO usuarios VALUES("5","test","test","test","test","1");

INSERT INTO ventas VALUES("3","6714","1276","39","65","111111-1","1","2021-11-13","1");
INSERT INTO ventas VALUES("4","7555","1435","39","66","111111-1","1","2021-11-13","1");
INSERT INTO ventas VALUES("5","5874","1116","39","67","111111-1","1","2021-11-15","1");
INSERT INTO ventas VALUES("6","5874","1116","39","68","111111-1","1","2021-11-18","1");
INSERT INTO ventas VALUES("7","21008","3992","39","69","111111-1","1","2021-11-19","1");
INSERT INTO ventas VALUES("8","10084","1916","39","70","111111-1","1","2021-11-19","1");
INSERT INTO ventas VALUES("9","10084","1916","39","71","111111-1","1","2021-11-20","1");

