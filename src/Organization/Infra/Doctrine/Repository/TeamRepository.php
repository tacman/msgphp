<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Infra\Doctrine\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\Organization\Entity\Team;
use MsgPhp\Organization\Repository\TeamRepositoryInterface;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class TeamRepository implements TeamRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    private $alias = 'organization';

    /**
     * @return DomainCollectionInterface|Team[]
     */
    public function findAll(int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAll($offset, $limit);
    }

    public function find(TeamIdInterface $id): Team
    {
        return $this->doFind($id);
    }

    public function exists(TeamIdInterface $id): bool
    {
        return $this->doExists($id);
    }

    public function save(Team $team): void
    {
        $this->doSave($team);
    }

    public function delete(Team $team): void
    {
        $this->doDelete($team);
    }
}
