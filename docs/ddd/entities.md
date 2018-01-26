# Entities

Entity objects are provided per domain layer and usually follow a [POPO](https://stackoverflow.com/questions/41188002/what-does-the-term-plain-old-php-object-popo-exactly-mean)
design.

To simplify the creation of entities the base domain layer provides common fields and features in the form of PHP
traits. Entity fields can be compared to a read-operation, whereas entity features represent a write-operation.

They are defined in a dedicated namespace for discovery, respectively `Msgphp\Domain\Entiy\Field\` and
`MsgPhp\Domain\Entity\Features\`.

## Common entity fields

### `CreatedAtField`

A datetime value representing the entity was initially created at.

- `getCreatedAt(): \DateTimeInterface`
    - Required to be set initially

### `EnabledField`

A boolean value representing the entity should be considered enabled yes or no.

- `isEnabled(): bool`
    - `false` by default

### `LastUpdatedAtField`

A datetime value representing the entity was last updated at.

- `getLastUpdatedAt(): \DateTimeInterface`
    - Required to be set initially

## Common entity features

### `CanBeConfirmed`

Provides ability to confirm an entity. When used an entity is considered initially unconfirmed.

- `getConfirmationToken(): ?string`
    - Required to be set initially
- `getConfirmedAt(): ?\DateTimeInterface` 
- `isConfirmed(): bool` 
- `confirm(): void` 
    - `confirmationToken` is unset
    - `confirmatedAt` is set to current datetime

### `CanBeEnabled`

Provides ability to toggle an entity availability state.

- Inherits from `EnabledField`
- `enable(): void`
- `disable(): void`
