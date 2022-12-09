<?php

namespace App\CodeExample;

use Symfony\Component\Console\Command\Command;

class DependencyInjectionExample
{
    public function useInjectedObject() : bool
    {
        $this->command->setName('soomething');
    }
}
