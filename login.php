<?php
require_once 'functions.php';

$errors = [];
if (isPost()) {
    if (login(getParam('login'), getParam('password'))) {
        file_put_contents('guest.txt', 'adm');
        saveName();
        redirect('admin');
    } else {
        $errors[] = 'Невалидный логин или пароль';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
<div>
    <div>
        <h3>Вход</h3>
    </div>
    <div>
        <?php if (!empty($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form method="post">
            <fieldset>
                <div>
                    <input type="text" placeholder="Login" name="login">
                </div>
                <div>
                    <input type="password" placeholder="Password" name="password" value="">
                </div>
                <div>
                    <input type="submit" value="Авторизация">
                </div>
            </fieldset>
        </form>
    </div>

</div>

</body>
</html>
