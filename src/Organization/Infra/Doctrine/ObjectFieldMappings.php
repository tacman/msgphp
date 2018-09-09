<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Infra\Doctrine;

use MsgPhp\Domain\Infra\Doctrine\ObjectFieldMappingsProviderInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @internal
 */
final class ObjectFieldMappings implements ObjectFieldMappingsProviderInterface
{
    public static function provideObjectFieldMappings(): iterable
    {
        return [];
    }
}
