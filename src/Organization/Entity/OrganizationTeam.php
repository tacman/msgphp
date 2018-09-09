<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Entity;

use MsgPhp\Organization\OrganizationIdInterface;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class OrganizationTeam
{
    private $organization;
    private $team;

    public function __construct(Organization $organization, Team $team)
    {
        $this->organization = $organization;
        $this->team = $team;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function getOrganizationId(): OrganizationIdInterface
    {
        return $this->organization->getId();
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function getTeamId(): TeamIdInterface
    {
        return $this->team->getId();
    }
}
