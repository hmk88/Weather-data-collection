/*DROP TABLE IF EXISTS `data`;*/
CREATE TABLE `data1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Wind_direction` varchar(45) DEFAULT NULL,
  `Wind_speed` varchar(45) DEFAULT NULL,
  `Temperature` varchar(45) DEFAULT NULL,
  `Humidity` varchar(45) DEFAULT NULL,
  `Pressure` varchar(45) DEFAULT NULL,
  `Rain_accumulator` varchar(45) DEFAULT NULL,
  `Heating_temperature` varchar(45) DEFAULT NULL,
  `Heating_voltage` varchar(45) DEFAULT NULL,
  `Date` varchar(45) DEFAULT NULL,
  `Time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

