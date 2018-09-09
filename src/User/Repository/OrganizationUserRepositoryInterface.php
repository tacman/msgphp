<?php

declare(strict_types=1);

namespace MsgPhp\User\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\User\Entity\OrganizationUser;
use MsgPhp\User\UserIdInterface;
use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface OrganizationUserRepositoryInterface
{
    /**
     * @return DomainCollectionInterface|OrganizationUser[]
     */
    public function findAllByOrganizationId(OrganizationIdInterface $organizationId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    /**
     * @return DomainCollectionInterface|OrganizationUser[]
     */
    public function findAllByUserId(UserIdInterface $userId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    public function find(OrganizationIdInterface $organizationId, UserIdInterface $userId): OrganizationUser;

    public function exists(OrganizationIdInterface $organizationId, UserIdInterface $userId): bool;

    public function save(OrganizationUser $organizationUser): void;

    public function delete(OrganizationUser $organizationUser): void;
}
