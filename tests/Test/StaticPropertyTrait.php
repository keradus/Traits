<?php

namespace Keradus\Traits\Tests\Test;

class StaticPropertyTrait extends \Keradus\Traits\Tests\PHPUnit\TestCase
{
    protected $fixtureDefaultState = [
        0 => "a",
        "1" => "b",
        "a" => 1,
        "b" => 2,
        "c" => "ccc",
        "d" => null,
        "e" => [1, 2, 3, ],
        "f" => ["f1" => "f11", "f2" => "f22", ],
    ];

    public function setUp()
    {
        $fixture = $this->getFixtureName();
        $fixture::set($this->fixtureDefaultState);
    }

    public function tearDown()
    {
        $fixture = $this->getFixtureName();
        $fixture::removeAll();
    }

    public function testGetByArray()
    {
        $fixture = $this->getFixtureName();

        $this->assertSame($this->fixtureDefaultState, $fixture::get(array_keys($this->fixtureDefaultState)));
    }

    public function testGetByList()
    {
        $fixture = $this->getFixtureName();

        $this->assertSame(
            [
                "a" => $this->fixtureDefaultState["a"],
                "b" => $this->fixtureDefaultState["b"],
            ],
            $fixture::get("a", "b")
        );
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testGetByNoParameter()
    {
        $fixture = $this->getFixtureName();

        $fixture::get();
    }

    public function testGetBySingle()
    {
        $fixture = $this->getFixtureName();

        $this->assertSame($this->fixtureDefaultState["a"], $fixture::get("a"));
    }

    public function testGetOne()
    {
        $fixture = $this->getFixtureName();

        foreach ($this->fixtureDefaultState as $key => $val) {
            $this->assertSame($val, $fixture::getOne($key));
        }
    }

    public function testGetOneNonExisting()
    {
        $fixture = $this->getFixtureName();

        $this->assertSame(null, $fixture::getOne("aaaaaaaaaa"));
    }

    public function testGetOneNonExistingWithDefaultValue()
    {
        $fixture = $this->getFixtureName();

        $this->assertSame("bbbbbbbbbb", $fixture::getOne("aaaaaaaaaa", "bbbbbbbbbb"));
    }

    public function testGetOneWithDefaultValue()
    {
        $fixture = $this->getFixtureName();

        foreach ($this->fixtureDefaultState as $key => $val) {
            $this->assertSame($val, $fixture::getOne($key, "bbbbbbbbbb"));
        }
    }

    public function testHasOne()
    {
        $fixture = $this->getFixtureName();

        foreach ($this->fixtureDefaultState as $key => $val) {
            $this->assertTrue($fixture::hasOne($key));
        }
    }

    public function testHasOneNonExisting()
    {
        $fixture = $this->getFixtureName();

        $this->assertSame(false, $fixture::hasOne("aaaaaaaaaa"));
    }

    public function testRemoveAll()
    {
        $fixture = $this->getFixtureName();

        $fixture::removeAll();

        $this->assertEmpty($fixture::toArray());
    }

    public function testRemoveByArray()
    {
        $fixture = $this->getFixtureName();

        $fixture::remove(["a", "b", ]);

        $this->assertFalse($fixture::hasOne("a"));
        $this->assertFalse($fixture::hasOne("b"));
    }

    public function testRemoveByList()
    {
        $fixture = $this->getFixtureName();

        $fixture::remove("a", "b");

        $this->assertFalse($fixture::hasOne("a"));
        $this->assertFalse($fixture::hasOne("b"));
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testRemoveByNoParameter()
    {
        $fixture = $this->getFixtureName();

        $fixture::remove();
    }

    public function testRemoveBySingle()
    {
        $fixture = $this->getFixtureName();

        $fixture::remove("a");

        $this->assertFalse($fixture::hasOne("a"));
    }

    public function testRemoveOne()
    {
        $fixture = $this->getFixtureName();

        $fixture::removeOne("b");

        $this->assertFalse($fixture::hasOne("b"));
    }

    public function testRemoveOneForAll()
    {
        $fixture = $this->getFixtureName();

        foreach ($this->fixtureDefaultState as $key => $val) {
            $fixture::removeOne($key);
        }

        $this->assertEmpty($fixture::toArray());
    }

    public function testSetByArray()
    {

        $fixture = $this->getFixtureName();
        $values = [
            uniqid() => uniqid(),
            uniqid() => uniqid(),
            uniqid() => uniqid(),
        ];

        $fixture::set($values);

        $this->assertSame(
            $values,
            $fixture::get(array_keys($values))
        );
    }

    public function testSetByArrayAndArray()
    {

        $fixture = $this->getFixtureName();
        $keys = [ uniqid(), uniqid(), uniqid(), ];
        $values = [ uniqid(), uniqid(), uniqid(), ];

        $fixture::set($keys, $values);

        $this->assertSame(
            array_combine($keys, $values),
            $fixture::get($keys)
        );
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByArrayAndDifferSizeArray()
    {
        $fixture = $this->getFixtureName();
        $keys = [ uniqid(), uniqid(), ];
        $values = [ uniqid(), uniqid(), uniqid(), ];

        $fixture::set($keys, $values);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByArrayAndString()
    {
        $fixture = $this->getFixtureName();

        $fixture::set([1, 2], 3);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByNoParameter()
    {
        $fixture = $this->getFixtureName();

        $fixture::set();
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByOneParameter()
    {
        $fixture = $this->getFixtureName();

        $fixture::set(1);
    }

    public function testSetByStringAndString()
    {
        $fixture = $this->getFixtureName();
        $key = uniqid("key");
        $val = uniqid("val");

        $fixture::set($key, $val);

        $this->assertSame($val, $fixture::getOne($key));
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByThreeParameters()
    {
        $fixture = $this->getFixtureName();

        $fixture::set(1, 2, 3);
    }

    public function testSetOne()
    {
        $fixture = $this->getFixtureName();
        $key = uniqid("key");
        $val = uniqid("val");

        $fixture::setOne($key, $val);

        $this->assertSame($val, $fixture::getOne($key));
    }

    public function testToArray()
    {
        $fixture = $this->getFixtureName();

        $this->assertSame($this->fixtureDefaultState, $fixture::toArray());
    }
}
