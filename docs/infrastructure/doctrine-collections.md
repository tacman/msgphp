# Doctrine Collections

An overview of available infrastructural code when using [Doctrine Collections](http://www.doctrine-project.org/projects/collections.html).

- Requires [`doctrine/collections`](https://packagist.org/packages/doctrine/collections)

## Domain collection

A Doctrine tailored [domain collection](../ddd/collections.md) is provided by `MsgPhp\Domain\Infra\Doctrine\DomainCollection`.
It leverages type `Doctrine\Common\Collections\Collection` as underlying data type.

- `__construct(Collection $collection)`
    - `$collection`: The underlying collection

### Basic example

```php
<?php

use Doctrine\Common\Collections\ArrayCollection;
use MsgPhp\Domain\Infra\Doctrine\DomainCollection;

// --- SETUP ---

$collection = new DomainCollection(new ArrayCollection([1, 2, 3]));

// static

$collection = DomainCollection::fromValue([1, 2, 3]);
```
