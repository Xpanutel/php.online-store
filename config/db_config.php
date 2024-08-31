<?php
	$host = 'localhost'; // имя хоста
	$user = 'root';      // имя пользователя
	$pass = '';          // пароль
	$name = 'store';     // имя базы данных

	// $link = new mysqli_connect($host, $user, $pass, $name);
	$link = new mysqli($host, $user, $pass, $name);
?>