<h1>Добавить товар</h1>

<form method="POST" action="">
    <label for="name">Название:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="pame">Описание:</label>
    <textarea name="pame" id="pame"></textarea><br>

    <label for="price">Цена:</label>
    <input type="number" name="price" id="price" step="0.01" required><br>

    <button type="submit">Добавить</button>
</form>
