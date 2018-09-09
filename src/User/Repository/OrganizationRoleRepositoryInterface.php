<?php

declare(strict_types=1);

namespace MsgPhp\User\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\User\Entity\OrganizationRole;
use MsgPhp\User\UserIdInterface;
use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface OrganizationRoleRepositoryInterface
{
    /**
     * @return DomainCollectionInterface|OrganizationRole[]
     */
    public function findAllByOrganizationId(OrganizationIdInterface $organizationId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    /**
     * @return DomainCollectionInterface|OrganizationRole[]
     */
    public function findAllByUserId(UserIdInterface $userId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    public function find(OrganizationIdInterface $organizationId, string $roleName): OrganizationRole;

    public function exists(OrganizationIdInterface $organizationId, string $roleName): bool;

    public function save(OrganizationRole $organizationRole): void;

    public function delete(OrganizationRole $organizationRole): void;
}
