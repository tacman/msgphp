<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Security\Oauth;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwnerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use MsgPhp\Domain\Exception\EntityNotFoundException;
use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use MsgPhp\Domain\Message\{DomainMessageBusInterface, MessageDispatchingTrait};
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\User\Command\{AddUserAttributeValueCommand, ConfirmUserCommand, CreateUserCommand};
use MsgPhp\User\Entity\{User, UserAttributeValue};
use MsgPhp\User\Infra\Security\SecurityUserProvider as BaseSecurityUserProvider;
use MsgPhp\User\Repository\UserAttributeValueRepositoryInterface;
use MsgPhp\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class EavSecurityUserProvider implements OAuthAwareUserProviderInterface
{
    use MessageDispatchingTrait;

    private $provider;
    private $factory;
    private $bus;
    private $repository;
    private $attributeValueRepository;

    public function __construct(BaseSecurityUserProvider $provider, EntityAwareFactoryInterface $factory, DomainMessageBusInterface $bus, UserRepositoryInterface $repository, UserAttributeValueRepositoryInterface $attributeValueRepository)
    {
        $this->provider = $provider;
        $this->factory = $factory;
        $this->bus = $bus;
        $this->repository = $repository;
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response): UserInterface
    {
        $attributeId = $this->factory->identify(Attribute::class, $this->getResourceOwnerAttributeId($owner = $response->getResourceOwner()));
        $id = $response->getUsername();

        /** @var UserAttributeValue $userAttributeValue|false */
        $userAttributeValue = $this->attributeValueRepository->findAllByAttributeIdAndValue($attributeId, $id)->first();

        if (!$userAttributeValue) {
            $username = $this->getUsername($response);

            try {
                // @todo password confirmation?
                $user = $this->repository->findByUsername($username);
                $userId = $user->getId();
            } catch (EntityNotFoundException $e) {
                $userId = $this->factory->nextIdentifier(User::class);
                // @todo disable change password?
                $this->dispatch(CreateUserCommand::class, [[
                    'id' => $userId,
                ] + $this->getUserContext($username)]);
                $this->dispatch(ConfirmUserCommand::class, [$userId]);

                $user = $this->repository->find($userId);
            }

            $this->dispatch(AddUserAttributeValueCommand::class, [$userId, $attributeId, $id]);
        } else {
            $user = $userAttributeValue->getUser();
        }

        return $this->provider->fromUser($user);
    }

    abstract protected function getResourceOwnerAttributeId(ResourceOwnerInterface $resourceOwner);

    abstract protected function getUsername(UserResponseInterface $response): string;

    abstract protected function getUserContext(string $username): array;
}
