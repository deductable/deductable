<?php

namespace App\Builder\TestBuilder;

use App\Builder\TestBuilder\Contract\TestBuilderInterface;
use App\Model\Test;
use PHPUnit\Framework\TestCase;

class TestBuilder implements TestBuilderInterface
{
    private Test $test;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->test = new Test();
    }

    public function setSetup()
    {
        $this->test->setName('');
    }

    public function setMethods()
    {
        return [
            'some_first_test' => 'method content'
        ];
    }

    public function getObject() : Test
    {
        $test = $this->test;
        $this->reset();
        return $test;
    }


}