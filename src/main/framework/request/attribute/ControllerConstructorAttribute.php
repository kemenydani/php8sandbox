<?php

declare(strict_types=1);

namespace src\main\framework\request\attribute;

interface ControllerConstructorAttribute {
    public function getInjectableValue(): mixed;
}
