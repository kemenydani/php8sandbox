<?php

declare(strict_types=1);

namespace src\lib\request;

final class RequestMethod {
    private function __construct() {}

    public const POST = 'POST';
    public const GET = 'GET';
}