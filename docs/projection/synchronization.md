# Projection Synchronization

`MsgPhp\Domain\Projection\ProjectionSynchronization` is a utility domain service. Its purpose is to ease synchronizing
projection documents from source objects.

## API

### `synchronize(): int`

Synchronizes all projections. Returns the no. of projections synchronized.

## Basic example

```php
<?php

use MsgPhp\Domain\Projection\ProjectionDocumentProvider;
use MsgPhp\Domain\Projection\ProjectionRepository;
use MsgPhp\Domain\Projection\ProjectionSynchronization;
use MsgPhp\Domain\Projection\ProjectionTypeRegistry;

// --- SETUP ---

class MyEntity
{
}

/** @var ProjectionTypeRegistry $typeRegistry */
/** @var ProjectionRepository $repository */

$provider = new ProjectionDocumentProvider([
    function (): iterable {
        yield new MyEntity();
        yield new MyEntity();
    },
], function (object $object): array {
    return (array) $object;
}, function (object $object): string {
    return 'index';
});
$synchronization = new ProjectionSynchronization($typeRegistry, $repository, $provider);

// --- USAGE ---

$numProjections = $synchronization->synchronize();
```

## Command Line Interface

A synchronization can be ran using the CLI when working with Symfony Console.

- [Read more](../infrastructure/symfony-console.md#synchronizeprojectionscommand)
