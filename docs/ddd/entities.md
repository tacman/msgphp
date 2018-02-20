# Entities

Entity objects are provided per domain layer and usually follow a [POPO](https://stackoverflow.com/questions/41188002/what-does-the-term-plain-old-php-object-popo-exactly-mean)
design.

To simplify entity definitions common fields and features are provided in the form of PHP [traits](https://secure.php.net/manual/en/language.oop5.traits.php).
Entity fields can be compared to a read-operation, whereas entity features represent a write-operation.

They are defined in a dedicated namespace for discovery, respectively `Msgphp\Domain\Entity\Fields\` and
`MsgPhp\Domain\Entity\Features\`. Additionally more specific fields and features can be provided per domain layer.

## Common entity fields

### `CreatedAtField`

A datetime value representing an entity was initially created at. Requires `$createdAt` to be set initially.

- `getCreatedAt(): \DateTimeInterface`

### `EnabledField`

A boolean value representing an entity its availability state. Sets `$enabled` to `false` by default.

- `isEnabled(): bool`

### `LastUpdatedAtField`

A datetime value representing an entity was last updated at. Requires `$lastUpdatedAt` to be set initially.

- `getLastUpdatedAt(): \DateTimeInterface`

## Common entity features

### `CanBeConfirmed`

Provides ability to confirm an entity. Requires `$confirmationToken` to be set initially (usually a random token).

- `getConfirmationToken(): ?string`
- `getConfirmedAt(): ?\DateTimeInterface` 
- `isConfirmed(): bool` 
- `confirm(): void` 
    - Resets `$confirmationToken`
    - Sets `$confirmatedAt` to the current datetime

### `CanBeEnabled`

Provides ability to toggle an entity its availability state.

- Inherits from `EnabledField`
- `enable(): void`
    - Sets `$enabled` to `true`
- `disable(): void`
    - Sets `$enabled` to `false`
