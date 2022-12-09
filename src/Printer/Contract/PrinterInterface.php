<?php

namespace App\Printer\Contract;

use App\DataTransferObject\TestFileDto;

interface PrinterInterface
{
    public function print(TestFileDto $testDto) :void;
}
