# PHP: NameOf

This is a library to get the name of a variable. Some example usages:

```php
enum Foo {
    case Bar;
    case Baz;
}

$arr = [];
$arr[nameof(Foo::Bar)] = 1; // resolves to 'Bar'
```

For compact:

```php
$var = 1;
$bar = 2;
echo (compact(nameof($var), nameof($bar))); // ['var' => 1, 'bar' => 2]
```

## Why?

This is useful when you want to use the name of a variable in a string, but want to retain easier refactoring. For
example, normally when using compact you end up with a 'magic string' that references a variable name. However, this can
be a problem if you want to refactor the variable name, as you have to change the string as well. This library allows
you to use the nameof function to get the name of the variable, and then use that in the compact function. You can also
use this for enum keys, and other places where you want to use the name of a variable.

## Installation

```bash
composer require withinboredom/nameof
```

## Example output

Here are some examples and their output, note that no error will be thrown if you pass it weird things because it isn't
doing any parsing to make sure you are only passing sensible things.

```php
echo nameof(1); // 1
echo nameof($myCallback(...)); // myCallback
echo nameof($x->prop); // prop
echo nameof($x->prop->fun(...)) // fun
```
