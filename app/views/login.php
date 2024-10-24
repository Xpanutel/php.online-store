<!DOCTYPE html>
<html>
<head>
  <title>Авторизация</title>
</head>
<body>
  <h2>Авторизация</h2>
  <form method="POST" action="">
    <label for="login">Логин или Email:</label> 
    <input type="text" id="login" name="login" required><br>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Войти">

    <?php if (isset($_SESSION['success_message'])): ?>
    <div class="success-message"><?php echo $_SESSION['success_message']; ?></div>
    <?php unset($_SESSION['success_message']); ?> 
    <?php endif; ?>
  </form>
</body>
</html>
