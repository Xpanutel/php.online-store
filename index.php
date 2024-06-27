<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardians of Dreams Shop</title>
    <style>
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }

        body {
          display: flex;
          flex-direction: column;
        }

        .content {
          flex: 1;
          padding: 20px;
          background: #f7f7f7;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
          border-radius: 5px;
          text-align: center;
        }

        h1 {
          color: #222;
          font-size: 2em;
          margin-bottom: 20px;
        }
    </style>
</head>
<body>
	<?php include './components/header.php'; ?>
   <div class="content">
      <h1>Welcome to our online store!</h1>
   </div>
   <?php include './components/footer.php'; ?>
</body>
</html>
