<?php

declare(strict_types=1);

namespace MsgPhp\User\Tests\Model;

use MsgPhp\User\Model\AttributeValuesField;
use MsgPhp\User\UserAttributeValue;
use PHPUnit\Framework\TestCase;

final class AttributeValuesFieldTest extends TestCase
{
    public function testField(): void
    {
        self::assertSame($attributeValues = [$this->createMock(UserAttributeValue::class)], iterator_to_array((new TestAttributeValuesFieldModel($attributeValues))->getAttributeValues()));
    }
}

class TestAttributeValuesFieldModel
{
    use AttributeValuesField;

    /**
     * @param iterable<array-key, UserAttributeValue> $attributeValues
     */
    public function __construct($attributeValues)
    {
        $this->attributeValues = $attributeValues;
    }
}
