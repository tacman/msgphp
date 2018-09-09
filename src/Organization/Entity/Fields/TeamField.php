<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Entity\Fields;

use MsgPhp\Organization\Entity\Team;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait TeamField
{
    /** @var Team */
    private $team;

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function getTeamId(): TeamIdInterface
    {
        return $this->team->getId();
    }
}
