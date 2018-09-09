<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Doctrine\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\User\Entity\TeamRole;
use MsgPhp\User\Repository\TeamRoleRepositoryInterface;
use MsgPhp\User\UserIdInterface;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class TeamRoleRepository implements TeamRoleRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    private $alias = 'team_role';

    /**
     * @return DomainCollectionInterface|TeamRole[]
     */
    public function findAllByTeamId(TeamIdInterface $teamId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAllByFields(['team' => $teamId], $offset, $limit);
    }

    /**
     * @return DomainCollectionInterface|TeamRole[]
     */
    public function findAllByUserId(UserIdInterface $userId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        // @todo
    }

    public function find(TeamIdInterface $teamId, string $roleName): TeamRole
    {
        return $this->doFind(['team' => $teamId, 'role' => $roleName]);
    }

    public function exists(TeamIdInterface $teamId, string $roleName): bool
    {
        return $this->doExists(['team' => $teamId, 'role' => $roleName]);
    }

    public function save(TeamRole $teamRole): void
    {
        $this->doSave($teamRole);
    }

    public function delete(TeamRole $teamRole): void
    {
        $this->doDelete($teamRole);
    }
}
