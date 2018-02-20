# Identity mapping

An identity mapping is a domain service and is bound to `MsgPhp\Domain\DomainIdentityMappingInterface`. It tells about
the identifier metadata for a known domain object.

## API

### `getIdentifierFieldNames(string $class): array`

Returns the identifier field names for `$class`. Any instance should have an identity composed of these field values.

---

### `getIdentity(object $object): array`

Returns the actual, non empty, identifier values of `$object`. Each identifier value is keyed by its corresponding
identifier field name.

## Implementations

### `MsgPhp\Domain\Infra\InMemory\DomainIdentityMapping`

Identity mapping based on a known in-memory mapping.

#### Basic example

```php
<?php

use MsgPhp\Domain\Infra\InMemory\DomainIdentityMapping;

// --- SETUP ---

class MyEntity
{
    public $id;
}

class MyCompositeEntity
{
    public $name;
    public $year;
}

$entity = new MyEntity();
$entity->id = ...;

$compositeEntity = new MyCompositeEntity();
$compositeEntity->name = ...;
$compositeEntity->year = ...;

$mapping = new DomainIdentityMapping([
    MyEntity::class => 'id',
    MyCompositeEntity::class => ['car', 'year'],
]);

// --- USAGE ---

$mapping->getIdentifierFieldNames(MyEntity::class); // ['id']
$mapping->getIdentifierFieldNames(MyCompositeEntity::class); // ['car', 'year']

$mapping->getIdentity($entity); // ['id' => ...]
$mapping->getIdentity($entity); // ['car' => ..., 'year' => ...]
```

### `MsgPhp\Domain\Infra\Doctrine\DomainIdentityMapping`

Identity mapping based on Doctrine's identity map.

- [Read more](../infrastructure/doctrine-orm.md#domain-identity-mapping)
