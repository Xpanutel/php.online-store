<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardians of Dreams Shop</title>
    <link rel="stylesheet" href="./css/container.css">
    <style>
        h1 {
          color: #222;
          font-size: 2em;
          margin-bottom: 20px;
        }

        .product {
          display: inline-block;
          vertical-align: top;
          margin: 10px;
          padding: 10px;
          border: 15px solid #ddd;
          text-align: center;
          width: 300px;
        }

        .product_image {
          width: 100px; 
          height: 100px; 
          object-fit: cover; 
        }

        .product_title {
          margin-top: 10px;
          font-size: 16px;
          word-wrap: break-word;
          overflow-wrap: anywhere;
        }

        .product_pame {
          margin-top: 5px;
          font-size: 14px;
          word-wrap: break-word;
          overflow-wrap: anywhere;
        }
    </style>
</head>
<body>
	<?php include './components/header.php'; ?>
   <div class="content">
    <h1>Welcome to our online store!</h1>
      <?php
      include 'db_config.php';
      // кидаем запрос для получения всех товаров
      $stmt = $link->prepare("SELECT * FROM product");
      $stmt->execute();
      $result = $stmt->get_result();
        // циклом проходим по всем элементам и выводим каждый товар
      for ($i = 1; $row = $result->fetch_assoc(); $i++) { ?>
        <div class="product">
          <!-- а вот тут мы выводим картинку из папки temp по названию, которое берем из бд -->
          <?php echo '<img src="temp/'.$row['image'].'" alt="'.$row['name'].'" class="product_image">' ?>
          <h1 class="product_title"> <?php echo $row['name']; ?> </h1>
          <h3 class="product_pame"> <?php echo $row['pame']; ?> </h3>
        </div>    
      <?php } ?>
   </div>
   <?php include './components/footer.php'; ?>
</body>
</html>