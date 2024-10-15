<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/User.php'; 

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userlogin = $_POST['login']; 
            $userpassword = $_POST['password'];
            $useremail = $_POST['email'];

            if ($this->userModel->UserRegistr($userlogin, $userpassword, $useremail)) {
                echo "Регистрация прошла успешно!";
            } else {
                echo "Ошибка при регистрации.";
            }
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/register.php'; 
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userlogin = $_POST['login']; 
            $userpassword = $_POST['password'];

            if ($this->userModel->UserLogin($userlogin, $userlogin, $userpassword)) { 
                $_SESSION['userlogin'] = $userlogin;
                header('Location: /profile'); 
            } else {
                echo "Неверный логин или пароль."; 
            }
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/login.php'; 
        }
    }
}
