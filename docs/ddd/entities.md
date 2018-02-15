# Entities

Entity objects are provided per domain layer and usually follow a [POPO](https://stackoverflow.com/questions/41188002/what-does-the-term-plain-old-php-object-popo-exactly-mean)
design.

To simplify entity definitions common fields and features are provided in the form of PHP [traits](https://secure.php.net/manual/en/language.oop5.traits.php).
Entity fields can be compared to a read-operation, whereas entity features represent a write-operation.

They are defined in a dedicated namespace for discovery, respectively `Msgphp\Domain\Entity\Fields\` and
`MsgPhp\Domain\Entity\Features\`. Additionally more specific fields and features can be provided per domain layer.

## Common entity fields

### `CreatedAtField`

A datetime value representing the entity was initially created at.

- `getCreatedAt(): \DateTimeInterface`
    - Required to be set initially

### `EnabledField`

A boolean value representing the entity its availability state.

- `isEnabled(): bool`
    - `false` by default

### `LastUpdatedAtField`

A datetime value representing the entity was last updated at.

- `getLastUpdatedAt(): \DateTimeInterface`
    - Required to be set initially

## Common entity features

### `CanBeConfirmed`

Provides ability to confirm an entity.

- `getConfirmationToken(): ?string`
    - Required to be set initially
- `getConfirmedAt(): ?\DateTimeInterface` 
- `isConfirmed(): bool` 
- `confirm(): void` 
    - `confirmationToken` is unset
    - `confirmatedAt` is set to the current datetime

### `CanBeEnabled`

Provides ability to toggle an entity its availability state.

- Inherits from `EnabledField`
- `enable(): void`
- `disable(): void`
2
