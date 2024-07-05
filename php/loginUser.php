<?php
session_start(); 

$error = '';

include 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $login = $_POST['login'];
  $pass = $_POST['pass'];

  $stmt = $link->prepare("SELECT * FROM users WHERE login = ? OR email = ?");
  $stmt->bind_param('ss', $login, $login);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($row && $pass == $row['password']) {
    $_SESSION['login'] = $login;
    $_SESSION['auth'] = true;
    $stmt->close();
    $link->close();
		header('Location: ../profile.php');
    exit; 
  } else {
      $error = "Неверный логин или пароль!";
  }
}
?>
