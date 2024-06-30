<?php
session_start();
if (!isset($_SESSION)) {
    session_regenerate_id(true);
    $_SESSION['auth'] = false;
}

if ($_SESSION['auth'] === false) { ?>
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
		    <input type="hidden" name="token" value="<?php echo md5(uniqid(rand(), true)); ?>">
		    <input type="submit" value="Sign up">
		  </form>
		 </div>
	  <?php include './components/footer.php'; ?>
	</body>
	</html>
	<?php
	include 'db_config.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$login = $_POST['login'] ?? '';
		$email = $_POST['email'] ?? '';
		$pass = $_POST['pass'] ?? '';
		$sucpass = $_POST['sucpass'] ?? '';

		if (empty($login) || empty($email) || empty($pass) || empty($sucpass)) {
			echo "Необходимо заполнить все поля!";
			return;
		}

		if($pass !== $sucpass) {
			echo "Введенные вами пароли не совпадают!";
			return;
		}

		$stmt = $link->prepare("SELECT COUNT( * ) AS user_count FROM users WHERE login = ?");
		$stmt->bind_param('s', $login);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		if ($row['user_count'] > 0) {
			echo "Пользователь с таким логином уже существует!";
		} else {
			$stmt = $link->prepare("INSERT INTO users (login, email, password) VALUES (?, ?, ?)");
			$stmt->bind_param('sss', $login, $email, $pass);

			if($stmt->execute()) {
				echo "Поздравляем с успешной регистрацией!";
				header('location: profile.php');
				$_SESSION['auth'] = true;
				$_SESSION['login'] = $login;
				$stmt->close();
				$link->close();
			} else {
				echo "Произошла ошибка при регистрации";
			}
		}
	}
} else {
	header('location: profile.php');
	exit;
}
?>
