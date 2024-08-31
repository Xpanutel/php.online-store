<?php 
session_start();
include '../config/db_config.php';
include '../auth/auth.php';
checkAuth('admin');

class ProductManager {
	private $link;
	private $filePath;

	public function __constructor($link) {
		$this->$link = $link;
		$this->$filePath = $_SERVER['DOCUMENT_ROOT'];
	}

	public function addProduct($name, $pame, $image, $price) {
		$suc = '';
		$error = '';

		if (empty($name) || empty($pame) || empty($image) || empty($price)) {
			$error = "Все поля должны быть заполнены";
			return ['success' => false, 'error' => $error];;
		}

		$stmt = $link->prepare('INSERT INTO product (name, pame, image, price) VALUES (?, ?, ?, ?)');
		$stmt->bind_param('sssi', $name, $pame, $_FILES['image']['name'], $price);

		if (move_uploaded_file($image['tmp_name'], $this->filePath . '\\temp\\' . $image['name'])) {
            $suc = "Файл успешно загружен";
            $stmt->execute();
            return ['success' => true, 'message' => $suc];
        } else {
            $error = "Ошибка при загрузке файла";
            return ['success' => false, 'error' => $error];
        }
	}
}

$suc = '';
$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$pame = $_POST['pame'];
	$price = $_POST['price'];
	$image = $_FILES['image'];

	$productManage = new ProductManager($link);
	$result = $productManage->addProduct($name, $pame, $image, $price);

	if ($result['success']) {
        $suc = $result['message'];
    } else {
        $error = $result['error'];
    }
}

header('location: /admin.php');