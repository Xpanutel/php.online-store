<?php

class Admin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addAdmin($userLogin) {
        // Проверка на существование пользователя перед изменением роли
        if ($this->getUserByLogin($userLogin)) {
            $stmt = $this->db->prepare("UPDATE users SET role = 'admin' WHERE login = ?");
            $stmt->bind_param('s', $userLogin);
            return $stmt->execute(); 
        } else {
            // Обработка случая, когда пользователь не найден
            return false; 
        }
    }

    public function deleteAdmin($userLogin) {
        // Аналогично addAdmin, можно добавить проверку на существование пользователя
        $stmt = $this->db->prepare("UPDATE users SET role = 'user' WHERE login = ? AND login != 'root'");
        $stmt->bind_param('s', $userLogin);
        return $stmt->execute(); 
    }

    public function getAdminByLogin($userLogin) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE login = ? AND role = 'admin'");
        $stmt->bind_param('s', $userLogin);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Возвращаем ассоциативный массив с данными админа
    }

    // Дополнительный метод для получения пользователя по логину
    private function getUserByLogin($userLogin) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->bind_param('s', $userLogin);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
} 
