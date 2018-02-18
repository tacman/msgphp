# Events

A domain event is bound to `MsgPhp\Domain\Event\DomainEventInterface`. Its purpose is to identify concrete domain events
and represent something that happens. When handled it might lead to an application state change.

## Implementations

Domain events provided and handled by default [entity features](../ddd/entities.md#common-entity-features):

- `MsgPhp\Domain\Event\ConfirmEvent`
    - Handled by `MsgPhp\Domain\Entity\Features\CanBeConfirmed::handleConfirmEvent()`
- `MsgPhp\Domain\Event\DisableEvent`
    - Handled by `MsgPhp\Domain\Entity\Features\CanBeEnabled::handleDisableEvent()`
- `MsgPhp\Domain\Event\EnableEvent`
    - Handled by `MsgPhp\Domain\Entity\Features\CanBeEnabled::handleEnableEvent()`
