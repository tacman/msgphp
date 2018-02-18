# Event handlers

A domain event handler is bound to `MsgPhp\Domain\Event\DomainEventHandlerInterface`. Its purpose is to handle
[domain events](events.md). By convention a trait implementation is provided to map concrete events to corresponding
handling methods.

## API

### `handleEvent(DomainEventInterface $event): bool`

Handles the given domain event for a known subject. A boolean return value tells if the domain event is actually handled
yes or no.

## Implementations

- `MsgPhp\Domain\Event\DomainEventHandlerTrait`
    - Maps events to `handle<Event_Class_Name_Without_Event_Suffix>Event()` methods
    - Handles default [events](events.md) out-of-the-box

## Basic example

```php
<?php

use MsgPhp\Domain\Event\DomainEventHandlerInterface;
use MsgPhp\Domain\Event\DomainEventHandlerTrait;

class MyEvent
{
    public $newValue;
    
    public function __construct($value)
    {
        $this->newValue = $value;
    }
}

class MyEntity implements DomainEventHandlerInterface
{
    use DomainEventHandlerTrait;
    
    public $value;
    
    private function handleMyEvent(MyEvent $event): bool
    {
        if ($this->value === $event->newValue) {
            return false;
        }

        $this->value = $event->newValue;
        
        return true;
    }
    
}

$entity = new MyEntity();
if ($entity->handleEvent(new MyEvent('value'))) {
    // do something
}
```
