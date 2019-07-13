<?php

declare(strict_types=1);

namespace MsgPhp\User\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use MsgPhp\Domain\DomainCollection;
use MsgPhp\Domain\Infrastructure\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\AttributeValueId;
use MsgPhp\User\Repository\UserAttributeValueRepository as BaseUserAttributeValueRepository;
use MsgPhp\User\UserAttributeValue;
use MsgPhp\User\UserId;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @template T of UserAttributeValue
 * @implements BaseUserAttributeValueRepository<T>
 */
final class UserAttributeValueRepository implements BaseUserAttributeValueRepository
{
    /** @use DomainEntityRepositoryTrait<T> */
    use DomainEntityRepositoryTrait;

    public function findAllByAttributeId(AttributeId $attributeId, int $offset = 0, int $limit = 0): DomainCollection
    {
        $qb = $this->createQueryBuilder();
        $this->addAttributeCriteria($qb, $attributeId);

        /** @var DomainCollection<array-key, T> */
        return $this->createResultSet($qb->getQuery(), $offset, $limit);
    }

    public function findAllByAttributeIdAndValue(AttributeId $attributeId, $value, int $offset = 0, int $limit = 0): DomainCollection
    {
        $qb = $this->createQueryBuilder();
        $this->addAttributeCriteria($qb, $attributeId, $value);

        /** @var DomainCollection<array-key, T> */
        return $this->createResultSet($qb->getQuery(), $offset, $limit);
    }

    public function findAllByUserId(UserId $userId, int $offset = 0, int $limit = 0): DomainCollection
    {
        return $this->doFindAllByFields(['user' => $userId], $offset, $limit);
    }

    public function findAllByUserIdAndAttributeId(UserId $userId, AttributeId $attributeId, int $offset = 0, int $limit = 0): DomainCollection
    {
        $qb = $this->createQueryBuilder();
        $this->addFieldCriteria($qb, ['user' => $userId]);
        $this->addAttributeCriteria($qb, $attributeId);

        /** @var DomainCollection<array-key, T> */
        return $this->createResultSet($qb->getQuery(), $offset, $limit);
    }

    public function find(AttributeValueId $attributeValueId): UserAttributeValue
    {
        return $this->doFind($attributeValueId);
    }

    public function exists(AttributeValueId $attributeValueId): bool
    {
        return $this->doExists($attributeValueId);
    }

    public function save(UserAttributeValue $userAttributeValue): void
    {
        $this->doSave($userAttributeValue);
    }

    public function delete(UserAttributeValue $userAttributeValue): void
    {
        $this->doDelete($userAttributeValue);
    }

    /**
     * @param mixed $value
     */
    private function addAttributeCriteria(QueryBuilder $qb, AttributeId $attributeId, $value = null): void
    {
        if (3 === \func_num_args()) {
            $targetClass = $this->em->getClassMetadata($this->class)->getAssociationMapping('attributeValue')['targetEntity'];
            $qb->join($this->getAlias().'.attributeValue', 'attribute_value', Join::WITH, 'attribute_value.checksum = '.$this->addFieldParameter($qb, 'attributeValue', $targetClass::getChecksum($value)));
        } else {
            $qb->join($this->getAlias().'.attributeValue', 'attribute_value');
        }

        $qb->join('attribute_value.attribute', 'attribute', Join::WITH, 'attribute.id = '.$this->addFieldParameter($qb, 'attribute', $attributeId));
    }
}
