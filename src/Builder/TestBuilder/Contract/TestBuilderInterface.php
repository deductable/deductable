<?php

namespace App\Builder\TestBuilder\Contract;


use App\DataTransferObject\TestDto;
use Symplify\SmartFileSystem\SmartFileInfo;

interface TestBuilderInterface
{
    public function getObject();

    public function reset() : void;

    public function setName(string $name): void;

    public function setAst(array $ast): void ;

    public function setFile(SmartFileInfo $file): void;

}
