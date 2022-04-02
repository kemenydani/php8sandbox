<?php

namespace application\controller;

interface Controller {
    public function __invoke(): void;
}
