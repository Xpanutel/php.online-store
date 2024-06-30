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
		<?php if($_SESSION['login'] !== 'admin') { ?>
			<div class="content">
				<h1 class="profile_welcome__title">Welcome to the private office!</h1>
				<h3 class="profile_user__data">Your login =  <?= $row['login'] ?></h3>
				<h3 class="profile_user__data">Your email =  <?= $row['email'] ?></h3>
			  <form action="" method="post">
			    <input type="submit" name="clearAut" value='Log out' class="profile_logout__button">
			  </form>
			</div>
		<?php } else { ?>
			<div class="content">
				<h1 class="profile_welcome__title">Weclome back, admin!</h1>
				<form action="" method="post">
			    	<input type="submit" name="clearAut" value='Log out' class="profile_logout__button">
			  	</form>
			</div>
		<?php }	?>
		<?php include './components/footer.php'; ?>
	</body>
	</html>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_SESSION['login'] = '';
		$_SESSION['auth'] = false;
		header('location: login.php');
	}
} else {
	header('location: login.php');
}
?>

