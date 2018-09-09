<?php

declare(strict_types=1);

namespace MsgPhp\User\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\User\Entity\TeamRole;
use MsgPhp\User\UserIdInterface;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface TeamRoleRepositoryInterface
{
    /**
     * @return DomainCollectionInterface|TeamRole[]
     */
    public function findAllByTeamId(TeamIdInterface $teamId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    /**
     * @return DomainCollectionInterface|TeamRole[]
     */
    public function findAllByUserId(UserIdInterface $userId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    public function find(TeamIdInterface $teamId, string $roleName): TeamRole;

    public function exists(TeamIdInterface $teamId, string $roleName): bool;

    public function save(TeamRole $teamRole): void;

    public function delete(TeamRole $teamRole): void;
}
