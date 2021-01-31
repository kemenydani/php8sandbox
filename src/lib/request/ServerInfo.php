<?php

declare(strict_types=1);

namespace src\lib\request;

final class ServerInfo {
    private static ?ServerInfo $instance = null;

    public function getRequestPath(): string {
        return strtok($this->getRequestUri(), '?');
    }

    public function getRequestUri(): string {
        return $_SERVER['REQUEST_URI'];
    }

    public function getRequestMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getInstance(): self {
        return self::$instance ?: new self();
    }
}
