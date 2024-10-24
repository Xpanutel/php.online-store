<h1>Список товаров</h1>

<a href="/product/add">Добавить товар</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['pame'] ?></td>
                <td><?= $product['price'] ?></td>
                <td>
                    <a href="/product/edit/<?= $product['id'] ?>">Редактировать</a>
                    <a href="/product/delete/<?= $product['id'] ?>" onclick="return confirm('Вы уверены, что хотите удалить этот товар?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
