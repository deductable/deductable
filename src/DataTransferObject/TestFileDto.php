<?php

namespace App\DataTransferObject;

use Doctrine\Common\Collections\ArrayCollection;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\ClassMethod;
use Symplify\SmartFileSystem\SmartFileInfo;
use Doctrine\Common\Collections\Collection;

class TestFileDto
{
    private string $className;
    private string $filename;
    private SmartFileInfo $file;
    private Collection $methods;

    public function __construct()
    {
        $this->methods = new ArrayCollection();
    }

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

    /**
     * @return ArrayCollection<ClassMethod>>
     */
    public function getMethods(): Collection
    {
        return $this->methods;
    }

    public function addMethod(ClassMethod $method): self
    {
        if (! $this->methods->contains($method)) {
            $this->methods[] = $method;
        }

        return $this;
    }

    public function removeImage(ClassMethod $method): self
    {
        $this->methods->removeElement($method);
        return $this;
    }

}
