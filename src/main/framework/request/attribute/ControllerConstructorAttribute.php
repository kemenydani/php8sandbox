<?php

declare(strict_types=1);

namespace framework\request\attribute;

interface ControllerConstructorAttribute {
    public function getInjectableValue(): mixed;
}
