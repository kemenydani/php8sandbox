<?php

use application\controller\ArticleViewController;
use framework\request\ControllerResolver;

require_once '../build/vendor/autoload.php';

const __PUBLIC__ = __DIR__;
const __CONFIG__ = __DIR__ . "/../src/main/application/config";

(new ControllerResolver([
    ArticleViewController::class
]))->handleRequest();
