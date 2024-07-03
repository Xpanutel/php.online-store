<?php 
session_start();
include '/OSPanel/domains/localhost/db_config.php';
// если у нас логин = admin, то показываем содержимое
if (isset($_SESSION['login']) && $_SESSION['login'] === 'admin') {
	$error = '';
	$suc = '';
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// создаем переменные для получения значения с формы
		$name = $_POST['name'];
		$pame = $_POST['pame'];

		if (empty($name) || empty($pame)) {
			$error = "Все поля должны быть заполнены";
			return;
		}
		// подготавливаем запрос для отправки данных в бд
		$stmt = $link->prepare("INSERT INTO product (name, pame, image) VALUES (?, ?, ?);");
		$stmt->bind_param('sss', $name, $pame, $_FILES['image']['name']);

    $filePath = $_SERVER['DOCUMENT_ROOT'];
		// сохраняем файлв в папке "temp"
		if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath . '\\temp\\' . $_FILES['image']['name'])) {
			$suc = "Файл успешно загружен";
			// отправляем запрос в базу данных
			$stmt->execute();
		} else {
			$error = "Ошибка при загрузи файла";
		}
	}
}  
header('location: /admin.php');