<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Admin.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/User.php'; 

class AdminController {
    private $adminModel;
    private $userModel;

    public function __construct($db) {
        $this->adminModel = new Admin($db);
        $this->userModel = new User($db);
        $this->checkAdminAccess();
    }

    public function checkAdminAccess() {
        session_start();
        // проверяем авторизован ли пользователь
        if(!isset($_SESSION['userlogin'])) {
            header('location: /login');
            exit;
        }

        $user = $this->userModel->getUserByLogin($_SESSION['userlogin']);

        if($user['role'] !== 'admin') {
            header('location: /profile');
            exit;
        }
    }

    public function index() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin.php'; 
    }

    public function addAdmin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userLogin = $_POST['login']; 
            if ($this->adminModel->addAdmin($userLogin)) {
                header('Location: /admin'); 
            } else {
                // Обработка ошибки добавления, например, вывести сообщение
                echo "Ошибка добавления администратора";
            }
        } else {
            // Если не POST запрос, перенаправляем на главную страницу админа
            header('Location: /admin'); 
        }
    }

    public function deleteAdmin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userLogin = $_POST['login']; 
            if ($this->adminModel->deleteAdmin($userLogin)) {
                header('Location: /admin'); 
            } else {
                // Обработка ошибки удаления
                echo "Ошибка удаления администратора"; 
            }
        } else {
            header('Location: /admin'); 
        }
    }
}

