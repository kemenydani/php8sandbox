<?php


namespace src\controller;

use src\lib\request\RequestInfo;

interface Controller {
    public function __invoke(): void;
}
