# Configuring Doctrine ORM

After a [bundle](bundle-installation.md) is installed we can configure [Doctrine ORM](../infrastructure/doctrine-orm.md).

## Installation

```bash
composer install doctrine/orm doctrine/doctrine-bundle

# using Symfony Flex
composer install orm
```

## Configuration

See the Doctrine Bundle [recipe configuration] for the minimal configuration to put in `config/packages/doctrine.yaml`.

Although the examples use annotation based mappings, you are not required to do so. [Read more][doctrine-bundle-mapping-config].

_The configuration is added automatically when using Symfony Flex._

## Mapping Entities

A MsgPHP bundle provides base entity models in the form of [mapped superclasses]. An actual entity object must be
defined by your application:

```php
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use MsgPhp\SomeDomain\Entity\SomeEntity as BaseSomeEntity;

/**
 * @ORM\Entity()
 */
class SomeEntity extends BaseSomeEntity
{
    // ...
}
```

Let MsgPHP know about your entity:

```yaml
msgphp_<name>:
    # ...
    class_mapping:
        MsgPhp\SomeDomain\Entity\SomeEntity: App\Entity\SomeEntity
```

See also the [reference](../reference/entities.md) page for all available entities provided per domain.

When using a default entity _field-_ or _feature-trait_ its ORM mapping is configured automatically. You can override it
on a per-property basis.

_The required entities of a MsgPHP bundle are automatically created, including ORM mapping and configuration, when using
Symfony Flex._

## Mapping Identifiers

When an entity object is identified using a [domain identifier](../ddd/identifiers.md) we must configure it accordingly.
[Read more](../infrastructure/doctrine-dbal.md#domain-identifier-type).

```php
<?php

use MsgPhp\SomeDomain\SomeIdInterface;

// ...

class SomeEntity extends BaseSomeEntity
{
    /**
     * @var SomeIdInterface|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="msghp_some_id")
     */
    public $id;
}
```

See also the [reference](../reference/doctrine-identifier-types.md) page for all available identifier types provided per
domain.

Note when using an identifier that is able to calculate a value upfront the `@ORM\GeneratedValue()` is not necessary.

In case a custom implementation is used it should be configured accordingly:

```yaml
msgphp_<name>:
    # ...
    class_mapping:
        MsgPhp\SomeDomain\SomeIdInterface: App\SomeId
    id_type_mapping:
        MsgPhp\SomeDomain\SomeIdInterface: bigint
```

See also the [reference](../reference/identifiers.md) page for all available identifiers provided per domain.

### Without Nullability

```php
<?php

// ...

class SomeEntity extends BaseSomeEntity
{
    /**
     * @ORM\...
     */
    private $id;

    public function __construct(SomeIdInterface $id)
    {
        $this->id = $id;
    }

    public function getId(): SomeIdInterface
    {
        return $this->id;
    }
}
```

Or coupled with a known identifier class:

```php
<?php

use MsgPhp\SomeDomain\SomeId;

// ...

class SomeEntity extends BaseSomeEntity
{
    // ...

    public function __construct()
    {
        $this->id = new SomeId();
    }

    // ...
}
```

### Without Automatic Hydration

To hydrate the primitive identifier value instead of a value object, the type can be configured regularly. Without
nullability it requires to couple with a known identifier class. [Read more](../infrastructure/doctrine-orm.md#hydration).

```php
<?php

// ...

class SomeEntity extends BaseSomeEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function __construct(SomeIdInterface $id)
    {
        $this->id = $id->isEmpty() ? null : (int) $id->toString();
    }

    public function getId(): SomeIdInterface
    {
        return SomeId::fromValue($this->id);
    }
}
```

## Database Setup

Configure the database URL:

```bash
# .env

# sqlite
DATABASE_URL=sqlite:///%kernel.project_dir%/var/db.sqlite

# mysql / mariadb
DATABASE_URL="mysql://user:pass@host:3306/db_name?charset=utf8mb4&serverVersion=5.7"
```

Create the database schema:

```bash
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
```

[recipe configuration]: https://github.com/symfony/recipes/blob/master/doctrine/doctrine-bundle/1.6/config/packages/doctrine.yaml
[doctrine-bundle-mapping-config]: https://symfony.com/doc/master/bundles/DoctrineBundle/configuration.html#mapping-configuration
[mapped superclasses]: https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/inheritance-mapping.html#mapped-superclasses
