<?php

use src\application\controller\ArticleViewController;
use src\framework\request\ControllerResolver;

require_once '../vendor/autoload.php';

const __PUBLIC__ = __DIR__;
const __CONFIG__ = __DIR__ . "/../src/config";

(new ControllerResolver([
    ArticleViewController::class
]))->handleRequest();
