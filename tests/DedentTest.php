<?php

declare(strict_types=1);

use function ExeQue\Dedent\dedent;

it('dedents', function (string $input, string $expected) {
    $actual = dedent($input);

    expect($actual)->toBe($expected);
})->with([
    'dedents string with spaces'                     => [
        'input'    => "
        Hello World
            - This is a list
        This is a test",
        'expected' => "
Hello World
    - This is a list
This is a test",
    ],
    'dedents string with tabs (default 4 wide tabs)' => [
        'input'    => "
\tHello World
\t\t- This is a list
\tThis is a test",
        'expected' => "
Hello World
    - This is a list
This is a test",
    ],
]);

it('uses differing tab widths', function (string $input, string $expected, int $tabWidth) {
    $actual = dedent($input, $tabWidth);

    expect($actual)->toBe($expected);
})->with([
    '2 wide tabs' => [
        'input'    => "
\tHello World
\t\t- This is a list
\tThis is a test",
        'expected' => "
Hello World
  - This is a list
This is a test",
        'tabWidth' => 2,
    ],
    '4 wide tabs' => [
        'input'    => "
\tHello World
\t\t- This is a list
\tThis is a test",
        'expected' => "
Hello World
    - This is a list
This is a test",
        'tabWidth' => 4,
    ],
    '8 wide tabs' => [
        'input'    => "
\tHello World
\t\t- This is a list
\tThis is a test",
        'expected' => "
Hello World
        - This is a list
This is a test",
        'tabWidth' => 8,
    ],
]);

it('does not touch indents if any line does not start with a space', function (string $input) {
    $actual = dedent($input);

    expect($actual)->toBe($input);
})->with([
    'no indent on first line'  => [
        'input' => "
Hello World
    - This is a list
This is a test",
    ],
    'no indent on middle line' => [
        'input' => "
    Hello World
- This is a list
    This is a test",
    ],
    'no indent on last line'   => [
        'input' => "
    Hello World
    - This is a list
This is a test",
    ],
]);

it('leaves a line blank if it is pure whitespace', function() {
    $input = "
    Hello World
    
The line above is blank but has whitespace";

    $expected = "
    Hello World

The line above is blank but has whitespace";

    $actual = dedent($input);
    expect($actual)->toBe($expected);
});