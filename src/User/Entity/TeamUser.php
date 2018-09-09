<?php

declare(strict_types=1);

namespace MsgPhp\User\Entity;

use MsgPhp\Organization\Entity\Fields\TeamField;
use MsgPhp\Organization\Entity\Team;
use MsgPhp\User\Entity\Fields\UserField;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class TeamUser
{
    use TeamField;
    use UserField;

    public function __construct(Team $team, User $user)
    {
        $this->team = $team;
        $this->user = $user;
    }
}
