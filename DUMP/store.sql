create database store;
use store;

create table users (
  id int(15) auto_increment primary key not null,
  login varchar(150) not null,
  email varchar(150) not null,
  password varchar(150) not null,
  role varchar(30) not null default 'user'
);

INSERT INTO users (login, email, password, role) VALUES 
('admin', 'admin@example.com', 'admin123', 'admin'),
('ivanov', 'ivan@mail.ru', 'ivan123'),
('petrova', 'anna@yandex.ru', 'anna123'); 

create table products (
	id int(15) auto_increment primary key not null,
	name varchar(150) not null,
	pame varchar(255) not null,
	image varchar(255) not null,
	price int not null
);

INSERT INTO products (name, pame, image, price) VALUES 
('Ноутбук Acer Aspire 5', 
'Бюджетный ноутбук для работы и учебы, 15.6" экран, Intel Core i3, 8 ГБ ОЗУ, 256 ГБ SSD', 
'изображение_ноутбука_acer.jpg', 40000),

('Смартфон Samsung Galaxy A53', 
'Сбалансированный смартфон с AMOLED экраном, 6.5", 6 ГБ ОЗУ, 128 ГБ памяти, камера 64 Мп', 
'изображение_телефона_samsung.jpg', 25000),

('Планшет Apple iPad 9', 
'Планшет с ярким дисплеем 10.2", мощным процессором A13 Bionic, 64 ГБ памяти', 
'изображение_планшета_apple.jpg', 35000);

create table user_cart (
	id int auto_increment primary key,
	user_id int(15) not null,
	product_id int(15) not null,
	foreign key (user_id) references users(id),
	foreign key (product_id) references products(id)
);
