create database RegLogin;
use RegLogin;

create table user(
	id int not null auto_increment primary key,
	fullname varchar(500) not null,
	username varchar(100) not null unique,
	email varchar(255) not null unique,
	password varchar(255) not null,
	created_at datetime not null
);

create table tblreseteopass (
id int(10) unsigned NOT NULL AUTO_INCREMENT,
idusuario int(10) unsigned NOT NULL,
username varchar(15) NOT NULL,
token varchar(64) NOT NULL,
creado timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (id),
UNIQUE KEY idusuario (idusuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
