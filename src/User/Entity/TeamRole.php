<?php

declare(strict_types=1);

namespace MsgPhp\User\Entity;

use MsgPhp\Organization\Entity\Fields\TeamField;
use MsgPhp\Organization\Entity\Team;
use MsgPhp\User\Entity\Fields\RoleField;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class TeamRole
{
    use RoleField;
    use TeamField;

    public function __construct(Team $team, Role $role)
    {
        $this->team = $team;
        $this->role = $role;
    }
}
