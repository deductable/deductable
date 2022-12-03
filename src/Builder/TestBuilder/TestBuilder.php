<?php

namespace App\Builder\TestBuilder;

use App\Builder\TestBuilder\Contract\TestBuilderInterface;
use App\DataTransferObject\TestDto;
use Symplify\SmartFileSystem\SmartFileInfo;

class TestBuilder implements TestBuilderInterface
{
    private TestDto $test;

    public function __construct()
    {
        $this->reset();
    }

    public function reset() : void
    {
        $this->test = new TestDto();
    }

    public function getObject() : TestDto
    {
        $test = $this->test;
        $this->reset();
        return $test;
    }

    public function setFilename(string $filename): void
    {
        $this->test->setFilename($filename);
    }

    public function setClassName(string $className): void
    {
        $this->test->setClassName($className);
    }

    public function setAst(array $ast): void
    {
        $this->test->setAst($ast);
    }

    public function setFile(SmartFileInfo $file): void
    {
        $this->test->setFile($file);
    }

    public function setContent(array $content): void
    {
        $this->test->setContent($content);
    }
}
