
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `contient`
-- ----------------------------
DROP TABLE IF EXISTS `CONTIENT`;
CREATE TABLE ernoult4u_inventaire.`CONTIENT` (
  `num_salle` varchar(5) NOT NULL,
  `id_equipt` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  PRIMARY KEY (`num_salle`,`id_equipt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `salle`
-- ----------------------------
DROP TABLE IF EXISTS `SALLE`;
CREATE TABLE ernoult4u_inventaire.`SALLE` (
  `num_salle` varchar(5) NOT NULL,
  `lib_salle` varchar(30) DEFAULT NULL,
  `etage` varchar(5) NOT NULL,
  PRIMARY KEY (`num_salle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `type_equipt`
-- ----------------------------
DROP TABLE IF EXISTS `TYPE_EQUIPT`;
CREATE TABLE ernoult4u_inventaire.`TYPE_EQUIPT` (
  `id_equipt` int(11) NOT NULL AUTO_INCREMENT,
  `lib_equipt` varchar(30) NOT NULL,
  `commentaire` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_equipt`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `CONTIENT` VALUES ('F39','1','16'), ('F39','2','1'), ('F39','4','12'), ('F39','5','1'), ('F39','9','16'), ('F39','10','16'), ('F39','11','16');
INSERT INTO `SALLE` VALUES ('B01',NULL,'RdC'), ('AA','Amphithéâtre A','RdC'), ('AB','Amphithéâtre B','RdC'), ('B09',NULL,'RdC'), ('C05',NULL,'RdC'), ('B16','Labo de langue','1'), ('F13','machine PC','1'), ('E23',NULL,'2'), ('C14',NULL,'1'), ('E36',NULL,'3'), ('F39','machine PC','3'), ('E27',NULL,'2');
INSERT INTO `TYPE_EQUIPT` VALUES ('1','chaise',NULL), ('2','bureau',NULL), ('3','table simple',NULL), ('4','table double',NULL), ('5','vidéo-projecteur',NULL), ('6','tableau VP','spécialement conçu pour VP'), ('7','tableau blanc',NULL), ('8','tableau craie',NULL), ('9','ordinateur',NULL), ('10','souris',NULL), ('11','clavier',NULL), ('12','téléviseur',NULL);
