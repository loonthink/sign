# DCL（Data Control Language）数据库控制语言  授权，角色控制等

# DTL（Data Transaction Language)  数据事务语言 

# DDL（Data Definition Language）数据库定义语言

# DQL (数据查询语言)关键字：selet 

# DML（Data Manipulation Language）数据操纵语言
#	1) 插入：INSERT
#	2) 更新：UPDATE
#	3) 删除：DELETE

# 删除表 DROP TABLE TABLE_NAME
# 清空表 truncate table table_name;
#       delete from table_name;

create database sign;

use sign;

alter database sign character set utf8;

create table if not exists sign_user (
	`id` int primary key PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(10) NOT NULL,
	`password` varchar(10) NOT NULL,
	`is_admin` tinyint NOT NULL DEFAULT 0
) DEFAULT CHARSET = UTF8;

insert into sign_user (name, password) values ('zhang','zf888888');

create table if not exists sign_time (
	`id` int primary key AUTO_INCREMENT,
	`user_id` int not null,
	`month` varchar(10) not null,
	`reason` varchar(30) default '无',
	`date` date not null,
	`startTime` time DEFAULT null,
	`endTime` time DEFAULT null,
	`overTime` int DEFAULT 0,
	`meal_money` int DEFAULT 18
) DEFAULT CHARSET = UTF8;