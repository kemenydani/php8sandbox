<?php

namespace src\application\controller;

interface Controller {
    public function __invoke(): void;
}
