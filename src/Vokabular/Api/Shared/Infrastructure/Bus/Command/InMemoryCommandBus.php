<?php

namespace App\Vokabular\Api\Shared\Infrastructure\Bus\Command;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use App\Vokabular\Api\Shared\Infrastructure\Bus\HandlerBuilder;
use InvalidArgumentException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Throwable;

final class InMemoryCommandBus implements CommandBus
{

    private MessageBus $bus;

    public function __construct(iterable $commandHandlers)
    {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(
                new HandlersLocator(
                    HandlerBuilder::fromCallables($commandHandlers),
                )
            )
        ]);

    }

    /**
     * @throws Throwable
     */
    public function dispatch(Command $command): void
    {
        try {
            $this->bus->dispatch($command);
        } catch (NoHandlerForMessageException $e) {
            throw new InvalidArgumentException(
                sprintf('The command has not a valid handler: %s', $command::class),
                $e->getCode()
            );
        } catch (HandlerFailedException $e) {
            throw $e->getPrevious();
        }
    }
}