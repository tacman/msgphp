<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Entity\Fields;

use MsgPhp\Organization\Entity\Organization;
use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait OrganizationField
{
    /** @var Organization */
    private $organization;

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function getOrganizationId(): OrganizationIdInterface
    {
        return $this->organization->getId();
    }
}
