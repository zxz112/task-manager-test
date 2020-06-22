<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends Controller
{

    public function __construct()
    {
        //
    }

    public function getLogin()
    {
        if (isset($_SESSION['admin'])) {
            header("Location: /");
            exit;
        }
        $template = '/views/login.phtml';
        $this->render($template, $this->pageData);
    }

    public function postLogin()
    {
        $user = new UserModel();
        $login = $_POST['login'];
        $password = $_POST['password'];


        if (empty($login)) {
            $_SESSION['errors']['login'] = "Введите имя";
        }

        if (empty($password)) {
            $_SESSION['data']['login'] = $_POST['login'];
            $_SESSION['errors']['password'] = 'Введите пароль';
        }

        if ($user->checkAdmin($login, $password)) {
            $_SESSION['admin'] = 'admin';
            header("Location: /");
            exit;
        } else {
            if (empty($_SESSION['errors'])) {
                $_SESSION['data']['login'] = $_POST['login'];
                $_SESSION['errors']['access'] = 'Неправильный логин или пароль';
            }
        }
        header("Location: /login");
        exit;
    }

    public function getLogout()
    {
        unset($_SESSION['admin']);
        header("Location: /");
    }
}
