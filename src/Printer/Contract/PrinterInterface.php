<?php

namespace App\Printer\Contract;

use App\DataTransferObject\TestDto;

interface PrinterInterface
{
    public function print(TestDto $dto) :void;
}
