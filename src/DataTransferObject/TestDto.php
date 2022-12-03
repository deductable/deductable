<?php

namespace App\DataTransferObject;

use PhpParser\Node\Stmt;
use Symplify\SmartFileSystem\SmartFileInfo;

class TestDto
{
    private string $className;
    private string $filename;
    private SmartFileInfo $file;

    /**
     * @var array<int, Stmt> $content
     */
    private array $content;

    /**
     * @var array<int, Stmt> $ast
     */
    private array $ast;

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className
     */
    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
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

    /**
     * @return array<int,Stmt>
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param array<int,Stmt> $content
     */
    public function setContent(array $content): void
    {
        $this->content = $content;
    }

}
