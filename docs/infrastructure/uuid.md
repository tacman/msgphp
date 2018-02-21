# Universally Unique Identifier

An overview of available infrastructural code when working with [UUID's][uuid].

- Requires [ramsey/uuid]

## Domain identifier

A UUID tailored [domain identifier](../ddd/identifiers.md) is provided by `MsgPhp\Domain\Infra\Uuid\DomainId`. It
leverages type `Ramsey\Uuid\UuidInterface` as underlying data type.

- `__construct(UuidInterface $uuid = null)`
    - `$uuid`: The underlying UUID. In case of `null` a UUID version 4 value is generated upfront. Meaning the
      identifier will never be considered empty.

### Basic example

```php
<?php

use MsgPhp\Domain\Infra\Uuid\DomainId;
use Ramsey\Uuid\Uuid;

// --- SETUP ---

$id = new DomainId(); // a new UUID version 4 value
$id = new DomainId(Uuid::uuid1()); // UUID version 1 value
$id = new DomainId(Uuid::fromString('00000000-0000-0000-0000-000000000000')); // Nil UUID value

// static

$id = DomainId::fromValue('00000000-0000-0000-0000-000000000000'); 
```

[uuid]: https://en.wikipedia.org/wiki/Universally_unique_identifier
[ramsey/uuid]: https://packagist.org/packages/ramsey/uuid
