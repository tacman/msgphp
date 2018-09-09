<?php

declare(strict_types=1);

namespace MsgPhp\User\Entity;

use MsgPhp\Organization\Entity\Fields\OrganizationField;
use MsgPhp\Organization\Entity\Organization;
use MsgPhp\User\Entity\Fields\RoleField;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class OrganizationRole
{
    use OrganizationField;
    use RoleField;

    public function __construct(Organization $organization, Role $role)
    {
        $this->organization = $organization;
        $this->role = $role;
    }
}
