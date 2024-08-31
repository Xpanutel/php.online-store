<?php
session_start();
include '../auth/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['login'];
    $password = $_POST['pass'];

    // Проверка логина и пароля (например, из базы данных)
    if ($username === 'admin' && $password === 'password') {
        login($username, 'admin');
        header('Location: ../admin/admin_panel.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardians of Dreams Shop | Authorization</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/container.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <div class="content">
        <h1>Welcome to the authorization page!</h1>
        <h1>Fill out the form below and click the "Sign in" button</h1>
        <form action="../auth/loginUser.php" method="post">
            <input type="text" name="login" placeholder="Your login or your email">
            <input type="password" name="pass" placeholder="Your password">
            <input type="hidden" name="token" value="<?php echo md5(uniqid(rand(), true)); ?>">
            <h3><?= htmlspecialchars($error) ?></h3>
            <input type="submit" value="Sign in">
        </form>
    </div>
    <?php include '../components/footer.php'; ?>
</body>
</html>
