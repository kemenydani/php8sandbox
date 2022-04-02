<?php

namespace src\main\framework\request;

use ReflectionClass;
use ReflectionObject;
use ReflectionParameter;
use src\application\controller\Controller;
use src\main\framework\config\attribute\ConfigValue;
use src\main\framework\request\attribute\ControllerConstructorAttribute;
use src\main\framework\request\attribute\Dependency;
use src\main\framework\request\attribute\PathParam;
use src\main\framework\request\attribute\QueryParam;

final class ControllerInstanceCreator {
    private ReflectionClass $reflectionClass;
    private array $constructorAttributes = [
        PathParam::class,
        QueryParam::class,
        Dependency::class
    ];

    private array $propertyAttributes = [
        ConfigValue::class
    ];

    public function __construct(ReflectionClass $reflectionClass) {
        $this->reflectionClass = $reflectionClass;
    }

    public function getControllerInstance(): Controller {
        //TODO: do static property injection here

        $controllerInstance = $this->reflectionClass->newInstanceArgs($this->getConstructorArgs());

        $reflectionObject = new ReflectionObject($controllerInstance);
        foreach($reflectionObject->getProperties() as $reflectionProperty) {
            if ($reflectionProperty->isStatic()) {
                continue;
            }

            $isNotPublic = !$reflectionProperty->isPublic();
            if ($isNotPublic) {
                $reflectionProperty->setAccessible(true);
            }
            foreach ($this->propertyAttributes as $propertyAttribute) {
                foreach ($reflectionProperty->getAttributes($propertyAttribute) as $reflectionAttribute) {
                    if ($attribute = $reflectionAttribute->newInstance()) {
                        $reflectionProperty->setValue($controllerInstance, $attribute->getInjectableValue());
                    }
                }
            }
            if ($isNotPublic) {
                $reflectionProperty->setAccessible(false);
            }
        }

        return $controllerInstance;
    }

    private function getConstructorArgs(): array {
        $args = [];
        $constructor = $this->reflectionClass->getConstructor();
        if ($constructor === null) {
            return $args;
        }

        foreach($constructor->getParameters() as $reflectionParameter) {
            foreach($this->getAttributesOfParameter($reflectionParameter) as $attribute) {
                $args[] = $attribute->getInjectableValue();
            }
        }

        return $args;
    }

    /**
     * @param ReflectionParameter $reflectionParameter
     * @return ControllerConstructorAttribute[]
     */
    private function getAttributesOfParameter(ReflectionParameter $reflectionParameter): array {
        $attributes = [];
        foreach($this->constructorAttributes as $supportedAttribute) {
            foreach($reflectionParameter->getAttributes($supportedAttribute) as $reflectionAttribute) {
                $attributes[] = $reflectionAttribute->newInstance();
            }
        }
        return $attributes;
    }
}
