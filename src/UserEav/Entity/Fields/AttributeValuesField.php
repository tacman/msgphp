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

namespace MsgPhp\User\Entity\Fields;

use MsgPhp\Domain\{DomainCollection, DomainCollectionInterface};
use MsgPhp\User\Entity\UserAttributeValue;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait AttributeValuesField
{
    /**
     * @var iterable|UserAttributeValue[]
     */
    private $attributeValues = [];

    /**
     * @return DomainCollectionInterface|UserAttributeValue[]
     */
    public function getAttributeValues(): DomainCollectionInterface
    {
        return new DomainCollection($this->attributeValues);
    }
}
