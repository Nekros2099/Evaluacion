
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `idmenus` int(11) NOT NULL AUTO_INCREMENT,
  `mn_name` varchar(45) DEFAULT NULL,
  `mn_descrip` varchar(45) DEFAULT NULL,
  `mn_depen` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmenus`),
  UNIQUE KEY `idmenus_UNIQUE` (`idmenus`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `menus` WRITE;
INSERT INTO `menus` VALUES (1,'Catalogos','Listado de catalogos',NULL),(2,'Tipos de archivo','Catalogo de archivos',1),(3,'Profesiones','Listado de profesiones',1),(4,'Marcas','Listado de marcas de autos',NULL);
UNLOCK TABLES;
