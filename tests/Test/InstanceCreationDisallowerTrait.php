<?php

namespace Keradus\Traits\Tests\Test;

class InstanceCreationDisallowerTrait extends \Keradus\Traits\Tests\PHPUnit\TestCase
{
    public function testConstructorVisibility()
    {
        $reflection = new \ReflectionClass($this->getFixtureName());
        $constructorReflection = $reflection->getConstructor();

        $this->assertTrue($constructorReflection && $constructorReflection->isProtected());
    }

    public function testConstructorVisibilityOfExtendedClass()
    {
        $reflection = new \ReflectionClass($this->getFixtureName() . "\\Extended");
        $constructorReflection = $reflection->getConstructor();

        $this->assertTrue($constructorReflection && $constructorReflection->isProtected());
    }

    /**
     * @expectedException LogicException
     */
    public function testCreationByHelper()
    {
        $name = $this->getFixtureName();
        $instance = $name::createInstance();
    }
}
