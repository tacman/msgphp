<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Entity;

use MsgPhp\Organization\Entity\Fields\{OrganizationField, TeamField};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class OrganizationTeam
{
    use OrganizationField;
    use TeamField;

    public function __construct(Organization $organization, Team $team)
    {
        $this->organization = $organization;
        $this->team = $team;
    }
}
