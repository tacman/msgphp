# Entity factories

An entity factory is a domain object factory and is bound to `MsgPhp\Domain\Factory\EntityFactoryInterface`.
Besides initializing the entity via `create()` it can also initialize an identifier using either `identify()` or 
`nextIdentifier()`.

## Implementations

### `MsgPhp\Domain\Factory\EntityFactory`

Generic entity factory and decorates any object factory. Additionally it must be provided with the identifier class 
mapping.

## API

### `create(string $class, array $context = []): object`

Inherited from `MsgPhp\Domain\Factory\DomainObjectFactoryInterface::create()`.

---

### `identify(string $class, $id): DomainIdInterface`

Returns an identifier for the given entity class from a known primitive value.

---

### `nextIdentifier(string $class): DomainIdInterface`

Returns the next identifier for the given entity class. Depending on the implementation its value might be considered
empty if it's not capable to calculate one upfront.

## Generic example

```php
<?php

use MsgPhp\Domain\Factory\EntityFactory;
use MsgPhp\Domain\DomainId;
use MsgPhp\Domain\Infra\Uuid\DomainId as DomainUuid;

$realFactory = ...;

$factory = new EntityFactory([
    MyEntity::class => DomainId::class,
    MyOtherEntity::class => DomainUuid::class,
], $realFactory);

/** @var DomainId $object */
$entityId = $factory->identify(MyEntity::class, '1');
$factory->nextIdentifier(MyEntity::class)->isEmpty(); // true

/** @var DomainUuid $object */
$otherEntityId = $factory->identify(MyOtherEntity::class, 'cf3d2f85-6c86-44d1-8634-af51c91a9a74');
$factory->nextIdentifier(MyOtherEntity::class)->isEmpty(); // false
```
