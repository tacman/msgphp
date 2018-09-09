<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Infra\Doctrine\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\Organization\Entity\Organization;
use MsgPhp\Organization\Repository\OrganizationRepositoryInterface;
use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class OrganizationRepository implements OrganizationRepositoryInterface
{
    use DomainEntityRepositoryTrait {
        __construct as private __parent_construct;
    }

    private $alias = 'organization';

    /**
     * @return DomainCollectionInterface|Organization[]
     */
    public function findAll(int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAll($offset, $limit);
    }

    public function find(OrganizationIdInterface $id): Organization
    {
        return $this->doFind($id);
    }

    public function exists(OrganizationIdInterface $id): bool
    {
        return $this->doExists($id);
    }

    public function save(Organization $organization): void
    {
        $this->doSave($organization);
    }

    public function delete(Organization $organization): void
    {
        $this->doDelete($organization);
    }
}
