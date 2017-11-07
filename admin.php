<?php
ob_start();
require_once 'functions.php';
$currentUser = getCurrentUser();
if (!$currentUser) {
    //header("HTTP/1.0 403 Forbidden");
    //die();
    redirect('index');
}
echo 'Добро пожаловать, ' . $currentUser['username'];
?>
<!DOCTYPE>
<html lang="ru">
<head>
    <title>Задание7</title>
    <meta charset="utf-8">
</head>
<body>
<?php

?>
<h3>Загрузить тест :</h3>
<form action="admin.php" method="post" enctype="multipart/form-data">
    <input name="myfile" type="file">
    <input type="submit" value="отправить">
    <input type="reset">
</form>
</body>
<?php
$json = 'application/json';
$octetStream = 'application/octet-stream';
if (isset($_FILES['myfile']) and !empty($_FILES['myfile']['name'])) {
    if ($_FILES['myfile']['type'] == $json or $_FILES['myfile']['type'] == $octetStream) {
        if ($_FILES['myfile']['error'] == 0 and move_uploaded_file($_FILES['myfile']['tmp_name'], __DIR__ . '/DownloadedTests/' . $_FILES['myfile']['name'])) {
            echo 'Файл загружен';
            header('Location: list.php'); //http://netology.com/Lesson7/list.php
            ob_end_flush();
        } else {
            echo 'Ошибка! Файл не загружен !';
        }
    } else {
        echo 'Неверное расширение! Подходят только .json';
    }
}
?>
<br>
<h3>
    <a href="list.php" style="color: black">К списку тестов</a>
    <a href="logout.php" style="color: darkblue">EXIT</a>
</h3>


