create table prodImage
(
 pid bigint unsigned,
 imageName varchar(1000),
 addedon int unsigned,
 PRIMARY KEY (pid,addedon),
 constraint pik foreign key(pid) references products(pid) on delete cascade
 )engine=innodb;