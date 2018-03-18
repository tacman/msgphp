# Domain entities

Reference of available [entities](../ddd/entities.md) per domain.

## Base domain

### Entity fields

- `MsgPhp\Domain\Entity\Fields\CreatedAtField`
- `MsgPhp\Domain\Entity\Fields\EnabledField`
- `MsgPhp\Domain\Entity\Fields\LastUpdatedAtField`

### Entity features

- `MsgPhp\Domain\Entity\Features\CanBeConfirmed`
- `MsgPhp\Domain\Entity\Features\CanBeEnabled`

## EAV domain

### Entity fields

- `MsgPhp\Eav\Entity\Fields\AttributesField`
- `MsgPhp\Eav\Entity\Fields\AttributeValueField`

### Mapped super classes

- `MsgPhp\Eav\Entity\Attribute`
- `MsgPhp\Eav\Entity\AttributeValue`

## User domain

### Entity fields

- `MsgPhp\User\Entity\Fields\AttributeValuesField`
- `MsgPhp\User\Entity\Fields\EmailsField`
- `MsgPhp\User\Entity\Fields\RoleField`
- `MsgPhp\User\Entity\Fields\RolesField`
- `MsgPhp\User\Entity\Fields\UserField`

### Entity features

- `MsgPhp\User\Entity\Features\ResettablePassword`

#### Credentials

- `MsgPhp\User\Entity\Features\EmailCredential`
- `MsgPhp\User\Entity\Features\EmailPasswordCredential`
- `MsgPhp\User\Entity\Features\EmailSaltedPasswordCredential`
- `MsgPhp\User\Entity\Features\NicknameCredential`
- `MsgPhp\User\Entity\Features\NicknamePasswordCredential`
- `MsgPhp\User\Entity\Features\NicknameSaltedPasswordCredential`
- `MsgPhp\User\Entity\Features\TokenCredential`

### Mapped super classes

- `MsgPhp\User\Entity\Role`
- `MsgPhp\User\Entity\User`
- `MsgPhp\User\Entity\UserAttributeValue`
- `MsgPhp\User\Entity\UserEmail`
- `MsgPhp\User\Entity\UserRole`

### Entities

- `MsgPhp\User\Entity\Username`
