<?php

declare(strict_types=1);

namespace src\test\framework\request;

use framework\request\ServerInfo;
use PHPUnit\Framework\TestCase;

class ServerInfoTest extends TestCase
{

    /**
     * @covers \framework\request\ServerInfo
     */
    public function testGetRequestUri(): void
    {
        self::assertEquals('', (ServerInfo::getInstance()->getRequestUri()));
    }

    /**
     * @covers \framework\request\ServerInfo
     */
    public function testGetRequestMethod(): void
    {
        self::assertEquals('GET', (ServerInfo::getInstance()->getRequestMethod()));
    }
}
