<?php
session_start();
if($_SESSION['auth'] == true) {
	include 'db_config.php';
	$stmt = $link->prepare("SELECT * FROM users WHERE login = ? OR email= ?");
	$stmt->bind_param('ss', $_SESSION['login'], $_SESSION['login']);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Guardians of Dreams Shop | Profile</title>
	</head>
	<body>
		<h1>Welcome to the private office!</h1>
		<h3>Your login =  <?= $row['login'] ?></h3>
		<h3>Your email =  <?= $row['email'] ?></h3>
		<form action="" method="post">
			<input type="submit" name="clearAut" value='Очистить auth'>
		</form>
	</body>
	</html>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_SESSION['login'] = '';
		$_SESSION['auth'] = false;
	}
} else {
	header('location: register.php');
}
?>

