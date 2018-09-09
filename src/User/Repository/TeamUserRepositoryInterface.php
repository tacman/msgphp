<?php

declare(strict_types=1);

namespace MsgPhp\User\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\User\Entity\TeamUser;
use MsgPhp\User\UserIdInterface;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface TeamUserRepositoryInterface
{
    /**
     * @return DomainCollectionInterface|TeamUser[]
     */
    public function findAllByTeamId(TeamIdInterface $teamId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    /**
     * @return DomainCollectionInterface|TeamUser[]
     */
    public function findAllByUserId(UserIdInterface $userId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    public function find(TeamIdInterface $teamId, UserIdInterface $userId): TeamUser;

    public function exists(TeamIdInterface $teamId, UserIdInterface $userId): bool;

    public function save(TeamUser $teamUser): void;

    public function delete(TeamUser $teamUser): void;
}
