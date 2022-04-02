<?php

declare(strict_types=1);

namespace framework\request\attribute;

use Attribute;
use framework\request\RequestInfo;
use framework\request\ServerInfo;

#[Attribute(Attribute::TARGET_PARAMETER)]
final class Dependency implements ControllerConstructorAttribute {
    private string $class;
    private array $constructorArgs;

    public function __construct(string $class, array $constructorArgs = []) {
        $this->class = $class;
        $this->constructorArgs = $constructorArgs;
    }

    public function getClass(): string {
        return $this->class;
    }

    public function getInjectableValue(): RequestInfo|ServerInfo|null {
        return match($this->class) {
            ServerInfo::class => ServerInfo::getInstance(),
            RequestInfo::class => RequestInfo::getInstance(),
            default => null
        };
    }
}
