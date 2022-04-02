<?php

declare(strict_types=1);

namespace src\framework\request\attribute;

interface ControllerConstructorAttribute {
    public function getInjectableValue(): mixed;
}
