<?php
session_start();

if (!isset($_SESSION)) {
    session_regenerate_id(true);
    $_SESSION['auth'] = false;
}

$error = '';

if ($_SESSION['auth'] === false) { ?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Guardians of Dreams Shop | Registration</title>
	  <link rel="stylesheet" type="text/css" href="/css/styles.css">
	  <link rel="stylesheet" href="./css/container.css">
	</head>
	<body>
		<?php include './components/header.php'; ?>
		<div class="content">
			<h1>Welcome to the account registration page!</h1>
			<h1>Fill out the form below and click the "Sign up" button</h1>
		  <form action="./php/registerUser.php" method="post">
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
