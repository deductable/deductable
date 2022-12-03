<?php

namespace App\Builder\TestBuilder\Contract;


interface TestBuilderInterface
{
    public function getObject();

    public function reset();

    public function setSetup();

    public function setMethods();

}