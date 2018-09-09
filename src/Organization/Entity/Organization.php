<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Entity;

use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class Organization
{
    abstract public function getId(): OrganizationIdInterface;
}
