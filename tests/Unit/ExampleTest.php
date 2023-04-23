<?php

use function Withinboredom\NameOf\nameof;

it('gets the name of a variable', function() {
    $fancy_name = '';
    expect(nameof($fancy_name))->toBe('fancy_name');
});

it('get the name of a variable in a closure', function() {
    $fancy_name = '';
    $closure = function() use ($fancy_name) {
        expect(nameof($fancy_name))->toBe('fancy_name');
    };
    $closure();
});

enum Test {
    case A;
    case B;

    public function thing(): string {
        return nameof($this);
    }
}

it('gets the name of an enum', function() {
    expect(nameof(Test::A))->toBe('Test::A');
});

it('gets the name of function call', function() {
    expect(nameof(Test::A->thing()))->toBe('Test::A->thing()');
});

it('gets the name of a variable with a call', function () {
    $a = Test::A;
    expect(nameof($a->thing()))->toBe('a->thing()');
});

it('fails when there are two calls to nameof on the same line', function() {
    $a = Test::A;
    expect(fn() => nameof($a->thing()) . nameof($a))->toThrow(\LogicException::class);
});

it('handles wordpress style function calls', function() {
    $a = Test::A;
    expect(nameof( $a ))->toBe('a');
});

it('handles even more spaces ...', function() {
    $a = Test::A;
    expect(nameof   ( $a))->toBe('a');
});