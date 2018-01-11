create table prodFeature
(
 pid bigint unsigned,
 addedon int unsigned,
 title varchar(300),
 feature varchar(1000),
 PRIMARY KEY (pid,addedon),
 constraint pft foreign key(pid) references products(pid) on delete cascade
 )engine=innodb;