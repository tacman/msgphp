<?php

declare(strict_types=1);

namespace MsgPhp\User\Entity;

use MsgPhp\Organization\Entity\Fields\OrganizationField;
use MsgPhp\Organization\Entity\Organization;
use MsgPhp\User\Entity\Fields\UserField;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class OrganizationUser
{
    use OrganizationField;
    use UserField;

    public function __construct(Organization $organization, User $user)
    {
        $this->organization = $organization;
        $this->user = $user;
    }
}
