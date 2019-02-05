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

namespace MsgPhp\User\Tests\Entity\Fields;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\User\Entity\Fields\AttributeValuesField;
use MsgPhp\User\Entity\UserAttributeValue;
use PHPUnit\Framework\TestCase;

final class AttributeValuesFieldTest extends TestCase
{
    public function testField(): void
    {
        $object = $this->getObject($attributeValues = [$this->createMock(UserAttributeValue::class)]);

        self::assertSame($attributeValues, iterator_to_array($object->getAttributeValues()));

        $object = $this->getObject($attributeValues = $this->createMock(DomainCollectionInterface::class));

        self::assertNotSame($attributeValues, $object->getAttributeValues());
    }

    /**
     * @return object
     */
    private function getObject($value)
    {
        return new class($value) {
            use AttributeValuesField;

            public function __construct($value)
            {
                $this->attributeValues = $value;
            }
        };
    }
}
