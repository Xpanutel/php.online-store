<h1>Список администраторов</h1>

<?php if (!empty($admins)): ?> 
    <ul>
        <?= var_dump($admins); ?>
    <?php foreach ($admins as $admin): ?>
        <li><?php echo isset($admin['login']) ? $admin['login'] : "Не указан"; ?></li> 
    <?php endforeach; ?>

    </ul>
<?php else: ?>
    <p>Администраторов не найдено.</p>
<?php endif; ?> 

<a href="admin/add">Добавить администратора</a>
<a href="admin/delete">Удалить администратора</a>
