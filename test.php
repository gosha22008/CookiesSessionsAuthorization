<?php
require_once 'functions.php';
ob_start();

?>
<!DOCTYPE>
<html lang="ru">
<head>
    <title>Задание7</title>
    <meta charset="utf-8">
</head>
<?php
$aa = $_GET;
$k = key($aa);
if (file_exists(__DIR__ . '/DownloadedTests/' . $_GET[$k])) {
    $file = file_get_contents(__DIR__ . '/DownloadedTests/' . $_GET[$k]);
    $file1 = json_decode($file, true);
} else {
    header("HTTP/1.0 404 Not Found");
    //http_response_code(404);
    die('такого файла не найдено!');
}
?>
<body>
<?php
$currentUser = getCurrentUser();
if ($currentUser) { ?>
    <h3>
        <a href="admin.php" style="color: black">Загрузить тест</a>
    </h3>
<?php } ?>
<h3>
    <a href="list.php" style="color: black">К списку тестов</a>
    <a href="logout.php" style="color: darkblue">EXIT</a>
</h3>
<form action="" method="POST">
    <?php foreach ($file1 as $k => $v) { ?>
        <fieldset>
            <legend><?= "$k." . $file1[$k]["q$k"] ?></legend>
            <label><input name="q<?= $k ?>" value="0" type="radio"> <?= $file1[$k]['answer']['a0'] ?></label>
            <label><input name="q<?= $k ?>" value="1" type="radio"> <?= $file1[$k]['answer']['a1'] ?></label>
            <label><input name="q<?= $k ?>" value="2" type="radio"> <?= $file1[$k]['answer']['a2'] ?></label>
        </fieldset>
    <?php } ?>
    <input value="Отправить" type="submit">
</form>
</body>
</html>
<?php
$priem = $_POST;
if (isset($priem['q0']) and isset($priem['q1']) and isset($priem['q2'])) {
    $i = 0;
    foreach ($file1 as $key => $value) {
        if ($file1[$key]['correct'] == $priem["q$key"]) {
            $i++;
            echo "$key -- Верно<br>";

        } else {
            echo "$key -- Неверно<br>";
        }
    }
    file_put_contents('numb.txt', $i);
    header('Location: sertif.php ');
//    echo '
//<form method="post">
//<input type="text" name="name">введите имя
//<input type="submit" value="отправить">
//</form>
//';
}
//if (isset($_POST['name']) and !empty($_POST['name'])) {
//    $name = $_POST['name'];
//    file_put_contents('name.txt', $name);
//    header('Location: sertif.php ');

ob_end_flush();

?>

