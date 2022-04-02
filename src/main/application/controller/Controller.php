<?php

namespace src\main\application\controller;

interface Controller {
    public function __invoke(): void;
}
