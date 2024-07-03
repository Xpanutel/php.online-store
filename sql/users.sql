create table users (
  id int(15) auto_increment primary key not null,
  login varchar(150) not null,
  email varchar(150) not null,
  password varchar(150) not null
);