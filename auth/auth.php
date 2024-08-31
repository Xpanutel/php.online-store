<?php
session_start();

function checkAuth($role = 'user') {
    if (!isset($_SESSION['login']) || $_SESSION['role'] !== $role) {
        header('Location: profile.php');
        exit();
    }
}

function login($username, $role) {
    $_SESSION['login'] = $username;
    $_SESSION['role'] = $role;
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
