# Message driven PHP

[![Build status][master:travis:img]][master:travis]
[![Code coverage][master:codecov:img]][master:codecov]

MsgPHP is a project that aims to provide (common) message based domain layers for your application. It has a low
development time overhead and avoids being overly opinionated.

## Domain Layers

> The domain layer is a collection of entity objects and related business logic that is designed to represent the 
> enterprise business model. The major scope of this layer is to create a standardized and federated set of objects, 
> that could be potentially reused within different projects. ([source](https://www.javacodegeeks.com/2013/05/multilayered-architecture-2-the-domain-layer.html))

## Message Based

Each domain layer provides a set of messages to consume it. Typically the messages are categorized into command-, event-
and query-messages.

The main advantage is we can intuitively create an independent flow of business logic. It provides consistency in
handling our business logic by dispatching the same message in e.g. web as well as CLI.

```php
$anyMessageBus->dispatch(new CreateSomething(['field' => 'value']));
```

A command-message is dispatched and picked up by its handler to do the work. This handler on itself dispatches a new
event-message (e.g. `SomethingCreated`) to notify the work is done.

A custom handler can subscribe to the `SomethingCreated` event to further finalize the business requirements (e.g.
dispatch another commmand-message).

```php
class MakeSomethingWork
{
    private $bus;

    public function __construct(YourFavoriteBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(SomethingCreated $event)
    {
        // do work, or better delegate work:
        $this->bus->dispatch(new LetSomethingWork($event->something));
    }
}
```

# Documentation

- Read the [main documentation](https://msgphp.github.io/docs/)
- Try the Symfony [demo application](https://github.com/msgphp/symfony-demo-app)
- Get support on [Symfony's Slack `#msgphp` channel](https://symfony.com/slack-invite) or [raise an issue](https://github.com/msgphp/msgphp/issues/new)

# Contributing

See [`CONTRIBUTING.md`](CONTRIBUTING.md)

[master:travis]: https://travis-ci.org/msgphp/msgphp
[master:travis:img]: https://img.shields.io/travis/msgphp/msgphp/master.svg?style=flat-square
[master:codecov]: https://codecov.io/gh/msgphp/msgphp
[master:codecov:img]: https://img.shields.io/codecov/c/github/msgphp/msgphp/master.svg?style=flat-square
