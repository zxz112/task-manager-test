<?php

class AuthController extends Controller
{

    public function __construct()
    {
        $this->model = new UserModel();
        $this->view  = new View();
    }

    public function getLogin()
    {
        if(isset($_SESSION['admin'])) {
            header("Location: /");
            exit;
        }
        $template = '/views/login.phtml';
        $this->view->render($template, $this->pageData);
    }

    public function postLogin()
    {
        if (empty($_POST['login'])) {
            $_SESSION['errors']['login'] = "Введите имя";
        }

        if (empty($_POST['password'])) {
            $_SESSION['errors']['password'] = 'Введите пароль';
        }
        $e = $_SESSION;
        if ($this->model->checkAdmin()) {
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