<?php
session_start();

if (!isset($_SESSION)) {
    session_regenerate_id(true);
    $_SESSION['auth'] = false;
}

$error = '';

if ($_SESSION['auth'] === false) {
	include 'db_config.php';
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
				header('location: profile.php');
			} else {
				$error = "Произошла ошибка при регистрации";
			}
		}
	} ?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Guardians of Dreams Shop | Registration</title>
	  <link rel="stylesheet" type="text/css" href="/css/styles.css">
	  <style>
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }

        body {
          display: flex;
          flex-direction: column;
        }

        .content {
          flex: 1;
          padding: 20px;
          background: #f7f7f7;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
          border-radius: 5px;
          text-align: center;
        }
     </style>
	</head>
	<body>
		<?php include './components/header.php'; ?>
		<div class="content">
			<h1>Welcome to the account registration page!</h1>
			<h1>Fill out the form below and click the "Sign up" button</h1>
		  <form action="" method="post">
		    <input type="text" name="login" placeholder="Your login"><br/>
		    <input type="text" name="email" placeholder="Your email"><br/>
		    <input type="password" name="pass" placeholder="Your password"><br/>
		    <input type="password" name="sucpass" placeholder="Password verification"><br/>
		    <h3><?= $error ?></h3>
		    <input type="submit" value="Sign up">
		  </form>
		 </div>
	  <?php include './components/footer.php'; ?>
	</body>
	</html>

<?php } else {
	header('location: profile.php');
	exit;
}
?>
