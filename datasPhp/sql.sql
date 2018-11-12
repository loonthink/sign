create database sign;

use sign;

alter database sign character set utf8;

create table if not exists sign_user (
	`id` int primary key PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(10) NOT NULL,
	`password` varchar(10) NOT NULL,
	`is_admin` tinyint NOT NULL DEFAULT 0
) DEFAULT CHARSET = UTF8;