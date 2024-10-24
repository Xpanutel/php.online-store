<?php

class Admin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllAdmins() {
        $stmt = $this->db->prepare("SELECT id, login FROM users WHERE role = 'admin'");
        $stmt->execute();
        if (!$stmt->execute()) {
            die('Ошибка выполнения запроса: ' . $stmt->error);
        }
        $result = $stmt->get_result();
        $admins = []; 
        while ($row = $result->fetch_assoc()) {
            // Создаем массив для каждого администратора:
            $admin = [
                'login' => $row['login'],
            ]; 
            $admins[] = $admin; // Добавляем массив $admin в $admins
        }

        return $admins; 
    }

    public function updateAdminRole($userLogin) {
        if (!is_string($userLogin)) {
            throw new InvalidArgumentException("Логин пользователя должен быть строкой."); 
        }
        $stmt = $this->db->prepare("UPDATE users SET role = 'admin' WHERE login = ?");
    
        if (!$stmt) {
            throw new \Exception("Ошибка подготовки запроса: " . $this->db->error); 
        }
        $stmt->bind_param("s", $userLogin);
    
        if (!$stmt->execute()) {
            throw new \Exception("Ошибка выполнения запроса: " . $stmt->error);
        }
        $stmt->close(); 
        return true; 
    }
    
    
    public function deleteAdmin($userLogin) {
        $stmt = $this->db->prepare("UPDATE users SET role = 'user' WHERE users.login = ?");
        $stmt->bind_param('s', $userLogin);
        return $stmt->execute(); 
    }

    public function getAdminByLogin($userLogin) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE login = ? AND role = 'admin'");
        $stmt->bind_param('s', $userLogin);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }

    private function getUserByLogin($userLogin) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->bind_param('s', $userLogin);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
} 
