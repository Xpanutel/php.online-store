<?php session_start();
include 'db_config.php';
// если у нас логин = admin, то показываем содержимое
if (isset($_SESSION['login']) && $_SESSION['login'] === 'admin') { ?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin panel</title>
		<style>
			html,
			body {
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

			.admin_name {
				width: 70%;
				padding: 10px;
				margin-bottom: 10px;
				border: 1px solid #ccc;
				border-radius: 5px;
			}

			.admin_pame {
				width: 70%;
				padding: 10px;
				margin-bottom: 10px;
				border: 1px solid #ccc;
				border-radius: 5px;
			}

			.admin_image {
				width: 70%;
				padding: 10px;
				margin-bottom: 10px;
				border: 1px solid #ccc;
				border-radius: 5px;
				background-color: #f9f9f9;
			}

			.admin_btn {
				width: 70%;
				padding: 10px;
				background-color: #007bff;
				color: #fff;
				border: none;
				border-radius: 5px;
				cursor: pointer;
			}
		</style>
	</head>

	<body>
		<?php include './components/header.php'; ?>
		<!-- <?php include './php/addProduct.php'; ?> -->
		<div class="content">
			<form action="./php/addProduct.php" method="post" enctype="multipart/form-data">
				<input class="admin_name" type="text" placeholder="название товара" name="name">
				<textarea class="admin_pame" type="text" placeholder="описание товара" name="pame"></textarea>
				<input class="admin_image" type="file" name="image" name="image" accept="image/ * ">
				<h3><?= $error ?></h3>
				<h3><?= $suc ?></h3>
				<input class="admin_btn" type="submit" placeholder="Готово!">
			</form>
		</div>
		<?php include './components/footer.php'; ?>
	</body>

	</html>
<?php } else {
	header('location: index.php');
} ?>