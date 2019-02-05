<?php

declare(strict_types=1);

/*
 * This file is part of the MsgPHP package.
 *
 * (c) Roland Franssen <franssen.roland@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MsgPhp\User\Event;

use MsgPhp\User\Entity\UserAttributeValue;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class UserAttributeValueAddedEvent
{
    /**
     * @var UserAttributeValue
     */
    public $userAttributeValue;

    /**
     * @var array
     */
    public $context;

    final public function __construct(UserAttributeValue $userAttributeValue, array $context)
    {
        $this->userAttributeValue = $userAttributeValue;
        $this->context = $context;
    }
}
