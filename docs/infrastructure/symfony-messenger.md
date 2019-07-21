# Symfony Messenger

An overview of available infrastructural code when using [Symfony Messenger][messenger-project].

- Requires [symfony/messenger]

## Domain Message Bus

A Symfony Messenger tailored [domain message bus](../ddd/message-bus.md) is provided by `MsgPhp\Domain\Infrastructure\Messenger\DomainMessageBus`.

### Basic Example

```php
<?php

use MsgPhp\Domain\Infrastructure\Messenger\DomainMessageBus;
use Symfony\Component\Messenger\MessageBusInterface;

// --- SETUP ---

class CommandMessage
{
}

class EventMessage
{
}

/** @var MessageBusInterface $commandBus */
/** @var MessageBusInterface $eventBus */

$domainBus = new DomainMessageBus($commandBus, $eventBus, [EventMessage::class]);

// --- USAGE ---

$domainBus->dispatch(new CommandMessage());
$domainBus->dispatch(new EventMessage());
```

[messenger-project]: https://symfony.com/doc/current/components/messenger.html
[symfony/messenger]: https://packagist.org/packages/symfony/messenger
