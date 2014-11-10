<?php

namespace Keradus\Traits\Tests\Test;

class PropertyTrait extends \Keradus\Traits\Tests\PHPUnit\TestCase
{
    protected $fixture;
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
        $name = $this->getFixtureName();
        $this->fixture = new $name();
        $this->fixture->set($this->fixtureDefaultState);
    }

    public function testGetByArray()
    {
        $this->assertSame($this->fixtureDefaultState, $this->fixture->get(array_keys($this->fixtureDefaultState)));
    }

    public function testGetByList()
    {
        $this->assertSame(
            [
                "a" => $this->fixtureDefaultState["a"],
                "b" => $this->fixtureDefaultState["b"],
            ],
            $this->fixture->get("a", "b")
        );
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testGetByNoParameter()
    {
        $this->fixture->get();
    }

    public function testGetBySingle()
    {
        $this->assertSame($this->fixtureDefaultState["a"], $this->fixture->get("a"));
    }

    public function testGetOne()
    {
        foreach ($this->fixtureDefaultState as $key => $val) {
            $this->assertSame($val, $this->fixture->getOne($key));
        }
    }

    public function testGetOneNonExisting()
    {
        $this->assertSame(null, $this->fixture->getOne("aaaaaaaaaa"));
    }

    public function testGetOneNonExistingWithDefaultValue()
    {
        $this->assertSame("bbbbbbbbbb", $this->fixture->getOne("aaaaaaaaaa", "bbbbbbbbbb"));
    }

    public function testGetOneWithDefaultValue()
    {
        foreach ($this->fixtureDefaultState as $key => $val) {
            $this->assertSame($val, $this->fixture->getOne($key, "bbbbbbbbbb"));
        }
    }

    public function testHasOne()
    {
        foreach ($this->fixtureDefaultState as $key => $val) {
            $this->assertTrue($this->fixture->hasOne($key));
        }
    }

    public function testHasOneNonExisting()
    {
        $this->assertSame(false, $this->fixture->hasOne("aaaaaaaaaa"));
    }

    public function testRemoveAll()
    {
        $this->fixture->removeAll();

        $this->assertEmpty($this->fixture->toArray());
    }

    public function testRemoveByArray()
    {
        $this->fixture->remove(["a", "b", ]);

        $this->assertFalse($this->fixture->hasOne("a"));
        $this->assertFalse($this->fixture->hasOne("b"));
    }

    public function testRemoveByList()
    {
        $this->fixture->remove("a", "b");

        $this->assertFalse($this->fixture->hasOne("a"));
        $this->assertFalse($this->fixture->hasOne("b"));
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testRemoveByNoParameter()
    {
        $this->fixture->remove();
    }

    public function testRemoveBySingle()
    {
        $this->fixture->remove("a");

        $this->assertFalse($this->fixture->hasOne("a"));
    }

    public function testRemoveOne()
    {
        $this->fixture->removeOne("b");

        $this->assertFalse($this->fixture->hasOne("b"));
    }

    public function testRemoveOneForAll()
    {
        foreach ($this->fixtureDefaultState as $key => $val) {
            $this->fixture->removeOne($key);
        }

        $this->assertEmpty($this->fixture->toArray());
    }

    public function testSetByArray()
    {
        $values = [
            uniqid() => uniqid(),
            uniqid() => uniqid(),
            uniqid() => uniqid(),
        ];

        $this->fixture->set($values);

        $this->assertSame(
            $values,
            $this->fixture->get(array_keys($values))
        );
    }

    public function testSetByArrayAndArray()
    {
        $keys = [ uniqid(), uniqid(), uniqid(), ];
        $values = [ uniqid(), uniqid(), uniqid(), ];

        $this->fixture->set($keys, $values);

        $this->assertSame(
            array_combine($keys, $values),
            $this->fixture->get($keys)
        );
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByArrayAndDifferSizeArray()
    {
        $keys = [ uniqid(), uniqid(), ];
        $values = [ uniqid(), uniqid(), uniqid(), ];

        $this->fixture->set($keys, $values);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByArrayAndString()
    {
        $this->fixture->set([1, 2], 3);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByNoParameter()
    {
        $this->fixture->set();
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByOneParameter()
    {
        $this->fixture->set(1);
    }

    public function testSetByStringAndString()
    {
        $key = uniqid("key");
        $val = uniqid("val");

        $this->fixture->set($key, $val);

        $this->assertSame($val, $this->fixture->getOne($key));
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetByThreeParameters()
    {
        $this->fixture->set(1, 2, 3);
    }

    public function testSetOne()
    {
        $key = uniqid("key");
        $val = uniqid("val");

        $this->fixture->setOne($key, $val);

        $this->assertSame($val, $this->fixture->getOne($key));
    }

    public function testToArray()
    {
        $this->assertSame($this->fixtureDefaultState, $this->fixture->toArray());
    }
}
