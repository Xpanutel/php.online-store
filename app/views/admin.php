<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>

    <h2>Add Admin</h2>
    <form method="post" action="/admin/addAdmin">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required>
        <button type="submit">Add</button>
    </form>

    <h2>Delete Admin</h2>
    <form method="post" action="/admin/deleteAdmin">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required>
        <button type="submit">Delete</button>
    </form>

    <a href="/profile">Profile</a>
</body>
</html>
