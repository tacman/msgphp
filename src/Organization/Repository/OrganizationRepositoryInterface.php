<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Organization\Entity\Organization;
use MsgPhp\Organization\OrganizationIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface OrganizationRepositoryInterface
{
    /**
     * @return DomainCollectionInterface|Organization[]
     */
    public function findAll(int $offset = 0, int $limit = 0): DomainCollectionInterface;

    public function find(OrganizationIdInterface $id): Organization;

    public function exists(OrganizationIdInterface $id): bool;

    public function save(Organization $organization): void;

    public function delete(Organization $organization): void;
}
