<?php

declare(strict_types=1);

namespace MsgPhp\User\Repository;

use MsgPhp\Domain\DomainCollection;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\AttributeValueId;
use MsgPhp\User\UserAttributeValue;
use MsgPhp\User\UserId;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @template T of UserAttributeValue
 */
interface UserAttributeValueRepository
{
    /**
     * @return DomainCollection<array-key, T>
     */
    public function findAllByAttributeId(AttributeId $attributeId, int $offset = 0, int $limit = 0): DomainCollection;

    /**
     * @param mixed $value
     *
     * @return DomainCollection<array-key, T>
     */
    public function findAllByAttributeIdAndValue(AttributeId $attributeId, $value, int $offset = 0, int $limit = 0): DomainCollection;

    /**
     * @return DomainCollection<array-key, T>
     */
    public function findAllByUserId(UserId $userId, int $offset = 0, int $limit = 0): DomainCollection;

    /**
     * @return DomainCollection<array-key, T>
     */
    public function findAllByUserIdAndAttributeId(UserId $userId, AttributeId $attributeId, int $offset = 0, int $limit = 0): DomainCollection;

    /**
     * @return T
     */
    public function find(AttributeValueId $attributeValueId): UserAttributeValue;

    public function exists(AttributeValueId $attributeValueId): bool;

    /**
     * @param T $userAttributeValue
     */
    public function save(UserAttributeValue $userAttributeValue): void;

    /**
     * @param T $userAttributeValue
     */
    public function delete(UserAttributeValue $userAttributeValue): void;
}
