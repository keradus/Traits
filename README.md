Ker-Traits
==========
[![Package version](http://img.shields.io/packagist/v/keradus/ker-traits.svg)](https://packagist.org/packages/keradus/ker-traits)
[![Build status](http://img.shields.io/travis/keradus/Ker-Traits/master.svg)](https://travis-ci.org/keradus/Ker-Traits)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/97573120-b091-4bc0-8994-7ecb54fab181/mini.png)](https://insight.sensiolabs.com/projects/97573120-b091-4bc0-8994-7ecb54fab181)

Ker-Traits - general usage traits. Part of Ker library

Traits List
-----------

###InaccessiblePropertiesProtectorTrait

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
    use \Ker\InaccessiblePropertiesProtectorTrait;
    public $baz;
}

$bar = new Bar();
$bar->vaz = 123; // now PHP throws \LogicException
```
