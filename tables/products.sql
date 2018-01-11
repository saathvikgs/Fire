CREATE TABLE `products` (
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `pname` varchar(300) DEFAULT NULL,
  `mname` varchar(300) DEFAULT NULL,
  `category` tinyint(4) DEFAULT NULL,
  `seller` varchar(300) DEFAULT NULL,
  `stock` tinyint(4) DEFAULT NULL,
  `numStock` int(10) unsigned DEFAULT NULL,
  `price` mediumint(8) unsigned DEFAULT NULL,
  `displayImage` varchar(1000) DEFAULT NULL,
  `addedon` int unsigned,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB;