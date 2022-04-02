<?php

declare(strict_types=1);

namespace src\framework\request;

use PHPUnit\Framework\TestCase;

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
