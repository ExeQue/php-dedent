# PHP Dedent

Dedent is a simple PHP library that removes leading whitespace from a string. It is useful for removing indentation from multi-line strings.

## Installation

You can install Dedent using Composer:

```bash
composer require exeque/php-dedent
```

## Usage

### Basic Usage
Dedent can be used through the `Dedent` class or the `dedent` function.

```php
use Exeque\Dedent\Dedent;

$output = Dedent::dedent($input);
// or
$output = dedent($input);
```

```php
use Exeque\Dedent\Dedent;

$input = <<<INPUT
    This is a multi-line string.
    It has leading whitespace that we want to remove.
        - This line has extra indentation that we want to keep.
INPUT;

$output = dedent($input);

// $output:
// This is a multi-line string.
// It has leading whitespace that we want to remove.
//     - This line has extra indentation that we want to keep.
```

### Tabbed Input
Dedent replaces tabs with spaces by default (1 tab -> 4 spaces). You can change the number of spaces per tab by passing a second argument to the `dedent` method.

```php
use Exeque\Dedent\Dedent;

$input = <<<INPUT
\tThis is a multi-line string.
\tIt has leading whitespace that we want to remove.
\t\t- This line has extra indentation that we want to keep.
INPUT;

$output = dedent($input);

// $output:
// This is a multi-line string.
// It has leading whitespace that we want to remove.
//     - This line has extra indentation that we want to keep.

// or with custom tab width

$output = dedent($input, 2);

// $output:
// This is a multi-line string.
// It has leading whitespace that we want to remove.
//   - This line has extra indentation that we want to keep.
```

## Testing

You can run the tests using Pest:

```bash
composer test
```

## License

Dedent is open-sourced software licensed under the [MIT license](LICENSE.md).