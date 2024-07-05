<?php
session_start();
if (!isset($_SESSION['auth'])) {
    session_regenerate_id(true);
    $_SESSION['auth'] = false;
}

if ($_SESSION['auth'] === false) { ?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Guardians of Dreams Shop | Authorization</title>
		<link rel="stylesheet" href="/css/styles.css">
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
		<?php include './php/loginUser.php'; ?>
		<div class="content">
			<h1>Welcome to the authorization page!</h1>
			<h1>Fill out the form below and click the "Sign in" button</h1>
			<form action="" method="post">
				<input type="text" name="login" placeholder="Your login or your email">
				<input type="password" name="pass" placeholder="Your password">
				<input type="hidden" name="token" value="<?php echo md5(uniqid(rand(), true)); ?>">
				<h3><?= $error ?></h3>
			  <input type="submit" value="Sign in">
			</form>
		</div>
		<?php include './components/footer.php'; ?>
	</body>
	</html>

<?php } else {
    header('Location: profile.php');
    exit;
}
?>