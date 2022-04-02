<?php

declare(strict_types=1);

namespace src\main\framework\request;

final class RequestInfo {
    private static ?RequestInfo $instance = null;

    private function __construct() {}

    public function getMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getInstance(): self {
        return self::$instance ?: new self();
    }
}
