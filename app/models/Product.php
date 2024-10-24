<?php

class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addProduct($name, $description, $price) {
        $sql = "INSERT INTO products (name, pame, image, price) VALUES (?, ?, 'hello world', ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $name, $description, $price); 
        
        $result = $stmt->execute();
        $stmt->close(); 
        return $result;
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id); 

        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc(); 
        $stmt->close(); 
        return $result;
    }

    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT * FROM products"); 
        if (!$stmt) {
            die('Ошибка prepare: ' . $this->db->error);
        }
        $stmt->execute();
        if (!$stmt) {
            die('Ошибка prepare: ' . $this->db->error);
        }
        
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }

    public function updateProduct($id, $name, $pame, $price) {
        $sql = "UPDATE products SET name = ?, pame = ?, price = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssdi", $name, $pame, $price, $id);
        
        $result = $stmt->execute();
        $stmt->close(); 
        return $result;
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id); 

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
