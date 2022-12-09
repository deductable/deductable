<?php

namespace App\DataTransferObject;

use PhpParser\Node;

class ClassMethodDto
{

    private string $name;
    private Node $content;

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
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param array $content
     */
    public function setContent(array $content): void
    {
        $this->content = $content;
    }

}
