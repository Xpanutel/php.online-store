<h1>Добавить администратора</h1>
<form method="POST" action="">
    <label for="login">Логин пользователя:</label><br>
    <!-- <input type="text" name="login" id="login" required><br><br> -->
    <select name="login" id="login" required>
        <?php foreach ($users as $user): ?>
            <option value="<?php echo htmlspecialchars($user['login']); ?>"><?php echo htmlspecialchars($user['login']); ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <button type="submit">Добавить</button>
</form>

<a href="/admin">Вернуться к списку администраторов</a>