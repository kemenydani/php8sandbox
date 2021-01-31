<?php

declare(strict_types=1);

namespace src\lib\request;

use src\lib\request\attribute\RequestMapping;

final class RequestMapper {
    private const PATTERN_PATH_PLACEHOLDER = "#\{(.*?)\}#";
    private const PATTERN_PATH_REPLACEMENT = "(?'$1'.*)";

    private static ?RequestMapper $instance = null;

    private RequestInfo $requestInfo;
    private ServerInfo $serverInfo;
    private array $matches = [];

    private function __construct() {
        $this->serverInfo = ServerInfo::getInstance();
        $this->requestInfo = RequestInfo::getInstance();
    }

    public function isMatchingRequestMapping(RequestMapping $requestMapping): bool {
        if ($this->requestInfo->getMethod() === $requestMapping->getMethod()) {
            foreach ($requestMapping->getPaths() as $path) {
                if ($this->isMatchingRequestPath(self::getRegexFromPath($path))) {
                    return true;
                }
            }
        }
        return false;
    }

    private function isMatchingRequestPath(string $regexPath): bool {
        return preg_match('/' . $regexPath. '/i', $this->serverInfo->getRequestPath(),
            $this->matches, PREG_UNMATCHED_AS_NULL) === 1;
    }

    public function getMatches(): array {
        return $this->matches;
    }

    private static function getRegexFromPath(string $path): string {
        return str_replace("/", "\/",
            preg_replace(self::PATTERN_PATH_PLACEHOLDER, self::PATTERN_PATH_REPLACEMENT, $path));
    }

    public static function getInstance(): self {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
