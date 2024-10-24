<h1>Редактировать товар</h1>

<form method="POST" action="">
    <label for="name">Название:</label>
    <input type="text" name="name" id="name" value="<?= $product['name'] ?>" required><br>

    <label for="pame">Описание:</label>
    <textarea name="pame" id="pame"><?= $product['pame'] ?></textarea><br>

    <label for="price">Цена:</label>
    <input type="number" name="price" id="price" step="0.01" value="<?= $product['price'] ?>" required><br>

    <button type="submit">Сохранить</button>
</form>
