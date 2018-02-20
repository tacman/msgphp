# Doctrine Object Relational Mapper

An overview of available infrastructural code when using Doctrine's [Object Relational Mapper](http://www.doctrine-project.org/projects/orm.html).

- Requires [`doctrine/orm`](https://packagist.org/packages/doctrine/orm)

## Domain identity mapping

A Doctrine tailored [domain identity mapping](../ddd/identity-mapping.md) is provided by
`MsgPhp\Domain\Infra\Doctrine\DomainIdentityMapping`. It uses Doctrine's entity manager, bound to
`Doctrine\ORM\EntityManagerInterface`, as underlying mapping.

- `__construct(EntityManagerInterface $em)`
    - `$em`: The entity manager to use

### Basic example

```php
<?php

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use MsgPhp\Domain\Infra\Doctrine\DomainIdentityMapping;

// --- SETUP ---

/** @ORM\Entity() */
class MyCompositeEntity
{
    /** @ORM\Id @ORM\Column(type="string") */
    public $name;

    /** @ORM\Id @ORM\Column(type="integer") */
    public $year;
}

/** @var EntityManagerInterface $em */
$em = ...;
$mapping = new DomainIdentityMapping($em);
```

## Domain repository

A Doctrine tailored [repository trait](../ddd/repositories.md) is provided by
`MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait`. It uses Doctrine's entity manager, bound to
`Doctrine\ORM\EntityManagerInterface`, as underlying persistence layer.

- `__construct(string $class, EntityManagerInterface $em, DomainIdentityHelper $identityHelper = null)`
    - `$class`: The entity class this repository is tied to
    - `$em`: The entity manager to use
    - `$identityHelper`: Custom domain identity helper. By default it's resolved from the given entity manager.
      [Read more](../ddd/identities.md).

### Basic example

```php
<?php

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;

// --- SETUP ---

/** @ORM\Entity() */
class MyCompositeEntity
{
    /** @ORM\Id @ORM\Column(type="string") */
    public $name;

    /** @ORM\Id @ORM\Column(type="integer") */
    public $year;
}


class MyCompositeEntityRepository
{
    use DomainEntityRepositoryTrait {
        doFind as public find;
        doExists as public exists;
        doSave as public save;
    }
}

/** @var EntityManagerInterface $em */
$em = ...;
$repository = new MyCompositeEntityRepository(MyCompositeEntity::class, $em);

// --- USAGE ---

if ($repository->exists($id = ['name' => ..., 'year' => ...])) {
    $entity = $repository->find($id);
} else {
    $entity = new MyCompositeEntity();
    $entity->name = ...;
    $entity->year = ...;

    $repository->save($entity);
}
```

## Hydration

TODO

## Entity reference loader

TODO

## Object field mappings

TODO + sf infra
