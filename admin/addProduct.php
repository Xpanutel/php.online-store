<?php 
session_start();
include '../config/db_config.php';
include '../auth/auth.php';
checkAuth('admin');

class ProductManager {
    private $link;
    private $filePath;

    public function __construct($link) {
        $this->link = $link;
        $this->filePath = $_SERVER['DOCUMENT_ROOT'];
    }

    public function addProduct($name, $pame, $price, $image) {
        $suc = '';
        $error = '';

        if (empty($name) || empty($pame) || empty($image) || empty($price)) {
            $error = "Все поля должны быть заполнены";
            return ['success' => false, 'error' => $error];
        }

        $stmt = $this->link->prepare('INSERT INTO product (name, pame, price, image) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssis', $name, $pame, $price, $image['name']);

        if (move_uploaded_file($image['tmp_name'], $this->filePath . '/temp/' . $image['name'])) {
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $pame = $_POST['pame'];
    $price = $_POST['price'];
    $image = $_FILES['image'];

    $link = new mysqli('localhost', 'root', '', 'store');

    if ($link->connect_error) {
        die('Ошибка соединения: ' . $link->connect_error);
    }

    $productManager = new ProductManager($link);
    $result = $productManager->addProduct($name, $pame, $price, $image);

    if ($result['success']) {
        $suc = $result['message'];
    } else {
        $error = $result['error'];
    }
}

header('location: admin_panel.php');
