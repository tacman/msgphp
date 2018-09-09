<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Infra\Doctrine\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\Organization\Entity\OrganizationTeam;
use MsgPhp\Organization\Repository\OrganizationTeamRepositoryInterface;
use MsgPhp\Organization\{OrganizationIdInterface, TeamIdInterface};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class OrganizationTeamRepository implements OrganizationTeamRepositoryInterface
{
    use DomainEntityRepositoryTrait;

    private $alias = 'organization_team';

    /**
     * @return DomainCollectionInterface|OrganizationTeam[]
     */
    public function findAllByOrganizationId(OrganizationIdInterface $organizationId, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->doFindAllByFields(['organization' => $organizationId], $offset, $limit);
    }

    public function find(OrganizationIdInterface $organizationId, TeamIdInterface $teamId): OrganizationTeam
    {
        return $this->doFind(['organization' => $organizationId, 'team' => $teamId]);
    }

    public function exists(OrganizationIdInterface $organizationId, TeamIdInterface $teamId): bool
    {
        return $this->doExists(['organization' => $organizationId, 'team' => $teamId]);
    }

    public function save(OrganizationTeam $organizationTeam): void
    {
        $this->doSave($organizationTeam);
    }

    public function delete(OrganizationTeam $organizationTeam): void
    {
        $this->doDelete($organizationTeam);
    }
}
