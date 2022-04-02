<?php

declare(strict_types=1);

namespace src\framework\request\attribute;

use Attribute;
use src\framework\request\RequestMapper;

#[Attribute(Attribute::TARGET_PARAMETER)]
final class PathParam implements ControllerConstructorAttribute {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getInjectableValue(): int|string {
        return (RequestMapper::getInstance())->getMatches()[$this->name];
    }
}