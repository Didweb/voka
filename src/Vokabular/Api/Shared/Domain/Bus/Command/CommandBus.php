<?php

namespace App\Vokabular\Api\Shared\Domain\Bus\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}