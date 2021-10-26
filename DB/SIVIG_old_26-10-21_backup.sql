

CREATE TABLE `ajustes_de_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_movimiento` int(11) NOT NULL,
  `monto_neto` int(11) NOT NULL,
  `monto_imp` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;



CREATE TABLE `clientes` (
  `rut` varchar(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `giro` varchar(90) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `comuna` int(11) NOT NULL,
  `provincia` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `telefono` int(9) NOT NULL,
  `mail` varchar(80) NOT NULL,
  PRIMARY KEY (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `comunas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comuna` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `provincia_id` (`provincia_id`),
  CONSTRAINT `comunas_ibfk_1` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=latin1;



CREATE TABLE `detalle_ajuste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ajuste` int(11) NOT NULL,
  `articulo` int(11) NOT NULL,
  `monto_neto` int(11) NOT NULL,
  `monto_imp` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `detalle_recepciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recepcion` int(11) NOT NULL,
  `articulo` int(11) NOT NULL,
  `compra_neto` int(11) NOT NULL,
  `compra_imp` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;



CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_neto` int(11) NOT NULL,
  `precio_imp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`id`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;



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
  `provincia` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `telefono` int(9) NOT NULL,
  `mail` varchar(80) NOT NULL,
  PRIMARY KEY (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `region_id` (`region_id`),
  CONSTRAINT `provincias_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`),
  CONSTRAINT `provincias_ibfk_2` FOREIGN KEY (`id`) REFERENCES `comunas` (`provincia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;



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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


INSERT INTO articulos VALUES("1","test","test","articulo de pruebas","500","95","1672","318","0","1");
INSERT INTO articulos VALUES("2","hdmi3m","03206","cable hdmi 3m","1672","318","2513","477","3","1");
INSERT INTO articulos VALUES("3","p-340","6950854602377","audifonos manos libres con cable","2101","399","5034","956","2","1");
INSERT INTO articulos VALUES("4","hdmi5m","4595654570625","cable hdmi 5m plano","2521","479","4193","797","3","1");
INSERT INTO articulos VALUES("5","linternazoom","linternazoom","linterna tactica con zoom con bateria recargable","2101","399","4202","798","5","1");
INSERT INTO articulos VALUES("6","bt-350","bt-350","receptor de audio bluetooth","1261","239","2521","479","5","1");
INSERT INTO articulos VALUES("7","pesabaño","pesabaño","pesa de vidrio","4202","798","8395","1595","1","1");
INSERT INTO articulos VALUES("8","dispensadorcocina","dispensadorcocina","dispensador de papel para cocica","2521","479","5034","956","4","1");
INSERT INTO articulos VALUES("9","limpiadorfacial","limpiadorfacial","limpiador facial USB","1261","239","25202","4788","3","1");
INSERT INTO articulos VALUES("10","JD-2178T","7858816081828","luz exterior solar con control remoto","4202","798","8395","1595","4","1");
INSERT INTO articulos VALUES("11","pro-wax100","7858816054174","olla calentadora de cera","5042","958","8403","1597","7","1");

INSERT INTO clientes VALUES("111111-1","Cliente Generico","Particular","N/A","204","35","10","0","contacto@llamativo.cl");

INSERT INTO comunas VALUES("1","Arica","1");
INSERT INTO comunas VALUES("2","Camarones","1");
INSERT INTO comunas VALUES("3","General Lagos","2");
INSERT INTO comunas VALUES("4","Putre","2");
INSERT INTO comunas VALUES("5","Alto Hospicio","3");
INSERT INTO comunas VALUES("6","Iquique","3");
INSERT INTO comunas VALUES("7","Camiña","4");
INSERT INTO comunas VALUES("8","Colchane","4");
INSERT INTO comunas VALUES("9","Huara","4");
INSERT INTO comunas VALUES("10","Pica","4");
INSERT INTO comunas VALUES("11","Pozo Almonte","4");
INSERT INTO comunas VALUES("12","Tocopilla","5");
INSERT INTO comunas VALUES("13","Maria Elena","5");
INSERT INTO comunas VALUES("14","Calama","6");
INSERT INTO comunas VALUES("15","Ollague","6");
INSERT INTO comunas VALUES("16","San Pedro de Atacama","6");
INSERT INTO comunas VALUES("17","Antofagasta","7");
INSERT INTO comunas VALUES("18","Mejillones","7");
INSERT INTO comunas VALUES("19","Sierra Gorda","7");
INSERT INTO comunas VALUES("20","Taltal","7");
INSERT INTO comunas VALUES("21","Chañaral","8");
INSERT INTO comunas VALUES("22","Diego de Almagro","8");
INSERT INTO comunas VALUES("23","Copiapo","9");
INSERT INTO comunas VALUES("24","Caldera","9");
INSERT INTO comunas VALUES("25","Tierra Amarilla","9");
INSERT INTO comunas VALUES("26","Vallenar","10");
INSERT INTO comunas VALUES("27","Alto del Carmen","10");
INSERT INTO comunas VALUES("28","Freirina","10");
INSERT INTO comunas VALUES("29","Huasco","10");
INSERT INTO comunas VALUES("30","La Serena","11");
INSERT INTO comunas VALUES("31","Coquimbo","11");
INSERT INTO comunas VALUES("32","Andacollo","11");
INSERT INTO comunas VALUES("33","La Higuera","11");
INSERT INTO comunas VALUES("34","Paihuano","11");
INSERT INTO comunas VALUES("35","Vicuña","11");
INSERT INTO comunas VALUES("36","Ovalle","12");
INSERT INTO comunas VALUES("37","Combarbala","12");
INSERT INTO comunas VALUES("38","Monte Patria","12");
INSERT INTO comunas VALUES("39","Punitaqui","12");
INSERT INTO comunas VALUES("40","Rio Hurtado","12");
INSERT INTO comunas VALUES("41","Illapel","13");
INSERT INTO comunas VALUES("42","Canela","13");
INSERT INTO comunas VALUES("43","Los Vilos","13");
INSERT INTO comunas VALUES("44","Salamanca","13");
INSERT INTO comunas VALUES("45","La Ligua","14");
INSERT INTO comunas VALUES("46","Cabildo","14");
INSERT INTO comunas VALUES("47","Zapallar","14");
INSERT INTO comunas VALUES("48","Papudo","14");
INSERT INTO comunas VALUES("49","Petorca","14");
INSERT INTO comunas VALUES("50","Los Andes","15");
INSERT INTO comunas VALUES("51","San Esteban","15");
INSERT INTO comunas VALUES("52","Calle Larga","15");
INSERT INTO comunas VALUES("53","Rinconada","15");
INSERT INTO comunas VALUES("54","San Felipe","16");
INSERT INTO comunas VALUES("55","Llaillay","16");
INSERT INTO comunas VALUES("56","Putaendo","16");
INSERT INTO comunas VALUES("57","Santa Maria","16");
INSERT INTO comunas VALUES("58","Catemu","16");
INSERT INTO comunas VALUES("59","Panquehue","16");
INSERT INTO comunas VALUES("60","Quillota","17");
INSERT INTO comunas VALUES("61","La Cruz","17");
INSERT INTO comunas VALUES("62","La Calera","17");
INSERT INTO comunas VALUES("63","Nogales","17");
INSERT INTO comunas VALUES("64","Hijuelas","17");
INSERT INTO comunas VALUES("65","Valparaiso","18");
INSERT INTO comunas VALUES("66","Viña del Mar","18");
INSERT INTO comunas VALUES("67","Concon","18");
INSERT INTO comunas VALUES("68","Quintero","18");
INSERT INTO comunas VALUES("69","Puchuncavi","18");
INSERT INTO comunas VALUES("70","Casablanca","18");
INSERT INTO comunas VALUES("71","Juan Fernandez","18");
INSERT INTO comunas VALUES("72","San Antonio","19");
INSERT INTO comunas VALUES("73","Cartagena","19");
INSERT INTO comunas VALUES("74","El Tabo","19");
INSERT INTO comunas VALUES("75","El Quisco","19");
INSERT INTO comunas VALUES("76","Algarrobo","19");
INSERT INTO comunas VALUES("77","Santo Domingo","19");
INSERT INTO comunas VALUES("78","Isla de Pascua","20");
INSERT INTO comunas VALUES("79","Quilpue
","21");
INSERT INTO comunas VALUES("80","Limache","21");
INSERT INTO comunas VALUES("81","Olmue","21");
INSERT INTO comunas VALUES("82","Villa Alemana","21");
INSERT INTO comunas VALUES("83","Colina","22");
INSERT INTO comunas VALUES("84","Lampa","22");
INSERT INTO comunas VALUES("85","Tiltil","22");
INSERT INTO comunas VALUES("86","Santiago","23");
INSERT INTO comunas VALUES("87","Vitacura","23");
INSERT INTO comunas VALUES("88","San Ramon","23");
INSERT INTO comunas VALUES("89","San Miguel","23");
INSERT INTO comunas VALUES("90","San Joaquin","23");
INSERT INTO comunas VALUES("91","Renca","23");
INSERT INTO comunas VALUES("92","Recoleta","23");
INSERT INTO comunas VALUES("93","Quinta Normal","23");
INSERT INTO comunas VALUES("94","Quilicura","23");
INSERT INTO comunas VALUES("95","Pudahuel","23");
INSERT INTO comunas VALUES("96","Providencia","23");
INSERT INTO comunas VALUES("97","Peñalolen","23");
INSERT INTO comunas VALUES("98","Pedro Aguirre Cerda","23");
INSERT INTO comunas VALUES("99","Ñuñoa","23");
INSERT INTO comunas VALUES("100","Maipu","23");
INSERT INTO comunas VALUES("101","Macul","23");
INSERT INTO comunas VALUES("102","Lo Prado","23");
INSERT INTO comunas VALUES("103","Lo Espejo","23");
INSERT INTO comunas VALUES("104","Lo Barnechea","23");
INSERT INTO comunas VALUES("105","Las Condes","23");
INSERT INTO comunas VALUES("106","La Reina","23");
INSERT INTO comunas VALUES("107","La Pintana","23");
INSERT INTO comunas VALUES("108","La Granja","23");
INSERT INTO comunas VALUES("109","La Florida","23");
INSERT INTO comunas VALUES("110","La Cisterna","23");
INSERT INTO comunas VALUES("111","Independencia","23");
INSERT INTO comunas VALUES("112","Huechuraba","23");
INSERT INTO comunas VALUES("113","Estacion Central","23");
INSERT INTO comunas VALUES("114","El Bosque","23");
INSERT INTO comunas VALUES("115","Conchali","23");
INSERT INTO comunas VALUES("116","Cerro Navia","23");
INSERT INTO comunas VALUES("117","Cerrillos","23");
INSERT INTO comunas VALUES("118","Puente Alto","24");
INSERT INTO comunas VALUES("119","San Jose de Maipo","24");
INSERT INTO comunas VALUES("120","Pirque","24");
INSERT INTO comunas VALUES("121","San Bernardo","25");
INSERT INTO comunas VALUES("122","Buin","25");
INSERT INTO comunas VALUES("123","Paine","25");
INSERT INTO comunas VALUES("124","Calera de Tango","25");
INSERT INTO comunas VALUES("125","Melipilla","26");
INSERT INTO comunas VALUES("126","Alhue","26");
INSERT INTO comunas VALUES("127","Curacavi","26");
INSERT INTO comunas VALUES("128","Maria Pinto","26");
INSERT INTO comunas VALUES("129","San Pedro","26");
INSERT INTO comunas VALUES("130","Isla de Maipo","27");
INSERT INTO comunas VALUES("131","El Monte","27");
INSERT INTO comunas VALUES("132","Padre Hurtado","27");
INSERT INTO comunas VALUES("133","Peñaflor","27");
INSERT INTO comunas VALUES("134","Talagante","27");
INSERT INTO comunas VALUES("135","Codegua","28");
INSERT INTO comunas VALUES("136","Coinco","28");
INSERT INTO comunas VALUES("137","Coltauco","28");
INSERT INTO comunas VALUES("138","Doñihue","28");
INSERT INTO comunas VALUES("139","Graneros","28");
INSERT INTO comunas VALUES("140","Las Cabras","28");
INSERT INTO comunas VALUES("141","Machali","28");
INSERT INTO comunas VALUES("142","Malloa","28");
INSERT INTO comunas VALUES("143","Mostazal","28");
INSERT INTO comunas VALUES("144","Olivar","28");
INSERT INTO comunas VALUES("145","Peumo","28");
INSERT INTO comunas VALUES("146","Pichidegua","28");
INSERT INTO comunas VALUES("147","Quinta de Tilcoco","28");
INSERT INTO comunas VALUES("148","Rancagua","28");
INSERT INTO comunas VALUES("149","Rengo","28");
INSERT INTO comunas VALUES("150","Requinoa","28");
INSERT INTO comunas VALUES("151","San Vicente de Tagua Tagua","28");
INSERT INTO comunas VALUES("152","Chepica","29");
INSERT INTO comunas VALUES("153","Chimbarongo","29");
INSERT INTO comunas VALUES("154","Lolol","29");
INSERT INTO comunas VALUES("155","Nancagua","29");
INSERT INTO comunas VALUES("156","Palmilla","29");
INSERT INTO comunas VALUES("157","Peralillo","29");
INSERT INTO comunas VALUES("158","Placilla","29");
INSERT INTO comunas VALUES("159","Pumanque","29");
INSERT INTO comunas VALUES("160","San Fernando","29");
INSERT INTO comunas VALUES("161","Santa Cruz","29");
INSERT INTO comunas VALUES("162","La Estrella","30");
INSERT INTO comunas VALUES("163","Litueche","30");
INSERT INTO comunas VALUES("164","Marchigue","30");
INSERT INTO comunas VALUES("165","Navidad","30");
INSERT INTO comunas VALUES("166","Paredones","30");
INSERT INTO comunas VALUES("167","Pichilemu","30");
INSERT INTO comunas VALUES("168","Curico","31");
INSERT INTO comunas VALUES("169","Hualañe","31");
INSERT INTO comunas VALUES("170","Licanten","31");
INSERT INTO comunas VALUES("171","Molina","31");
INSERT INTO comunas VALUES("172","Rauco","31");
INSERT INTO comunas VALUES("173","Romeral","31");
INSERT INTO comunas VALUES("174","Sagrada Familia","31");
INSERT INTO comunas VALUES("175","Teno","31");
INSERT INTO comunas VALUES("176","Vichuquen","31");
INSERT INTO comunas VALUES("177","Talca","32");
INSERT INTO comunas VALUES("178","San Clemente","32");
INSERT INTO comunas VALUES("179","Pelarco","32");
INSERT INTO comunas VALUES("180","Pencahue","32");
INSERT INTO comunas VALUES("181","Maule","32");
INSERT INTO comunas VALUES("182","San Rafael","32");
INSERT INTO comunas VALUES("183","Curepto","33");
INSERT INTO comunas VALUES("184","Constitucion","32");
INSERT INTO comunas VALUES("185","Empedrado","32");
INSERT INTO comunas VALUES("186","Rio Claro","32");
INSERT INTO comunas VALUES("187","Linares","33");
INSERT INTO comunas VALUES("188","San Javier","33");
INSERT INTO comunas VALUES("189","Parral","33");
INSERT INTO comunas VALUES("190","Villa Alegre","33");
INSERT INTO comunas VALUES("191","Longavi","33");
INSERT INTO comunas VALUES("192","Colbun","33");
INSERT INTO comunas VALUES("193","Retiro","33");
INSERT INTO comunas VALUES("194","Yerbas Buenas","33");
INSERT INTO comunas VALUES("195","Cauquenes","34");
INSERT INTO comunas VALUES("196","Chanco","34");
INSERT INTO comunas VALUES("197","Pelluhue","34");
INSERT INTO comunas VALUES("198","Bulnes","35");
INSERT INTO comunas VALUES("199","Chillan","35");
INSERT INTO comunas VALUES("200","Chillan Viejo","35");
INSERT INTO comunas VALUES("201","El Carmen","35");
INSERT INTO comunas VALUES("202","Pemuco","35");
INSERT INTO comunas VALUES("203","Pinto","35");
INSERT INTO comunas VALUES("204","Quillon","35");
INSERT INTO comunas VALUES("205","San Ignacio","35");
INSERT INTO comunas VALUES("206","Yungay","35");
INSERT INTO comunas VALUES("207","Cobquecura","36");
INSERT INTO comunas VALUES("208","Coelemu","36");
INSERT INTO comunas VALUES("209","Ninhue","36");
INSERT INTO comunas VALUES("210","Portezuelo","36");
INSERT INTO comunas VALUES("211","Quirihue","36");
INSERT INTO comunas VALUES("212","Ranquil","36");
INSERT INTO comunas VALUES("213","Treguaco","36");
INSERT INTO comunas VALUES("214","San Carlos","37");
INSERT INTO comunas VALUES("215","Coihueco","37");
INSERT INTO comunas VALUES("216","San Nicolas","37");
INSERT INTO comunas VALUES("217","Ñiquen","37");
INSERT INTO comunas VALUES("218","San Fabian","37");
INSERT INTO comunas VALUES("219","Alto Biobio","38");
INSERT INTO comunas VALUES("220","Antuco","38");
INSERT INTO comunas VALUES("221","Cabrero","38");
INSERT INTO comunas VALUES("222","Laja","38");
INSERT INTO comunas VALUES("223","Los Angeles","38");
INSERT INTO comunas VALUES("224","Mulchen","38");
INSERT INTO comunas VALUES("225","Nacimiento","38");
INSERT INTO comunas VALUES("226","Negrete","38");
INSERT INTO comunas VALUES("227","Quilaco","38");
INSERT INTO comunas VALUES("228","Quilleco","38");
INSERT INTO comunas VALUES("229","San Rosendo","38");
INSERT INTO comunas VALUES("230","Santa Barbara","38");
INSERT INTO comunas VALUES("231","Tucapel","38");
INSERT INTO comunas VALUES("232","Yumbel","38");
INSERT INTO comunas VALUES("233","Concepcion","39");
INSERT INTO comunas VALUES("234","Coronel","39");
INSERT INTO comunas VALUES("235","Chiguayante","39");
INSERT INTO comunas VALUES("236","Florida","39");
INSERT INTO comunas VALUES("237","Hualpen","39");
INSERT INTO comunas VALUES("238","Hualqui","39");
INSERT INTO comunas VALUES("239","Lota","39");
INSERT INTO comunas VALUES("240","Penco","39");
INSERT INTO comunas VALUES("241","San Pedro de La Paz","39");
INSERT INTO comunas VALUES("242","Santa Juana","39");
INSERT INTO comunas VALUES("243","Talcahuano","39");
INSERT INTO comunas VALUES("244","Tome","39");
INSERT INTO comunas VALUES("245","Arauco","40");
INSERT INTO comunas VALUES("246","Cañete","40");
INSERT INTO comunas VALUES("247","Contulmo","40");
INSERT INTO comunas VALUES("248","Curanilahue","40");
INSERT INTO comunas VALUES("249","Lebu","40");
INSERT INTO comunas VALUES("250","Los Alamos","40");
INSERT INTO comunas VALUES("251","Tirua","40");
INSERT INTO comunas VALUES("252","Angol","41");
INSERT INTO comunas VALUES("253","Collipulli","41");
INSERT INTO comunas VALUES("254","Curacautin","41");
INSERT INTO comunas VALUES("255","Ercilla","41");
INSERT INTO comunas VALUES("256","Lonquimay","41");
INSERT INTO comunas VALUES("257","Los Sauces","41");
INSERT INTO comunas VALUES("258","Lumaco","41");
INSERT INTO comunas VALUES("259","Puren","41");
INSERT INTO comunas VALUES("260","Renaico","41");
INSERT INTO comunas VALUES("261","Traiguen","41");
INSERT INTO comunas VALUES("262","Victoria","41");
INSERT INTO comunas VALUES("263","Temuco","42");
INSERT INTO comunas VALUES("264","Carahue","42");
INSERT INTO comunas VALUES("265","Cholchol","42");
INSERT INTO comunas VALUES("266","Cunco","42");
INSERT INTO comunas VALUES("267","Curarrehue","42");
INSERT INTO comunas VALUES("268","Freire","42");
INSERT INTO comunas VALUES("269","Galvarino","42");
INSERT INTO comunas VALUES("270","Gorbea","42");
INSERT INTO comunas VALUES("271","Lautaro","42");
INSERT INTO comunas VALUES("272","Loncoche","42");
INSERT INTO comunas VALUES("273","Melipeuco","42");
INSERT INTO comunas VALUES("274","Nueva Imperial","42");
INSERT INTO comunas VALUES("275","Padre Las Casas","42");
INSERT INTO comunas VALUES("276","Perquenco","42");
INSERT INTO comunas VALUES("277","Pitrufquen","42");
INSERT INTO comunas VALUES("278","Pucon","42");
INSERT INTO comunas VALUES("279","Saavedra","42");
INSERT INTO comunas VALUES("280","Teodoro Schmidt","42");
INSERT INTO comunas VALUES("281","Tolten","42");
INSERT INTO comunas VALUES("282","Vilcun","42");
INSERT INTO comunas VALUES("283","Villarrica","42");
INSERT INTO comunas VALUES("284","Valdivia","43");
INSERT INTO comunas VALUES("285","Corral","43");
INSERT INTO comunas VALUES("286","Lanco","43");
INSERT INTO comunas VALUES("287","Los Lagos","43");
INSERT INTO comunas VALUES("288","Mafil","43");
INSERT INTO comunas VALUES("289","Mariquina","43");
INSERT INTO comunas VALUES("290","Paillaco","43");
INSERT INTO comunas VALUES("291","Panguipulli","43");
INSERT INTO comunas VALUES("292","La Union","44");
INSERT INTO comunas VALUES("293","Futrono","44");
INSERT INTO comunas VALUES("294","Lago Ranco","44");
INSERT INTO comunas VALUES("295","Rio Bueno","44");
INSERT INTO comunas VALUES("297","Osorno","45");
INSERT INTO comunas VALUES("298","Puerto Octay","45");
INSERT INTO comunas VALUES("299","Purranque","45");
INSERT INTO comunas VALUES("300","Puyehue","45");
INSERT INTO comunas VALUES("301","Rio Negro","45");
INSERT INTO comunas VALUES("302","San Juan de la Costa","45");
INSERT INTO comunas VALUES("303","San Pablo","45");
INSERT INTO comunas VALUES("304","Calbuco","46");
INSERT INTO comunas VALUES("305","Cochamo","46");
INSERT INTO comunas VALUES("306","Fresia","46");
INSERT INTO comunas VALUES("307","Frutillar","46");
INSERT INTO comunas VALUES("308","Llanquihue","46");
INSERT INTO comunas VALUES("309","Los Muermos","46");
INSERT INTO comunas VALUES("310","Maullin","46");
INSERT INTO comunas VALUES("311","Puerto Montt","46");
INSERT INTO comunas VALUES("312","Puerto Varas","46");
INSERT INTO comunas VALUES("313","Ancud","47");
INSERT INTO comunas VALUES("314","Castro","47");
INSERT INTO comunas VALUES("315","Chonchi","47");
INSERT INTO comunas VALUES("316","Curaco de Velez","47");
INSERT INTO comunas VALUES("317","Dalcahue","47");
INSERT INTO comunas VALUES("318","Puqueldon","47");
INSERT INTO comunas VALUES("319","Queilen","47");
INSERT INTO comunas VALUES("320","Quellon","47");
INSERT INTO comunas VALUES("321","Quemchi","47");
INSERT INTO comunas VALUES("322","Quinchao","47");
INSERT INTO comunas VALUES("323","Chaiten","48");
INSERT INTO comunas VALUES("324","Futaleufu","48");
INSERT INTO comunas VALUES("325","Hualaihue","48");
INSERT INTO comunas VALUES("326","Palena","48");
INSERT INTO comunas VALUES("327","Lago Verde","49");
INSERT INTO comunas VALUES("328","Coihaique","49");
INSERT INTO comunas VALUES("329","Aysen","50");
INSERT INTO comunas VALUES("330","Cisnes","50");
INSERT INTO comunas VALUES("331","Guaitecas","50");
INSERT INTO comunas VALUES("332","Rio Ibañez","51");
INSERT INTO comunas VALUES("333","Chile Chico","51");
INSERT INTO comunas VALUES("334","Cochrane","52");
INSERT INTO comunas VALUES("335","O'Higgins","52");
INSERT INTO comunas VALUES("336","Tortel","52");
INSERT INTO comunas VALUES("337","Natales","53");
INSERT INTO comunas VALUES("338","Torres del Paine","53");
INSERT INTO comunas VALUES("339","Laguna Blanca","54");
INSERT INTO comunas VALUES("340","Punta Arenas","54");
INSERT INTO comunas VALUES("341","Rio Verde","54");
INSERT INTO comunas VALUES("342","San Gregorio","54");
INSERT INTO comunas VALUES("343","Porvenir","55");
INSERT INTO comunas VALUES("344","Primavera","55");
INSERT INTO comunas VALUES("345","Timaukel","55");
INSERT INTO comunas VALUES("346","Cabo de Hornos","56");
INSERT INTO comunas VALUES("347","Antartica","56");


INSERT INTO detalle_recepciones VALUES("12","13","2","1672","318","3");
INSERT INTO detalle_recepciones VALUES("13","13","3","2101","399","2");
INSERT INTO detalle_recepciones VALUES("14","13","4","2521","479","3");
INSERT INTO detalle_recepciones VALUES("15","13","5","2101","399","5");
INSERT INTO detalle_recepciones VALUES("16","13","6","1261","239","5");
INSERT INTO detalle_recepciones VALUES("17","14","7","4202","798","3");
INSERT INTO detalle_recepciones VALUES("18","14","8","2521","479","4");
INSERT INTO detalle_recepciones VALUES("19","14","9","1261","239","3");
INSERT INTO detalle_recepciones VALUES("20","14","10","4202","798","4");
INSERT INTO detalle_recepciones VALUES("21","14","11","5042","958","7");

INSERT INTO detalle_ventas VALUES("3","3","7","1","8395","1595");
INSERT INTO detalle_ventas VALUES("4","4","7","1","8395","1595");

INSERT INTO grupospaginas VALUES("1","Ventas","fas fa-file-invoice-dollar","1");
INSERT INTO grupospaginas VALUES("2","Articulos","fas fa-boxes","2");
INSERT INTO grupospaginas VALUES("3","Proveedores","fas fa-truck","3");
INSERT INTO grupospaginas VALUES("4","Clientes","fas fa-user-friends","4");
INSERT INTO grupospaginas VALUES("5","Reportes","fas fa-signal","5");
INSERT INTO grupospaginas VALUES("6","Configuración","fas fa-cogs","6");

INSERT INTO medios_de_pago VALUES("1","Efectivo");
INSERT INTO medios_de_pago VALUES("2","Debito");
INSERT INTO medios_de_pago VALUES("3","Credito");
INSERT INTO medios_de_pago VALUES("4","Transferencia");

INSERT INTO movimientos_articulos VALUES("14","2","1","3","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("15","3","1","2","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("16","4","1","3","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("17","5","1","5","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("18","6","1","5","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("19","7","1","3","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("20","8","1","4","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("21","9","1","3","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("22","10","1","4","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("23","11","1","7","2021-07-17","1");
INSERT INTO movimientos_articulos VALUES("24","7","2","-1","2021-10-26","1");
INSERT INTO movimientos_articulos VALUES("25","7","2","-1","2021-10-26","1");

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

INSERT INTO proveedores VALUES("66666666-6","proveedor generico","generico","itata 351","204","35","10","994679847","danilo.cid.v@gmail.com");

INSERT INTO provincias VALUES("1","Arica","1");
INSERT INTO provincias VALUES("2","Parinacota","1");
INSERT INTO provincias VALUES("3","Iquique","2");
INSERT INTO provincias VALUES("4","El Tamarugal","2");
INSERT INTO provincias VALUES("5","Tocopilla","3");
INSERT INTO provincias VALUES("6","El Loa","3");
INSERT INTO provincias VALUES("7","Antofagasta","3");
INSERT INTO provincias VALUES("8","Chañaral","4");
INSERT INTO provincias VALUES("9","Copiapo","4");
INSERT INTO provincias VALUES("10","Huasco","4");
INSERT INTO provincias VALUES("11","Elqui","5");
INSERT INTO provincias VALUES("12","Limari
","5");
INSERT INTO provincias VALUES("13","Choapa","5");
INSERT INTO provincias VALUES("14","Petorca","6");
INSERT INTO provincias VALUES("15","Los Andes","6");
INSERT INTO provincias VALUES("16","San Felipe de Aconcagua","6");
INSERT INTO provincias VALUES("17","Quillota","6");
INSERT INTO provincias VALUES("18","Valparaiso","6");
INSERT INTO provincias VALUES("19","San Antonio","6");
INSERT INTO provincias VALUES("20","Isla de Pascua","6");
INSERT INTO provincias VALUES("21","Marga Marga","6");
INSERT INTO provincias VALUES("22","Chacabuco","7");
INSERT INTO provincias VALUES("23","Santiago","7");
INSERT INTO provincias VALUES("24","Cordillera","7");
INSERT INTO provincias VALUES("25","Maipo","7");
INSERT INTO provincias VALUES("26","Melipilla","7");
INSERT INTO provincias VALUES("27","Talagante","7");
INSERT INTO provincias VALUES("28","Cachapoal","8");
INSERT INTO provincias VALUES("29","Colchagua","8");
INSERT INTO provincias VALUES("30","Cardenal Caro","8");
INSERT INTO provincias VALUES("31","Curico","9");
INSERT INTO provincias VALUES("32","Talca","9");
INSERT INTO provincias VALUES("33","Linares","9");
INSERT INTO provincias VALUES("34","Cauquenes","9");
INSERT INTO provincias VALUES("35","Diguillin","10");
INSERT INTO provincias VALUES("36","Itata","10");
INSERT INTO provincias VALUES("37","Punilla","10");
INSERT INTO provincias VALUES("38","Bio Bio","11");
INSERT INTO provincias VALUES("39","Concepcion","11");
INSERT INTO provincias VALUES("40","Arauco","11");
INSERT INTO provincias VALUES("41","Malleco","12");
INSERT INTO provincias VALUES("42","Cautin","12");
INSERT INTO provincias VALUES("43","Valdivia","13");
INSERT INTO provincias VALUES("44","Ranco","13");
INSERT INTO provincias VALUES("45","Osorno","14");
INSERT INTO provincias VALUES("46","Llanquihue","14");
INSERT INTO provincias VALUES("47","Chiloe","14");
INSERT INTO provincias VALUES("48","Palena","14");
INSERT INTO provincias VALUES("49","Coyhaique","15");
INSERT INTO provincias VALUES("50","Aysen","15");
INSERT INTO provincias VALUES("51","General Carrera","15");
INSERT INTO provincias VALUES("52","Capitan Prat","15");
INSERT INTO provincias VALUES("53","Ultima Esperanza","16");
INSERT INTO provincias VALUES("54","Magallanes","16");
INSERT INTO provincias VALUES("55","Tierra del Fuego","16");
INSERT INTO provincias VALUES("56","Antartica Chilena","16");

INSERT INTO recepciones VALUES("13","66666666-6","1","50","33591","6379","18","recepcion inicial","2021-07-17","1");
INSERT INTO recepciones VALUES("14","66666666-6","2","52","78575","14925","21","recepcion inicial2","2021-07-17","1");

INSERT INTO regiones VALUES("1","Arica y Parinacota");
INSERT INTO regiones VALUES("2","Tarapac");
INSERT INTO regiones VALUES("3","Antofagasta");
INSERT INTO regiones VALUES("4","Atacama");
INSERT INTO regiones VALUES("5","Coquimbo");
INSERT INTO regiones VALUES("6","Valparaiso");
INSERT INTO regiones VALUES("7","Metropolitana de Santiago");
INSERT INTO regiones VALUES("8","Libertador General Bernardo O'Higgins");
INSERT INTO regiones VALUES("9","Maule");
INSERT INTO regiones VALUES("10","Ñuble");
INSERT INTO regiones VALUES("11","Biobio");
INSERT INTO regiones VALUES("12","La Araucania");
INSERT INTO regiones VALUES("13","Los Rios");
INSERT INTO regiones VALUES("14","Los Lagos");
INSERT INTO regiones VALUES("15","Aysen del General Carlos Ibañez del Campo");
INSERT INTO regiones VALUES("16","Magallanes y de la Antartica Chilena");

INSERT INTO tipo_documento VALUES("30","Factura electronica");
INSERT INTO tipo_documento VALUES("34","Factura exenta");
INSERT INTO tipo_documento VALUES("35","Boleta");
INSERT INTO tipo_documento VALUES("38","Boleta Exenta");
INSERT INTO tipo_documento VALUES("39","Boleta electronica");
INSERT INTO tipo_documento VALUES("41","Boleta exenta electronica");
INSERT INTO tipo_documento VALUES("50","Guia de despacho");
INSERT INTO tipo_documento VALUES("52","Guia de despacho electronica");
INSERT INTO tipo_documento VALUES("60","Nota de credito");
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

INSERT INTO ventas VALUES("3","8395","1595","39","1","111111-1","4","2021-10-26","1");
INSERT INTO ventas VALUES("4","8395","1595","39","2","111111-1","1","2021-10-26","1");

