<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Organization\Entity\OrganizationTeam;
use MsgPhp\Organization\{OrganizationIdInterface, TeamIdInterface};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface OrganizationTeamRepositoryInterface
{
    /**
     * @return DomainCollectionInterface|OrganizationTeam[]
     */
    public function findAllByOrganizationId(OrganizationIdInterface $organizationId, int $offset = 0, int $limit = 0): DomainCollectionInterface;

    public function find(OrganizationIdInterface $organizationId, TeamIdInterface $teamId): OrganizationTeam;

    public function exists(OrganizationIdInterface $organizationId, TeamIdInterface $teamId): bool;

    public function save(OrganizationTeam $organizationTeam): void;

    public function delete(OrganizationTeam $organizationTeam): void;
}
