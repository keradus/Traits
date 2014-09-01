Ker-Traits
==========

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
