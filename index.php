<?php

namespace TaskManager;

use Conf\Route;

$autoloadPath = __DIR__ . '/vendor/autoload.php';

require_once($autoloadPath);

session_start();
Route::buildRoute();
