# Doctrine Object Relational Mapper

An overview of available infrastructural code when using [Doctrine Object Relational Mapper](http://www.doctrine-project.org/projects/orm.html).

- Requires [`doctrine/orm`](https://packagist.org/packages/doctrine/orm)

## Domain identity mapping

A Doctrine tailored [domain identity mapping](../ddd/identity-mapping.md) is provided by
`MsgPhp\Domain\Infra\Doctrine\DomainIdentityMapping`. It uses Doctrine's entity manager, bound to
`Doctrine\ORM\EntityManagerInterface`, directly.

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

$compositeEntity = new MyCompositeEntity();
$compositeEntity->name = ...;
$compositeEntity->year = ...;

/** @var EntityManagerInterface $em */
$em = ...;
$em->persist($compositeEntity);
$em->flush();

$mapping = new DomainIdentityMapping($em);
```
