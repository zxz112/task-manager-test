<?php

class View
{
    public function render($template, $pageData)
    {
        include ROOT . $template;
    }
}