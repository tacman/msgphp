<?php

declare(strict_types=1);

namespace MsgPhp\Organization\Entity;

use MsgPhp\Organization\TeamIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class Team
{
    private $parent;

    public function __construct(self $parent = null)
    {
        $this->parent = $parent;
    }

    abstract public function getId(): TeamIdInterface;

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function getParentId(): ?TeamIdInterface
    {
        return null === $this->parent ? null : $this->parent->getId();
    }

    public function getRoot(): self
    {
        return null === $this->parent ? $this : $this->parent->getRoot();
    }

    public function getRootId(): TeamIdInterface
    {
        return $this->getRoot()->getId();
    }
}
