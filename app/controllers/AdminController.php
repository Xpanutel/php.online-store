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
        }

        $user = $this->userModel->getUserByLogin($_SESSION['userlogin'])

        if($user['role'] !== 'admin') {
            header('location: /profile');
        }
    }
}