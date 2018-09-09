<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Infra\Uuid;

use MsgPhp\Domain\Infra\Uuid\DomainId;
use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class TeamId extends DomainId implements TeamIdInterface
{
}
