<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Doctrine\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\User\Entity\OrganizationRole;
use MsgPhp\User\Repository\OrganizationRoleRepositoryInterface;
use MsgPhp\User\UserIdInterface;
use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class OrganizationRoleRepository implements OrganizationRoleRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    private $alias = 'organization_role';

    /**
     * @return DomainCollectionInterface|OrganizationRole[]
     */
    public function findAllByOrganizationId(OrganizationIdInterface $organizationId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAllByFields(['organization' => $organizationId], $offset, $limit);
    }

    /**
     * @return DomainCollectionInterface|OrganizationRole[]
     */
    public function findAllByUserId(UserIdInterface $userId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        // @todo
    }

    public function find(OrganizationIdInterface $organizationId, string $roleName): OrganizationRole
    {
        return $this->doFind(['organization' => $organizationId, 'role' => $roleName]);
    }

    public function exists(OrganizationIdInterface $organizationId, string $roleName): bool
    {
        return $this->doExists(['organization' => $organizationId, 'role' => $roleName]);
    }

    public function save(OrganizationRole $organizationRole): void
    {
        $this->doSave($organizationRole);
    }

    public function delete(OrganizationRole $organizationRole): void
    {
        $this->doDelete($organizationRole);
    }
}
