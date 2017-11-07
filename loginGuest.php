<?php
require_once 'functions.php';
$errors = [];
if (isPost()){
    if (isName()){
        file_put_contents('guest.txt','guest');
        saveName();
        redirect('list');
    }else {
        $errors[] = 'Невалидный логин';
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Гость</title>
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
            <input type="submit" value="Гость">
        </div>
    </fieldset>
</form>
</div>

</div>

</body>
</html>