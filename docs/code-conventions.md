# Code conventions

A brief description of code conventions this project follows.

## General principles

- Follows [SOLID] principles
- Reduce [lines of code] where possible
- Reduce coupling ([law of demeter])
- Favor latest stable PHP7 features
- Checks must pass (code style, static analysis & unit tests)

## Code style

- Follows [PSR2] with [Symfony style]
- `use` statements are declared in alpha-order
- `use` statements for `MsgPhp\` namespace are grouped by deepest common namespace

```php
<?php

// wrong

use MsgPhp\SomeB;
use MsgPhp\SomeA;
use MsgPhp\Some\SomeC;
use Other\SomeOtherB;
use Other\Some\SomeOtherC;
use Other\SomeOtherA;

// right

use MsgPhp\Some\SomeC;
use MsgPhp\{SomeA, SomeB};
use Other\Some\SomeOtherC;
use Other\SomeOtherA;
use Other\SomeOtherB;
```

## Static analysis

- Follows [PHPStan] level max
- Exclude- and ignore-rules are discussed per case / topic

## PHPDoc

- Add comments if needed for either clarification or static analysis (might result in e.g. partial `@param` annotations)
- Inline `@var` annotations (`/** @var Some $some*/`)
- Interfaces must have a description with its purpose (at the class- as well as the method-level)
- No usage of `@inheritdoc`

## PHP 7.2 forward compatibility

- Intended object values are type hinted (`@param object $value` and `@return object`)

## Unit tests

- All of the above, _in general_, applies to unit tests as well

[SOLID]: https://en.wikipedia.org/wiki/SOLID_(object-oriented_design)
[lines of code]: https://en.wikipedia.org/wiki/Source_lines_of_code
[law of demeter]: https://en.wikipedia.org/wiki/Law_of_Demeter
[PSR2]: https://www.php-fig.org/psr/psr-2/
[Symfony style]: https://symfony.com/doc/master/contributing/code/standards.html
[PHPStan]: https://github.com/phpstan/phpstan
