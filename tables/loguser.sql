CREATE TABLE loguser (
  uid bigint(20) unsigned auto_increment,
  email varchar(300) DEFAULT NULL,
  upass varchar(300) DEFAULT NULL,
  shipping varchar(1000) ,
  billing varchar(1000),
  logtime varchar(15),
  phone varchar(15),
  status tinyint,
  PRIMARY KEY (uid)
) ENGINE=InnoDB;