<?php

namespace App\Vokabular\Frontend\Shared\Domain\Bus\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}