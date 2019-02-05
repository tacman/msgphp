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

namespace MsgPhp\User\Tests\Entity;

use MsgPhp\Eav\AttributeValueIdInterface;
use MsgPhp\Eav\Entity\AttributeValue;
use MsgPhp\User\Entity\{User, UserAttributeValue};
use PHPUnit\Framework\TestCase;

final class UserAttributeValueTest extends TestCase
{
    public function testCreate(): void
    {
        $attributeValue = $this->createMock(AttributeValue::class);
        $attributeValue->expects(self::once())
            ->method('getId')
            ->willReturn($id = $this->createMock(AttributeValueIdInterface::class))
        ;
        $userAttributeValue = $this->createEntity($user = $this->createMock(User::class), $attributeValue);

        self::assertSame($user, $userAttributeValue->getUser());
        self::assertSame($id, $userAttributeValue->getId());
    }

    private function createEntity($user, $attributeValue): UserAttributeValue
    {
        return new class($user, $attributeValue) extends UserAttributeValue {
        };
    }
}
