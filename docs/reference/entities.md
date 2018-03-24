# Domain Entities

Reference of available [entities](../ddd/entities.md) per domain.

## Base Domain

### Entity Fields

- `MsgPhp\Domain\Entity\Fields\CreatedAtField`
- `MsgPhp\Domain\Entity\Fields\EnabledField`
- `MsgPhp\Domain\Entity\Fields\LastUpdatedAtField`

### Entity Features

- `MsgPhp\Domain\Entity\Features\CanBeConfirmed`
- `MsgPhp\Domain\Entity\Features\CanBeEnabled`

---

## EAV Domain

### Entities

Class | Abstract | Required
--- | --- | ---
`MsgPhp\Eav\Entity\Attribute` | ✔ | ✔
`MsgPhp\Eav\Entity\AttributeValue` | ✔ | ✔

### Entity Fields

- `MsgPhp\Eav\Entity\Fields\AttributesField`
- `MsgPhp\Eav\Entity\Fields\AttributeValueField`

---

## User Domain

### Entities

Class | Abstract | Required
--- | --- | ---
`MsgPhp\User\Entity\Role` | ✔ | ✗
`MsgPhp\User\Entity\User` | ✔ | ✔
`MsgPhp\User\Entity\UserAttributeValue` | ✔ | ✗
`MsgPhp\User\Entity\UserEmail` | ✔ | ✗
`MsgPhp\User\Entity\Username` | ✗ | ✗
`MsgPhp\User\Entity\UserRole` | ✔ | ✗

### Entity Fields

- `MsgPhp\User\Entity\Fields\AttributeValuesField`
- `MsgPhp\User\Entity\Fields\EmailsField`
- `MsgPhp\User\Entity\Fields\RoleField`
- `MsgPhp\User\Entity\Fields\RolesField`
- `MsgPhp\User\Entity\Fields\UserField`

### Entity Features

- `MsgPhp\User\Entity\Features\ResettablePassword`

#### Credential Types

- `MsgPhp\User\Entity\Features\EmailCredential`
- `MsgPhp\User\Entity\Features\EmailPasswordCredential`
- `MsgPhp\User\Entity\Features\EmailSaltedPasswordCredential`
- `MsgPhp\User\Entity\Features\NicknameCredential`
- `MsgPhp\User\Entity\Features\NicknamePasswordCredential`
- `MsgPhp\User\Entity\Features\NicknameSaltedPasswordCredential`
- `MsgPhp\User\Entity\Features\TokenCredential`
