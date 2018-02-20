# Static factory

A static factory is a utility class, it cannot be initialized as a new instance using `new ...();`. Its purpose is to
factorize a known implementation for a given class.

## Implementations

### `MsgPhp\Domain\Factory\DomainIdFactory`

Factorizes an [identifier](../identifiers.md).

- `static create($value): DomainIdInterface`
    - `$value`: Any (primitive) identifier value

#### Basic example

```php
<?php

use MsgPhp\Domain\DomainId;
use MsgPhp\Domain\Factory\DomainIdFactory;
use MsgPhp\Domain\Infra\Uuid\DomainId as DomainUuid;

// --- USAGE ---

/** @var DomainId $id */
$id = DomainIdFactory::create(1);

/** @var DomainUuid $id */
$id = DomainIdFactory::create('cf3d2f85-6c86-44d1-8634-af51c91a9a74');
```

### `MsgPhp\Domain\Factory\DomainCollectionFactory`

Factorizes a [collection](../collections.md).

- `static create(?iterable $value): DomainCollectionInterface`
    - `$value`: Any (primitive) iterable value or `null` to imply an empty collection

#### Basic example

```php
<?php

use MsgPhp\Domain\DomainCollection;
use MsgPhp\Domain\Factory\DomainCollectionFactory;
use MsgPhp\Domain\Infra\Doctrine\DomainCollection as DoctrineDomainCollection;

// --- USAGE ---

/** @var DomainCollection $collection */
$collection = DomainCollectionFactory::create([1, 2, 3]);

/** @var DoctrineDomainCollection $collection */
$collection = DomainCollectionFactory::create([1, 2, 3]);
```
