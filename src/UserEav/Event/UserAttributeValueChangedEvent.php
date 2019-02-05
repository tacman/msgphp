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
class UserAttributeValueChangedEvent
{
    /**
     * @var UserAttributeValue
     */
    public $userAttributeValue;

    /**
     * @var mixed
     */
    public $oldValue;

    /**
     * @var mixed
     */
    public $newValue;

    /**
     * @param mixed $oldValue
     * @param mixed $newValue
     */
    final public function __construct(UserAttributeValue $userAttributeValue, $oldValue, $newValue)
    {
        $this->userAttributeValue = $userAttributeValue;
        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
    }
}
