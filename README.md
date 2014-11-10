Traits
==========
[![Latest Stable Version](https://poser.pugx.org/keradus/traits/v/stable.svg)](https://packagist.org/packages/keradus/traits)
[![Latest Unstable Version](https://poser.pugx.org/keradus/traits/v/unstable.svg)](https://packagist.org/packages/keradus/traits)
[![Build status](http://img.shields.io/travis/keradus/Traits/master.svg)](https://travis-ci.org/keradus/Traits)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/97573120-b091-4bc0-8994-7ecb54fab181/mini.png)](https://insight.sensiolabs.com/projects/97573120-b091-4bc0-8994-7ecb54fab181)

Traits - general usage traits.

Traits List
-----------

### InaccessiblePropertiesProtectorTrait

Trait, that protects accessing inaccessible (unknown) properties to help keeping code clean and safe.

```php
class Foo
{
    public $baz;
}

$foo = new Foo();
$foo->vaz = 123; // PHP claims that code is OK, even if you misspelled variable name!

class Bar
{
    use InaccessiblePropertiesProtectorTrait;

    public $baz;
}

$bar = new Bar();
$bar->vaz = 123; // now PHP throws \LogicException
```

### InnerClassCacheTrait

Trait, that adds functionality of inner class cache.

```php
class Foo
{
    use InnerClassCacheTrait;

    public function square($x)
    {
        if (!isset($this->cache[$x])) {
            $this->cache[$x] = $x * $x;
        }

        return $this->cache[$x];
    }
}
```
