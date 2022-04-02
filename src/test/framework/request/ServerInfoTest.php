<?php

declare(strict_types=1);

namespace src\test\framework\request;

use PHPUnit\Framework\TestCase;
use src\main\framework\request\ServerInfo;

class ServerInfoTest extends TestCase
{

    /**
     * @covers ServerInfo::getRequestUri
     */
    public function testGetRequestUri(): void
    {
        self::assertEquals('', (ServerInfo::getInstance()->getRequestUri()));
    }
}
