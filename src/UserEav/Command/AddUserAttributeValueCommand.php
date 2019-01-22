<?php

declare(strict_types=1);

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
