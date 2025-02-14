<?php

declare(strict_types=1);

namespace MsgPhp\User\Infrastructure\Console\Command;

use MsgPhp\User\Repository\RoleRepository;
use MsgPhp\User\Role;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\StyleInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait RoleAwareTrait
{
    /** @var RoleRepository */
    private $repository;

    protected function getRole(InputInterface $input, StyleInterface $io): Role
    {
        if (null === $name = $input->getArgument('role')) {
            if (!$input->isInteractive()) {
                throw new \LogicException('No value provided for "role".');
            }

            do {
                $name = $io->ask('Role name');
            } while (null === $name);

            $input->setArgument('role', $name);
        }

        return $this->repository->find($name);
    }
}
