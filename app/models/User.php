<?php
session_start();

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
}