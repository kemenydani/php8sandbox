<?php

declare(strict_types=1);

namespace src\framework\config\attribute;

use Attribute;
use src\framework\request\attribute\ControllerConstructorAttribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class ConfigValue implements ControllerConstructorAttribute {
    private string $type;
    private string $key;

    public function __construct(string $type, string $key) {
        $this->type = $type;
        $this->key = $key;
    }

    public function getInjectableValue(): int|string {
        return parse_ini_file(__CONFIG__ . "/db.ini")[$this->key];
    }
}