# Entity factories

An entity factory is a domain object factory and is bound to `MsgPhp\Domain\Factory\EntityFactoryInterface`.
Besides initializing the entity via `create()` it can also initialize an identifier using either `identify()` or 
`nextIdentity()`.

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

### `nextIdentity(string $class): DomainIdInterface`

Returns the next identifier for the given entity. Depending on the identifier implementation its value might be 
considered empty in case it's not capable to calculate a value upfront.

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
$factory->nextIdentity(MyEntity::class)->isEmpty(); // true

/** @var DomainUuid $object */
$otherEntityId = $factory->identify(MyOtherEntity::class, 'cf3d2f85-6c86-44d1-8634-af51c91a9a74');
$factory->nextIdentity(MyOtherEntity::class)->isEmpty(); // false
```
