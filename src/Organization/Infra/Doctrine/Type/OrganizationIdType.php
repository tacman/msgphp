<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Infra\Doctrine\Type;

use MsgPhp\Domain\Infra\Doctrine\DomainIdType;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class OrganizationIdType extends DomainIdType
{
    public const NAME = 'msgphp_organization_id';
}
