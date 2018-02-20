# Repositories

A domain repository is not interface bound by default. Instead you can leverage a trait object, tied to specific
infrastructure (e.g. Doctrine), to rapidly create one. This page describes the suggested API for any specific repository
trait and the one used by default implementations.

## API

> Exposed `private` as a trait. You can decide to [change method visibility](https://secure.php.net/manual/en/language.oop5.traits.php#language.oop5.traits.visibility)
on a per case basis.

### `doFindAll(int $offset = 0, int $limit = 0): DomainCollectionInterface`

Find all entities available. An unlimited collection is implied by `$limit` set to zero.

---

### `doFindAllByFields(array $fields, int $offset = 0, int $limit = 0): DomainCollectionInterface`

Find all entities matching all specified fields. Supported field values should be `null`, `scalar`, `array` (one of a
known literal list) and `object` (foreign entity or an [identifier](identifiers.md)). An unlimited collection is implied
by `$limit` set to zero.

---

### `doFind($id): object`

Find a single entity by its identity. Supported identity values should be `scalar`, `array` (composite [identity](identities.md))
and `object` (foreign entity or an [identifier](identifiers.md)).

---

### `doFindByFields(array $fields): object`

Find the first entity matching all specified fields. See `doFindAllByFields()` for supported field values.

---

### `doExists($id): bool`

Verify if an entity exists by its identity. See `doFind()` for supported identity values.

---

### `doExistsByFields(array $fields): bool`

Verify if an entity exists matching all specified fields. See `doFindAllByFields()` for supported field values.

---

### `doSave(object $entity): void`

Persist an entity in the identity map. The entity will be available on any subsequent query.

---

### `doDelete(object $entity): void`

Remove an entity from the identity map. The entity will be unavailable on any subsequent query.

## Implementations

### `MsgPhp\Domain\Infra\InMemory\DomainEntityRepositoryTrait`

Repository trait based on in-memory persistence.

- `__construct(string $class, DomainIdentityHelper $identityHelper, GlobalObjectMemory $memory = null, ObjectFieldAccessor $accessor = null)`
    - `$class`: The entity class this repository is tied to
    - `$identityHelper`: The domain identity helper. [Read more](identities.md).
    - `$memory`: Custom memory layer. By default the same global pool is used. See also [GlobalObjectMemory](https://msgphp.github.io/api/MsgPhp/Domain/Infra/InMemory/GlobalObjectMemory.html).
    - `$accessor`: Custom object field accessor. See also [GlobalObjectMemory](https://msgphp.github.io/api/MsgPhp/Domain/Infra/InMemory/ObjectFieldAccessor.html).

#### Basic example

```php
<?php

use MsgPhp\Domain\DomainIdentityHelper;
use MsgPhp\Domain\Infra\InMemory\{DomainIdentityMapping, DomainEntityRepositoryTrait};

// --- SETUP ---

class MyEntity
{
    public $id;
}

class MyEntityRepository
{
    use DomainEntityRepositoryTrait {
        doFind as public find;
        doExists as public exists;
        doSave as public save;
    }
}

$helper = new DomainIdentityHelper(new DomainIdentityMapping([
   MyEntity::class => 'id',
]));

$repository = new MyEntityRepository(MyEntity::class, $helper);

// --- USAGE ---

if ($repository->exists(1)) {
    $entity = $repository->find(1);
} else {
    $entity = new MyEntity();
    $entity->id = 1;

    $repository->save($entity);
}
```

### `MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait`

Repository trait based on _Doctrine ORM_ persistence.

- [Read more](../infrastructure/doctrine-orm.md#domain-repository)
