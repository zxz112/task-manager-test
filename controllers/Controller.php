<?php

namespace Controllers;

class Controller
{
    public $model;
    public $view;
    public $pageData = [];

    public function __construct()
    {
        $this->model = new Model();
        $this->view  = new View();
    }
}
