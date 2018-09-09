<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Infra\Uuid;

use MsgPhp\Domain\Infra\Uuid\DomainId;
use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class OrganizationId extends DomainId implements OrganizationIdInterface
{
}
