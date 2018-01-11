create table prodKeyfeature
(
 pid bigint unsigned,
 description varchar(1000),
 keyfeature varchar(1000),
 PRIMARY KEY (pid),
 constraint pkf foreign key(pid) references products(pid) on delete cascade
 )engine=innodb;