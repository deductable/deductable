<?php

namespace App\DataTransferObject;

use PhpParser\Node\Stmt;
use Symplify\SmartFileSystem\SmartFileInfo;

class TestDto
{
    private string $name;
    private SmartFileInfo $file;

    /**
     * @var array<int, Stmt> $ast
     */
    private array $ast;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return SmartFileInfo
     */
    public function getFile(): SmartFileInfo
    {
        return $this->file;
    }

    /**
     * @param SmartFileInfo $file
     */
    public function setFile(SmartFileInfo $file): void
    {
        $this->file = $file;
    }

    /**
     * @return array<int, Stmt>
     */
    public function getAst(): array
    {
        return $this->ast;
    }

    /**
     * @param array<int, Stmt> $ast
     */
    public function setAst(array $ast): void
    {
        $this->ast = $ast;
    }
}
