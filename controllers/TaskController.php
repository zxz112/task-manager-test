<?php

namespace Controllers;

use Models\TaskModel;
use Views\View;

class TaskController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        $template = '/views/tasks/index.phtml';
        $itemsOnPage = 10;

        if (!array_key_exists('page', $_GET) || $_GET['page'] == 0) {
            $numPage = 0;
        } else {
            $numPage = ($_GET['page'] - 1) * $itemsOnPage;
        }

        if (array_key_exists('sortBy', $_GET) && !empty($_GET['sortBy'])) {
            $sortBy = $_GET['sortBy'];
        } else {
            $sortBy = 'name';
        }

        if (array_key_exists('orderBy', $_GET)) {
            $orderBy = $_GET['orderBy'];
        } else {
            $orderBy = 'desc';
        }
        $task = new TaskModel();
        $this->pageData['tasks'] = $task->getPage($numPage, $itemsOnPage, $sortBy, $orderBy);
        $this->pageData['paging'] = ceil($task->count() / $itemsOnPage);
        $this->render($template, $this->pageData);
    }

    public function create()
    {
        $template = '/views/tasks/create.phtml';
        $this->render($template, $this->pageData);
    }

    public function store()
    {
        $task = new TaskModel();
        $template = '/views/tasks/create.phtml';
        $this->pageData['name'] = $_POST['name'];
        if (empty($this->pageData['name'])) {
            $errors['name'] = "Не заполнено имя";
        }
       
        $this->pageData['email'] = $_POST['email'];
        if (empty($this->pageData['email'])) {
            $errors['email'] = "Не заполнен email";
        } elseif (!filter_var($this->pageData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Некорректный email";
        }

        $this->pageData['content'] = $_POST['content'];
        if (empty($this->pageData['content'])) {
            $errors['content'] = "Не заполнено содержимое";
        }

        if (isset($errors)) {
            $this->pageData['errors'] = $errors;
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $this->pageData;
            header("Location: /tasks/create");
        } else {
            $task->insert($this->pageData);
            $_SESSION['success'] = 'Задача успешно добавлена!';
            header("Location: /");
            exit;
        }
    }

    public function edit()
    {
        $template = '/views/tasks/edit.phtml';
        $this->render($template, $this->pageData);
    }

    public function update()
    {
        $task = new TaskModel();
        if (isset($_SESSION['admin'])) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $task->updateStatus($id);
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
            $content = $_POST['content'];
            $id = $_POST['update'];
            $task->update($id, $content);
            $res = $_SERVER;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        header("Location: /login");
        exit;
    }
}
