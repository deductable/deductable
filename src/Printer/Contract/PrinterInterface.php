<?php

namespace App\Printer\Contract;

use App\DataTransferObject\TestDto;
use PhpParser\Node;

interface PrinterInterface
{
    public function print(TestDto $dto, Node $node) :void;
}
