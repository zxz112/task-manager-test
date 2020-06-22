<?php

namespace Controllers;

class Controller
{
    private $pageData;

    public function __construct()
    {
        $this->pageData = [];
    }

    public function render($template, $pageData)
    {

        include ROOT . $template;
    }
}
