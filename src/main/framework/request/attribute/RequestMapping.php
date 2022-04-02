<?php

declare(strict_types=1);

namespace src\main\framework\request\attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class RequestMapping {
    private string $method;
    private array $paths;

    public function __construct(string $method, array $paths) {
        $this->method = $method;
        $this->paths = $paths;
    }

    public function getPaths(): array {
        return $this->paths;
    }

    public function getMethod(): string {
        return $this->method;
    }
}
