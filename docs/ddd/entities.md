# Entities

Entity objects are provided per domain layer and usually follow a [POPO] design. To simplify its definition common
fields and features are provided in the form of PHP [traits]. Fields can be compared to a read-operation, whereas
features represent a read/write-operation.

They are defined in a dedicated namespace for discovery, respectively `Msgphp\Domain\Entity\Fields\` and
`MsgPhp\Domain\Entity\Features\`.

## Basic Example

```php
<?php

use MsgPhp\Domain\Entity\Fields\CreatedAtField;
use MsgPhp\Domain\Entity\Features\CanBeEnabled;

// --- SETUP ---

class MyEntity
{
    use CreatedAtField;
    use CanBeEnabled;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}

// --- USAGE ---

$entity = new MyEntity();
$createdAt = $entity->getCreatedAt();

if (!$entity->isEnabled()) {
    $entity->enable();
}
```

!!! note
    See the [reference](../reference/entities.md#msgphpdomain) page for all available entity fields and features

[POPO]: https://stackoverflow.com/questions/41188002/what-does-the-term-plain-old-php-object-popo-exactly-mean
[traits]: https://secure.php.net/traits
