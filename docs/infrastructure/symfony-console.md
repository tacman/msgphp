# Symfony Console

An overview of available infrastructural code when using [Symfony Console](https://symfony.com/doc/current/components/console.html).

- Requires [`symfony/console`](https://packagist.org/packages/symfony/console)

## Context builder

A context builder is bound to `MsgPhp\Domain\Infra\Console\ContextBuilder\ContextBuilderInterface`. Its purpose is to
(interactively) built an arbitrary array value, i.e. the context, from a CLI command. Its value can be used as e.g. a
context provided to an [object factory](../ddd/factory/object.md).

- Blog post: [Initializing objects with CLI and the power of Symfony Console](https://medium.com/@ro0NL/initializing-objects-with-cli-and-the-power-of-symfony-console-2a008d5611f)

### API

#### `configure(InputDefinition $definition): void`

Configure a command input definition. See also [`InputDefinition`](https://api.symfony.com/master/Symfony/Component/Console/Input/InputDefinition.html).

---

#### `getContext(InputInterface $input, StyleInterface $io): array`

Resolve the actual context from the console IO. See also [`InputInterface`](https://api.symfony.com/master/Symfony/Component/Console/Input/InputInterface.html)
and [`StyleInterface`](https://api.symfony.com/master/Symfony/Component/Console/Style/StyleInterface.html).

### Implementations

#### `MsgPhp\Domain\Infra\Console\ContextBuilder\ClassContextBuilder`

Build a context value from any class method signature. It configures the CLI signature by mapping required class method
arguments to command arguments, whereas optional ones are mapped to command options.

By default any command argument / option will be optional. If the actual class method argument is required and no value
is given it will be asked interactively. If interaction is not possible an exception will be thrown instead.

- `__construct(string $class, string $method, iterable $elementProviders = [], array $classMapping = [], int $flags = 0)`
    - `$class / $method`: The class method to resolve
    - `$elementProviders`: Available context element providers (see [Providing context elements](#providing-context-elements))
    - `$classMapping`: Global class mapping which resolves `$class` or any nested class name from type info. Usually used
      to map interfaces to concretes.
    - `$flags`: A bit mask value to toggle various flags
        - `ClassContextBuilder::ALWAYS_OPTIONAL`: Always map class method argument to command options
        - `ClassContextBuilder::NO_DEFAULTS`: Leave out default values when calling `getContext()`

##### Providing context elements

Per-element configuration can be provided by implementing a `MsgPhp\Domain\Infra\Console\ContextBuilder\ContextElementProviderInterface`.

- `getElement(string $class, string $method, string $argument): ?ContextElement`
    - Resolve a [`ContextElement`](https://msgphp.github.io/api/MsgPhp/Domain/Infra/Console/ContextBuilder/ContextElement.html)
      from a class/method/argument combination

##### Basic example

```php
<?php

use MsgPhp\Domain\Infra\Console\ContextBuilder\{ClassContextBuilder, ContextElement, ContextElementProviderInterface};
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// --- SETUP ---

class MyClass
{
    public function __construct(string $argument)
    {
    }
}

class MyContextElementProvider implements ContextElementProviderInterface
{
    public function getElement(string $class, string $method, string $argument): ?ContextElement
    {
        return new ContextElement(strtoupper($argument));
    }
}

class MyCommand extends Command
{
    private $contextBuilder;

    public function __construct()
    {
        $this->contextBuilder = new ClassContextBuilder(MyClass::class, '__construct', [new MyContextElementProvider()]);

        parent::__construct();
    }

    protected function configure(): void
    {
       $this->setName('my-command');
       $this->contextBuilder->configure($this->getDefinition());

       // The CLI usage is now:
       // bin/console my-command [argument]
    }

    protected function execute(InputInterface $input,OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $context = $this->contextBuilder->getContext($input, $io); // ['argument' => 'VALUE']
        $object = new MyClass(...array_values($context));

        // do something

        return 0;
    }
}

// --- USAGE ---

// $ bin/console my-command
```
