<?php

declare(strict_types=1);

namespace MsgPhp\Domain\Infrastructure\DependencyInjection;

use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @internal
 */
final class ContainerHelper
{
    /** @var int */
    private static $counter = 0;

    public static function hasBundle(ContainerInterface $container, string $class): bool
    {
        return \in_array($class, $container->getParameter('kernel.bundles'), true);
    }

    public static function getClassReflection(ContainerBuilder $container, ?string $class): \ReflectionClass
    {
        if (null === $class) {
            throw new InvalidArgumentException('Missing class.');
        }
        if (null === $reflection = $container->getReflectionClass($class)) {
            throw new InvalidArgumentException('Invalid class "'.$class.'".');
        }

        return $reflection;
    }

    public static function removeId(ContainerBuilder $container, string $id): void
    {
        $container->removeDefinition($id);
        $container->removeAlias($id);

        foreach ($container->getAliases() as $aliasId => $alias) {
            if ($id === (string) $alias) {
                $container->removeAlias($aliasId);
            }
        }
    }

    public static function removeIf(ContainerBuilder $container, bool $condition, array $ids): void
    {
        if (!$condition) {
            return;
        }

        foreach ($ids as $id) {
            self::removeId($container, $id);
        }
    }

    public static function clearTag(ContainerBuilder $container, string $tag): void
    {
        foreach ($container->findTaggedServiceIds($tag) as $id => $attr) {
            $container->getDefinition($id)->clearTag($tag);
        }
    }

    public static function registerAnonymous(ContainerBuilder $container, string $class, bool $child = false, string &$id = null): Definition
    {
        $definition = $child ? new ChildDefinition($class) : new Definition($class);
        $definition->setPublic(false);

        return $container->setDefinition($id = $class.'.'.ContainerBuilder::hash(__METHOD__.++self::$counter), $definition);
    }

    public static function tagCommandHandler(ContainerBuilder $container, string $handlerId, string $busId = null, string $handles = null): void
    {
        if (FeatureDetection::isMessengerAvailable($container)) {
            $container->getDefinition($handlerId)
                ->addTag('messenger.message_handler', ['bus' => $busId, 'handles' => $handles])
            ;
        }
    }
}
