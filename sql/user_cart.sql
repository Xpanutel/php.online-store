create table user_cart (
	id int auto_increment primary key,
	user_id int(15) not null,
	product_id int(15) not null,
	foreign key (user_id) references users(id),
	foreign key (product_id) references product(id)
);
