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

namespace MsgPhp\User\Command\Handler;

use MsgPhp\Domain\Factory\DomainObjectFactoryInterface;
use MsgPhp\Domain\Message\{DomainMessageBusInterface, MessageDispatchingTrait};
use MsgPhp\User\Command\ChangeUserAttributeValueCommand;
use MsgPhp\User\Event\UserAttributeValueChangedEvent;
use MsgPhp\User\Repository\UserAttributeValueRepositoryInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class ChangeUserAttributeValueHandler
{
    use MessageDispatchingTrait;

    /**
     * @var UserAttributeValueRepositoryInterface
     */
    private $repository;

    public function __construct(DomainObjectFactoryInterface $factory, DomainMessageBusInterface $bus, UserAttributeValueRepositoryInterface $repository)
    {
        $this->factory = $factory;
        $this->bus = $bus;
        $this->repository = $repository;
    }

    public function __invoke(ChangeUserAttributeValueCommand $command): void
    {
        $userAttributeValue = $this->repository->find($command->attributeValueId);
        $oldValue = $userAttributeValue->getValue();
        $newValue = $command->value;

        if ($newValue === $oldValue) {
            return;
        }

        $userAttributeValue->changeValue($command->value);
        $this->repository->save($userAttributeValue);
        $this->dispatch(UserAttributeValueChangedEvent::class, compact('userAttributeValue', 'oldValue', 'newValue'));
    }
}
