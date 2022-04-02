<?php

declare(strict_types=1);

namespace src\main\framework\request\attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
final class QueryParam implements ControllerConstructorAttribute {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getInjectableValue(): null|string|int {
        return $_GET[$this->name] ?? null;
    }
}
