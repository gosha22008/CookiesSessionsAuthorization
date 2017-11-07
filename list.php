<?php
require_once 'functions.php';

if (isset($_GET['delete']) and file_exists(__DIR__ . '/DownloadedTests/' . $_GET['delete'])){
    unlink(__DIR__ . '/DownloadedTests/' . $_GET['delete']);
}
?>
<!DOCTYPE>
<html lang="ru">
<head>
    <title>Задание7</title>
    <meta charset="utf-8">
</head>
<?php
$dir = 'DownloadedTests';
$tests = scandir($dir);
$tests = array_reverse($tests);
$kol = count($tests);
unset($tests[$kol - 1], $tests[$kol - 2]);
$tests = array_reverse($tests);
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
    <a href="logout.php" style="color: darkblue">EXIT</a>
</h3>

<div>
    <form action="test.php" method="get">
        <?php foreach ($tests as $k => $v) { ?>
            <h3><input type="submit" name="<?= "$k" ?>" value="<?= $v ?>" style="font-size: 25px">

                <?php
                //echo $v;
                $currentUser = getCurrentUser();
                if ($currentUser) { ?>

                    <a href="?delete=<?= "$v" ?>" style="color: darkred">удалить</a>
                    <br>
                <?php } ?>
            </h3>
        <?php } ?>
    </form>
</div>
</body>
</html>