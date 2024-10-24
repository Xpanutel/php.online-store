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

    public function index() {
        $this->checkAdminAccess();
        $admins = $this->adminModel->getAllAdmins();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/showAdmin.php'; 
    }

    public function addAdmin() {
        $this->checkAdminAccess();
        $users = $this->userModel->getAllUsers();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $userLogin = $_POST['login'];
    
            try {
                $success = $this->adminModel->updateAdminRole($userLogin); 
                
                if ($success) {
                    $_SESSION['message'] = "Успешно: Роль пользователя изменена на администратора.";
                } else {
                    $_SESSION['error'] = "Произошла ошибка при обновлении роли пользователя.";
                }
    
            } catch (InvalidArgumentException $e) {
                $_SESSION['error'] = $e->getMessage();
            } catch (\Exception $e) { 
                error_log($e->getMessage()); 
                $_SESSION['error'] = "Ошибка базы данных. Пожалуйста, попробуйте позже."; 
            }
            header('Location: /admin/add'); 
            exit;
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/addAdmin.php';
        }
    }
    
    public function deleteAdmin() {
        $this->checkAdminAccess();
        $admins = $this->adminModel->getAllAdmins();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $userLogin = $_POST['login'];
            if ($this->adminModel->deleteAdmin($userLogin)) {
                $_SESSION['message'] = "Пользователь $userLogin больше не администратор!";
            } else {
                $_SESSION['error'] = "Ошибка при удалении прав администратора!"; 
            }

            header('Location: /admin/add'); // Redirect after processing
            exit; 
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/deleteAdmin.php';
        }
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
} 
