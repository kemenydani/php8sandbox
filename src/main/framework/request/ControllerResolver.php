<?php

declare(strict_types=1);

namespace src\main\framework\request;

use ReflectionClass;
use src\application\controller\Controller;
use src\main\framework\request\attribute\RequestMapping;

final class ControllerResolver {
    private RequestMapper $requestMapper;

    private array $controllerClasses;

    public function __construct(array $controllerClasses) {
        $this->controllerClasses = $controllerClasses;
        $this->requestMapper = RequestMapper::getInstance();
    }

    public function handleRequest(): void {
        if ($controllerClass = $this->getControllerClassForRequest()) {
            $this->getControllerInstance($controllerClass)();
        }
    }

    private function getControllerClassForRequest(): ?string {
        foreach ($this->controllerClasses as $controllerClass) {
            $reflectionClass = new ReflectionClass($controllerClass);
            foreach ($reflectionClass->getAttributes(RequestMapping::class) as $reflectionAttribute) {
                if ($this->requestMapper->isMatchingRequestMapping($reflectionAttribute->newInstance())) {
                    return $controllerClass;
                }
            }
        }
        return null;
    }

    private function getControllerInstance(string $controllerClass): Controller {
        return (new ControllerInstanceCreator(new ReflectionClass($controllerClass)))->getControllerInstance();
    }
}
