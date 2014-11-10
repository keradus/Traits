<?php

namespace Keradus\Traits\Tests\Test;

class InnerClassCacheTrait extends \Keradus\Traits\Tests\PHPUnit\TestCase
{
    /**
     * Test if cache for two instances are independent.
     **/
    public function testTrait()
    {
        $fixtureA = $this->createFixtureInstance();
        $fixtureB = $this->createFixtureInstance();

        $fixtureA->set("a", true);

        $this->assertCount(1, $fixtureA->getCache());
        $this->assertCount(0, $fixtureB->getCache());

        $this->assertTrue($fixtureA->exists("a"));
        $this->assertFalse($fixtureB->exists("a"));
    }
}
