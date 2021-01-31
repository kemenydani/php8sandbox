<?php

declare(strict_types=1);

namespace src\lib\request\attribute;

interface ControllerConstructorAttribute {
    public function getInjectableValue(): mixed;
}
