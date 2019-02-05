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

use MsgPhp\Domain\{DomainId, DomainIdInterface};

interface SomeIdInterface extends DomainIdInterface
{
}

class SomeId extends DomainId implements SomeIdInterface
{
    public function autocomplete(): void
    {
    }
}

$test = new class() {
    public function accept(SomeIdInterface $id): void
    {
    }
};

$test->accept(SomeId::fromValue('id'));
$test->accept($id = SomeId::fromValue('id'));

// test it autocompletes
//$id->auto
