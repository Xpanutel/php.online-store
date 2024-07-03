create database store;
use store;

create table users (
  id int(15) auto_increment primary key not null,
  login varchar(150) not null,
  email varchar(150) not null,
  password varchar(150) not null
);

create table product (
	id int(15) auto_increment primary key not null,
	name varchar(150) not null,
	pame varchar(255) not null,
	image varchar(255) not null
);

create table user_cart (
	id int auto_increment primary key,
	user_id int(15) not null,
	product_id int(15) not null,
	foreign key (user_id) references users(id),
	foreign key (product_id) references product(id)
);
