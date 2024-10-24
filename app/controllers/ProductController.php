<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Product.php'; 
class ProductController {
    private $productModel;

    public function __construct($db) {
        $this->productModel = new Product($db);
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/products.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $pame = $_POST['pame'];
            $price = $_POST['price'];

            if ($this->productModel->addProduct($name, $pame, $price)) {
                header('Location: /products'); 
            } else {
                die("Ошибка добавления товара."); 
            }
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/addProduct.php';
        }
    }

    // public function edit($id) {
    //     $product = $this->productModel->getProductById($id);
    //     require_once 'views/products/edit.php';
    // }

    public function update($params) {
        $id = $params['id'];
        $product = $this->productModel->getProductById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $pame = $_POST['pame'];
            $price = $_POST['price'];

            if ($this->productModel->updateProduct($id, $name, $pame, $price)) {
                header('Location: /products'); 
            } else {
                die("Ошибка обновления товара."); 
            }
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/editProduct.php';
        }
    }

    public function delete($id) {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /products'); 
        } else {
            die("Ошибка удаления товара."); 
        }
    }
}
