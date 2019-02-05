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

namespace MsgPhp\User\Command;

use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\User\UserIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class AddUserAttributeValueCommand
{
    /**
     * @var UserIdInterface
     */
    public $userId;

    /**
     * @var AttributeIdInterface
     */
    public $attributeId;

    /**
     * @var mixed
     */
    public $value;

    /**
     * @var array
     */
    public $context;

    /**
     * @param mixed $value
     */
    final public function __construct(UserIdInterface $userId, AttributeIdInterface $attributeId, $value, array $context = [])
    {
        $this->userId = $userId;
        $this->attributeId = $attributeId;
        $this->value = $value;
        $this->context = $context;
    }
}
