<?php

namespace App\CodeExample;

use Symfony\Component\Console\Command\Command;

class BooleanClassMethodReturnTypeExample
{
    public function __construct(
    )
    {
    }

    public function getTruth() : bool
    {
        return false;
    }

}
