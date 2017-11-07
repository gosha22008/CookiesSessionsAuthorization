<?php
session_start();
define('FILE_DATA_USERS', __DIR__ . '/users.json');

function login($login, $password)
{
    $user = getUser($login);
    if ($user !== null && $user['password'] == $password) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

function logout()
{
    session_destroy();
    redirect(index);
}

function isGuest()
{
    $var = file_get_contents('guest.txt');
    if ($var == 'guest') {
        return true;
    } else return false;
}

function isName()
{
    return isset($_REQUEST['login']) ? $_REQUEST['login'] : null;
}

function saveName()
{
    file_put_contents('savedName.txt', $_REQUEST['login']);
}

function getUsers()
{
    $usersData = file_get_contents(FILE_DATA_USERS);
    $users = json_decode($usersData, true);
    if (!$users) {
        return [];
    }
    return $users;
}

function getUser($login)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['login'] == $login) {
            return $user;
        }
    }
    return null;
}

function isPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function getParam($name)
{
    return isset ($_REQUEST[$name]) ? $_REQUEST[$name] : null;
}

function getCurrentUser()
{
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

function redirect($action)
{
    header('Location: ' . $action . '.php');
    die;
}