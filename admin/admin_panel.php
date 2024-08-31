<?php
include '../auth/auth.php';
checkAuth('admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="../css/container.css">
    <style>
        .admin_name {
            width: 70%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .admin_pame {
            width: 70%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .admin_image {
            width: 70%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .admin_btn {
            width: 70%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>
    <div class="content">
        <form action="addProduct.php" method="post" enctype="multipart/form-data">
            <input class="admin_name" type="text" placeholder="название товара" name="name">
            <textarea class="admin_pame" type="text" placeholder="описание товара" name="pame"></textarea>
            <input class="admin_name" type="number" placeholder="стоимость товара" name="price">
            <input class="admin_image" type="file" name="image" accept="image/*">
            <h3><?= $error ?></h3>
            <h3><?= $suc ?></h3>
            <input class="admin_btn" type="submit" placeholder="Готово!">
        </form>
    </div>
    <?php include '../components/footer.php'; ?>
</body>
</html>
