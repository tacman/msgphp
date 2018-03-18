<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Security\Oauth;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use MsgPhp\Domain\Exception\EntityNotFoundException;
use MsgPhp\User\Infra\Security\SecurityUserProvider as BaseSecurityUserProvider;
use MsgPhp\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class SecurityUserProvider implements OAuthAwareUserProviderInterface
{
    private $provider;
    private $repository;

    public function __construct(BaseSecurityUserProvider $provider, UserRepositoryInterface $repository)
    {
        $this->provider = $provider;
        $this->repository = $repository;
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response): UserInterface
    {
        try {
            $user = $this->repository->findByUsername($this->getUsername($response));
        } catch (EntityNotFoundException $e) {
            throw new UsernameNotFoundException($e->getMessage());
        }

        return $this->provider->fromUser($user);
    }

    abstract protected function getUsername(UserResponseInterface $response): string;
}
