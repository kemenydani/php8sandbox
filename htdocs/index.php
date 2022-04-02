<?php

use src\main\application\controller\ArticleViewController;
use src\main\framework\request\ControllerResolver;

require_once '../build/vendor/autoload.php';

const __PUBLIC__ = __DIR__;
const __CONFIG__ = __DIR__ . "/../src/application/config";

(new ControllerResolver([
    ArticleViewController::class
]))->handleRequest();
