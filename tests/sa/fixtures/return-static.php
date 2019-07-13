<?php

declare(strict_types=1);

use MsgPhp\Domain\DomainId;
use MsgPhp\Domain\DomainIdTrait;

interface EntityId extends DomainId
{
}

class ScalarEntityId implements EntityId
{
    use DomainIdTrait;

    public function autocomplete(): void
    {
    }
}

$test = new class() {
    public function accept(EntityId $id, ScalarEntityId $scalarId): void
    {
    }
};

$test->accept(ScalarEntityId::fromValue('id'), ScalarEntityId::fromValue('id'));

// test it autocompletes
//ScalarEntityId::fromValue('id')->autoc
