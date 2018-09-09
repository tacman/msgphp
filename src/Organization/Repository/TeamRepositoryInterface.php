<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Organization\Entity\Team;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface TeamRepositoryInterface
{
    /**
     * @return DomainCollectionInterface|Team[]
     */
    public function findAll(int $offset = 0, int $limit = 0): DomainCollectionInterface;

    public function find(TeamIdInterface $id): Team;

    public function exists(TeamIdInterface $id): bool;

    public function save(Team $team): void;

    public function delete(Team $team): void;
}
