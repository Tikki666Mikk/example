<?php
session_start();
require_once('database.class..php');

class Authorization extends Database
{

    public function authorization_user($login, $password)
    {
        $auth = "SELECT `id`, `login`, `password` FROM `users` WHERE `login` = '" . $login . "' LIMIT 1";
        $db_pass = null;

        foreach ($this->getDB()->query($auth) as $user) {
            $db_pass = $user['password'];
        }

        if ($password === $db_pass) {
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            if ($login == 'admin12') {
                $_SESSION['admin'] = true;
            }
            header('Location: index.php#success-authorization');
        } else {
            $_SESSION['auth'] = false;
            header('Location: authorization.php#unsuccess-authorization');
        }
    }
}