# Doctrine Database Abstraction Layer

An overview of available infrastructural code when using Doctrine's [Database Abstraction Layer][dbal-project].

- Requires [doctrine/dbal]

## Domain identifier type

A translation between the database type and a [identifier](../ddd/identifiers.md) type in PHP is provided by
`MsgPhp\Domain\Infra\Doctrine\DomainIdType`. Its purpose is to abstract the underlying data type of the identifier
value.

The design is based on [late static bindings], due the design of the Doctrine type system itself. It extends from the
default [`Type`][api-type] implementation and can either be used generic or as a base class for custom identifier
(which in turn require custom types).

- `static setClass(string $class): void`
    - `$class`: A sub class of `DomainIdInterface` to use as PHP value. If not set the [default identifier](../ddd/identifiers.md#msgphpdomaindomainid)
      is used.
- `static getClass(): string`
- `static setDataType(string $type): void`
    - `$type`: A doctrine type name to use as underlying data type. If not set `Type::INTEGER` is used.
- `static getDataType(): string`

### Basic example

```php
<?php

use Doctrine\DBAL\Types\Type;
use MsgPhp\Domain\DomainId;
use MsgPhp\Domain\Infra\Doctrine\DomainIdType;

// --- SETUP ---

class MyDomainId extends DomainId
{
}

class MyDomainIdType extends DomainIdType
{
    public const NAME = 'my_domain_id';
}

Type::addType(MyDomainId::NAME, MyDomainId::class);

// --- USAGE ---

MyDomainIdType::setClass(MyDomainId::class);
MyDomainIdType::setDataType(Type::GUID);
```

To leverage the tailored [UUID identifier](../infrastructure/uuid.md#domain-identifier) use a data type from
[ramsey/uuid-doctrine] instead.

```php
<?php

use MsgPhp\Domain\Infra\Uuid\DomainId as DomainUuid;
use Ramsey\Uuid\Doctrine\UuidType;

MyDomainIdType::setClass(DomainUuid::class);
MyDomainIdType::setDataType(UuidType::NAME);
```

[dbal-project]: http://www.doctrine-project.org/projects/dbal.html
[doctrine/dbal]: https://packagist.org/packages/doctrine/dbal
[api-type]: http://www.doctrine-project.org/api/dbal/2.5/class-Doctrine.DBAL.Types.Type.html
[late static bindings]: https://secure.php.net/manual/en/language.oop5.late-static-bindings.php
[ramsey/uuid-doctrine]: https://packagist.org/packages/ramsey/uuid-doctrine
