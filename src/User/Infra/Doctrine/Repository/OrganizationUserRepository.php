<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Doctrine\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\User\Entity\OrganizationUser;
use MsgPhp\User\Repository\OrganizationUserRepositoryInterface;
use MsgPhp\User\UserIdInterface;
use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class OrganizationUserRepository implements OrganizationUserRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    private $alias = 'organization_user';

    /**
     * @return DomainCollectionInterface|OrganizationUser[]
     */
    public function findAllByOrganizationId(OrganizationIdInterface $organizationId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAllByFields(['organization' => $organizationId], $offset, $limit);
    }

    /**
     * @return DomainCollectionInterface|OrganizationUser[]
     */
    public function findAllByUserId(UserIdInterface $userId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAllByFields(['user' => $userId], $offset, $limit);
    }

    public function find(OrganizationIdInterface $organizationId, UserIdInterface $userId): OrganizationUser
    {
        return $this->doFind(['organization' => $organizationId, 'user' => $userId]);
    }

    public function exists(OrganizationIdInterface $organizationId, UserIdInterface $userId): bool
    {
        return $this->doExists(['organization' => $organizationId, 'user' => $userId]);
    }

    public function save(OrganizationUser $organizationUser): void
    {
        $this->doSave($organizationUser);
    }

    public function delete(OrganizationUser $organizationUser): void
    {
        $this->doDelete($organizationUser);
    }
}
