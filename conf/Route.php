<?php

class Route
{
    public static function buildRoute()
    {
        $route = explode('?', $_SERVER['REQUEST_URI']);
        $uri = $route[0];
        $method = $_SERVER['REQUEST_METHOD'];

        if ($uri === '/' && $method === 'GET') {
            $controllerName = 'TaskController';
            $modelName = 'TaskModel';
            $action = 'index';
        } elseif ($uri === '/tasks/create' && $method === 'GET') {
            $controllerName = 'TaskController';
            $modelName = 'TaskModel';
            $action = 'create';
        } elseif ($uri === '/tasks/store' && $method === 'POST') {
            $controllerName = 'TaskController';
            $modelName = 'TaskModel';
            $action = 'store';
        } elseif ($uri == '/login' && $method == 'GET') {
            $controllerName = 'AuthController';
            $modelName = 'UserModel';
            $action = 'getLogin';
        } elseif ($uri === '/login' && $method === 'POST') {
            $controllerName = 'AuthController';
            $modelName = 'UserModel';
            $action = 'postLogin';
        } elseif ($uri === '/logout' && $method === 'GET') {
            $controllerName = 'AuthController';
            $modelName = 'UserModel';
            $action = 'getLogout';
        } elseif ($uri == '/tasks/edit/(?P<id>\d+)' && $method === 'GET') {
            $controllerName = 'TaskController';
            $modelName = 'TaskModel';
            $action = 'edit';
        } elseif ($uri === '/tasks/update' && $method === 'POST') {
            $controllerName = 'TaskController';
            $modelName = 'TaskModel';
            $action = 'update';
        } elseif ($uri === 'tasks/edit' && $method === 'GET') {
            $controllerName = 'TaskController';
            $modelName = 'TaskModel';
            $action = 'edit';
        } else {
            header("Location: /");
            exit;
        }
        include CONTROLLER_PATH . $controllerName . ".php";
        include MODEL_PATH . $modelName . ".php";
        $controller = new $controllerName;
        $controller->$action();
    }
}
