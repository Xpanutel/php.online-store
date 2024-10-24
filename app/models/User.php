<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function UserRegistr($userlogin, $userpassword, $useremail) {
        $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare('INSERT INTO users (login, email, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $userlogin, $useremail, $hashedPassword);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Ошибка регистрации пользователя: " . $stmt->error);
            return false;
        }
    }

    public function UserLogin($userlogin, $useremail, $userpassword) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE login = ? OR email = ?');
        $stmt->bind_param('ss', $userlogin, $useremail);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            if (password_verify($userpassword, $row['password'])) {
                $_SESSION['userlogin'] = $userlogin;
                $stmt->close();
                return true;
            }
        }
        
        return false; 
    }

    public function getUserByLogin($userlogin) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE login = ?');
        
        if (!$stmt) {
            error_log("Ошибка подготовки запроса: " . $this->db->error); 
            return false; 
        }

        try {
            $stmt->bind_param('s', $userlogin);
            $stmt->execute();

            $result = $stmt->get_result();
            
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } 
        } finally {
            $stmt->close();  
        }

        return false; 
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT login FROM users WHERE role = 'user'");
        $stmt->execute();
        if (!$stmt->execute()) {
            // Обработка ошибки, например, запись в лог
            die('Ошибка выполнения запроса: ' . $stmt->error);
        }
        $result = $stmt->get_result();
        $users = []; 
        while ($row = $result->fetch_assoc()) {
            // Создаем массив для каждого администратора:
            $user = [
                'login' => $row['login']
            ]; 
            $users[] = $user; // Добавляем массив $admin в $admins
        }

        return $users; 
    }
}