<?php

namespace App\CodeExample;

use Symfony\Component\Console\Command\Command;

class DependancyInjectionExample
{
    public function __construct(
        private Command $command
    )
    {
    }

    public function useInjectedObject()
    {
        $this->command->setName('soomething');
    }
}
