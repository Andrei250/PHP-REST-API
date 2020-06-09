# PHP-REST-API

Simple PHP CRUD API for my internship interview at 2checkout Bucharest. 
I do not customize it a lot, because the job I applied for is back-end developer.

Configuration:
	In /includes/config.php and /includes/db.php you have to change the DB name for  products (config.php) and for users (db.php)
	In /core/initialize.php you have to change the path for the project directory  :
		SITE_ROOT is the path for the project directory ( EX: /homne/user/Documents/RESTApi  is DS.'home'.DS.'user'.DS.'Documents'.DS.'RESTApi')
		INC_PATH is the path for includes directory
		CORE_PATH is the path for core directory

	You have to change the define() for SITE_ROOT.
Used databse: MySQL.
I also used PHP 7.2 and Linux Ubuntu.

DB for products has the following fields: id, name, price, category, created_date, updated_date
DB for users has the following fields: id, name, password, created_at

create table <dbName>.products
(
    id           int auto_increment
        primary key,
    name         varchar(256) not null,
    price        int          not null,
    category     varchar(256) null,
    created_date date         not null,
    updated_date date         not null
);

create table <dbName>.users
(
    id         int auto_increment
        primary key,
    name       varchar(50)                        not null,
    password   varchar(256)                       not null,
    created_at datetime default CURRENT_TIMESTAMP not null,
    constraint table_name_name_uindex
        unique (name)
);

