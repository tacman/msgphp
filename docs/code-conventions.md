# Code conventions

A brief description of code conventions this project follows.

## General principles

- No [SOLID] violations, yet be pragmatic
- Reduce [lines of code] where possible
- Reduce coupling ([law of demeter])
- Favor latest stable PHP7 features
- Checks must pass (code style, static analysis & unit tests)
- Add PHPDoc / comments if needed for clarification or static analysis

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
- Exclude / ignore rules are discussed per case/topic

## PHP 7.x forward compatibility

- Intended object values are type hinted (`@param object $value` and `@return object`)

## Unit tests

- All of the above, _in general_, applies to unit tests as well

[SOLID]: https://en.wikipedia.org/wiki/SOLID_(object-oriented_design)
[lines of code]: https://en.wikipedia.org/wiki/Source_lines_of_code
[law of demeter]: https://en.wikipedia.org/wiki/Law_of_Demeter
[PSR2]: https://www.php-fig.org/psr/psr-2/
[Symfony style]: https://symfony.com/doc/master/contributing/code/standards.html
[PHPStan]: https://github.com/phpstan/phpstan
