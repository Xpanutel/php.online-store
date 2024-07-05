<?php 
session_start();
include '../db_config.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$login = $_POST['login'] ?? '';
		$email = $_POST['email'] ?? '';
		$pass = $_POST['pass'] ?? '';
		$sucpass = $_POST['sucpass'] ?? '';

		if (empty($login) || empty($email) || empty($pass) || empty($sucpass)) {
			$error = "Необходимо заполнить все поля!";
			return;
		}

		if($pass !== $sucpass) {
			$error = "Введенные вами пароли не совпадают!";
			return;
		}

		$stmt = $link->prepare("SELECT COUNT( * ) AS user_count FROM users WHERE login = ? or email = ?");
		$stmt->bind_param('ss', $login, $email);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		if ($row['user_count'] > 0) {
			$error = "Пользователь с таким логином или почтой уже существует!";
		} else {
			$stmt = $link->prepare("INSERT INTO users (login, email, password) VALUES (?, ?, ?)");
			$stmt->bind_param('sss', $login, $email, $pass);

			if($stmt->execute()) {
				$_SESSION['auth'] = true;
				$_SESSION['login'] = $login;
				$stmt->close();
				$link->close();
				header('location: ../profile.php');
			} else {
				$error = "Произошла ошибка при регистрации";
			}
		}
	} 