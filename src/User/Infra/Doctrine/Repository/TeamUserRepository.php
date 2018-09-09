<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Doctrine\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\User\Entity\TeamUser;
use MsgPhp\User\Repository\TeamUserRepositoryInterface;
use MsgPhp\User\UserIdInterface;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class TeamUserRepository implements TeamUserRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    private $alias = 'team_user';

    /**
     * @return DomainCollectionInterface|TeamUser[]
     */
    public function findAllByTeamId(TeamIdInterface $teamId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAllByFields(['team' => $teamId], $offset, $limit);
    }

    /**
     * @return DomainCollectionInterface|TeamUser[]
     */
    public function findAllByUserId(UserIdInterface $userId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAllByFields(['user' => $userId], $offset, $limit);
    }

    public function find(TeamIdInterface $teamId, UserIdInterface $userId): TeamUser
    {
        return $this->doFind(['team' => $teamId, 'user' => $userId]);
    }

    public function exists(TeamIdInterface $teamId, UserIdInterface $userId): bool
    {
        return $this->doExists(['team' => $teamId, 'user' => $userId]);
    }

    public function save(TeamUser $teamUser): void
    {
        $this->doSave($teamUser);
    }

    public function delete(TeamUser $teamUser): void
    {
        $this->doDelete($teamUser);
    }
}
