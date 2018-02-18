# Repositories

A repository is not interface bound by default. Instead you can leverage various trait objects to rapidly create one, 
depending on the type of infrastructure needed. By design they follow the same API although there might be subtle
differences per implementation.

Note default (interface bound) repositories are provided per domain layer.

## API

> Exposed `private` as a trait. You can decide to [change method visibility](https://secure.php.net/manual/en/language.oop5.traits.php#language.oop5.traits.visibility)
on a per case basis.

### `doFindAll(int $offset = 0, int $limit = 0): DomainCollectionInterface`

Find all entities available.

---

### `doFindAllByFields(array $fields, int $offset = 0, int $limit = 0): DomainCollectionInterface`

Find all entities matching all specified fields. Supported field values should be `null`, `scalar`, `array` (one of)
and `object` (foreign entity or [identifier](identifiers.md)).

---

### `doFind($id): object`

Find a single entity by its identity. Supported identity values should be `scalar`, `array` (composite [identity](identities.md))
and `object` (foreign entity or [identifier](identifiers.md)).

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

- `MsgPhp\Domain\Infra\InMemory\DomainEntityRepositoryTrait`
    - In-memory persistence
- `MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait`
    - Doctrine persistence
    - Requires [`doctrine/orm`](https://packagist.org/packages/doctrine/orm)

## Generic Doctrine repository example

```php
<?php

use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use Doctrine\ORM\EntityManagerInterface;

class MyGenericRepository
{
    use DomainEntityRepositoryTrait {
        doFind as public find;
    }
}

/** @var EntityManagerInterface $em */
$em = ...;

$repository = new MyGenericRepository(MyEntity::class, $em); 

/** @var MyEntity $entity */
$entity = $repository->find(1);
```
