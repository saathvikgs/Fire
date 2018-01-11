CREATE TABLE slids (
  sid int unsigned NOT NULL DEFAULT '0',
  heading varchar(200),
  sub varchar(200),
  link varchar(500),
  img varchar(500),
  PRIMARY KEY (sid)
) ENGINE=InnoDB;