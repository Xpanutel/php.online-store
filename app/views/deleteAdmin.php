<h1>Удалить администратора</h1>

<?php if (!empty($admins)): ?>
<form method="POST" action="/admin/delete">
    <label for="login">Выберите администратора:</label><br>
    <select name="login" id="login" required>
        <?php foreach ($admins as $admin): ?>
            <option value="<?php echo htmlspecialchars($admin['login']); ?>"><?php echo htmlspecialchars($admin['login']); ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <button type="submit">Удалить</button>
</form>
<?php else: ?>
    <p>Администраторов не найдено.</p>
<?php endif; ?> 

<a href="/admin">Вернуться к списку администраторов</a>
