<?php 
echo "Исходное имя файла " . $_FILES['image']['name'] . '</br>';
echo "MIME тип файла " . $_FILES['image']['type'] . '</br>';
echo "Временный файл " . $_FILES['image']['tmp_name'] . '</br>';
?>