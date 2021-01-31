<?php

use src\controller\ArticleViewController;
use src\lib\request\ControllerResolver;

require_once '../vendor/autoload.php';

define("__PUBLIC__", __DIR__);
define("__CONFIG__", __DIR__ . "/../src/config");

(new ControllerResolver([
    ArticleViewController::class
]))->handleRequest();
