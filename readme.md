# PHP: NameOf

This is a library to get the name of a variable. Some example usages:

```php
enum Foo {
    case Bar;
    case Baz;
}

$arr = [];
$arr[nameof(Foo::Bar)] = 1;
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

## Warning

There may be performance issues with this library since it uses `debug_backtrace` and reads the original source file to
extract the variable name. This is not a problem for most use cases, but if you are using this in a performance critical
path, you may want to consider a different approach.

Note that this library will take virtually anything as a variable name, so you can give it things that make no sense:

```php
echo nameof(1); // 1
echo nameof($myCallback()); // myCallback()
echo nameof($x->prop); // x->prop
echo nameof($x->prop->fun()) // x->prop->fun()
```
