<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Admin.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/User.php'; 

class AdminController {
    private $adminModel;
    private $userModel;

    public function __construct($db) {
        $this->adminModel = new Admin($db);
        $this->userModel = new User($db);
    }

    private function checkAdminAccess() {
        if(!isset($_SESSION['userlogin'])) {
            header('Location: /login'); 
            exit;
        }
        $user = $this->userModel->getUserByLogin($_SESSION['userlogin']);
        if($user['role'] !== 'admin') {
            header('Location: /profile'); 
            exit;
        }
    }

    public function index() {
        $this->checkAdminAccess();
        $admins = $this->adminModel->getAllAdmins();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/showAdmin.php'; 
    }

    public function addAdminForm() {
        $this->checkAdminAccess();
        $users = $this->userModel->getAllUsers();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/addAdmin.php'; 
    }

    public function addAdmin() {
        $this->checkAdminAccess();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $userLogin = $_POST['login'];
            if ($this->adminModel->updateAdminRole($userLogin)) {
                $_SESSION['message'] = "Пользователь $userLogin успешно стал администратором!";
                if (!$stmt->execute()) {
                    die("Ошибка выполнения запроса: " . mysqli_error($this->db)); // Вывод ошибки и остановка скрипта
                }
            } else {
                $_SESSION['error'] = "Ошибка! Возможно, пользователя с таким логином не существует.";
            }
        }
        header('Location: /admin');
        exit;
    }

    public function deleteAdminForm() {
        $this->checkAdminAccess();
        $admins = $this->adminModel->getAllAdmins();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/deleteAdmin.php'; 
    }

    public function deleteAdmin() {
        $this->checkAdminAccess();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $userLogin = $_POST['login'];
            if ($this->adminModel->deleteAdmin($userLogin)) {
                $_SESSION['message'] = "Пользователь $userLogin больше не администратор!";
            } else {
                $_SESSION['error'] = "Ошибка при удалении прав администратора!"; 
            }
        }
        header('Location: /admin');
        exit;
    }
} 
