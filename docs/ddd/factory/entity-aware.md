# Entity aware factory

An entity aware factory is an [object factory](object.md) and additionally bound to
`MsgPhp\Domain\Factory\EntityAwareFactoryInterface`. Its purpose is to factorize entity related objects.

## API

### `create(string $class, array $context = []): object`

Inherited from `MsgPhp\Domain\Factory\DomainObjectFactoryInterface::create()`.

---

### `reference(string $class, $id): object`

Factorize a reference object for a known existing entity object. The object must be of type `$class`. Any type of
[identity](../identities.md) value can be passed as `$id`.

---

### `identify(string $class, $value): DomainIdInterface`

Factorize an [identifier](../identifiers.md) for the given entity class from a known primitive value.

---

### `nextIdentifier(string $class): DomainIdInterface`

Factorize the next [identifier](../identifiers.md) for the given entity class. Depending on the implementation its value
might be considered empty if it's not capable to calculate one upfront.

## Implementations

### `MsgPhp\Domain\Factory\EntityAwareFactory`

A generic entity factory. It decorates any object factory and additionally must be provided with an entity to identifier
class mapping.

- `__construct(DomainObjectFactoryInterface $factory, array $identifierMapping, callable $referenceLoader = null)`
    - `$factory`: The decorated object factory
    - `$identifierMapping`: The identifier class mapping (`['EntityClass' => 'IdClass']`)
    - `$referenceLoader`: An optional reference loader. If `null` using `reference()` is not supported. The callable
      receives the same arguments as given to `reference()`. It should return an instance of the received class name.

#### Basic example

```php
<?php

use MsgPhp\Domain\Factory\{DomainObjectFactory, EntityAwareFactory};
use MsgPhp\Domain\Infra\Uuid\DomainId as DomainUuid;

// --- SETUP ---

class MyEntity
{
    public $id;
}

$factory = new EntityAwareFactory(new DomainObjectFactory(), [
    MyEntity::class => DomainUuid::class,
], function (string $class, $id) {
    $object = new $class();
    $object->id = $id;

    return $object;
});

// --- USAGE ---

/** @var MyEntity $entity */
$ref = $factory->reference(MyEntity::class, new DomainUuid());

/** @var DomainUuid $id */
$id = $factory->identify(MyEntity::class, 'cf3d2f85-6c86-44d1-8634-af51c91a9a74');

/** @var DomainUuid $id */
$id = $factory->nextIdentifier(MyEntity::class);
```
