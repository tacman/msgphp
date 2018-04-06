# Code Conventions

A brief description of code conventions this project follows.

## General Principles

- Follows [SOLID] principles
- Reduce [lines of code] where possible
- Reduce coupling ([Law of Demeter])
- Favor latest stable PHP7 features
- Checks must pass (code style, static analysis & unit tests)

## Code Style (CS)

- Follows [PSR-2] with [Symfony Style]
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

## Static Analysis (SA)

- Follows [PHPStan] level max
- Exclude- and ignore-rules are discussed per case / topic

## PHPDoc

- Add comments if needed for either clarification or static analysis (might result in e.g. partial `@param` annotations)
- Inline `@var` annotations (`/** @var Some $some*/`)
- Interfaces must have a description with its purpose (at the class- as well as the method-level)
- No usage of `@inheritdoc`

## PHP 7.2 Forward Compatibility

- Intended object values are type hinted (`@param object $value` and `@return object`)

## Unit Tests

- All of the above, _in general_, apply to unit tests as well

[SOLID]: https://en.wikipedia.org/wiki/SOLID_(object-oriented_design)
[lines of code]: https://en.wikipedia.org/wiki/Source_lines_of_code
[Law of Demeter]: https://en.wikipedia.org/wiki/Law_of_Demeter
[PSR-2]: https://www.php-fig.org/psr/psr-2/
[Symfony Style]: https://symfony.com/doc/master/contributing/code/standards.html
[PHPStan]: https://github.com/phpstan/phpstan
