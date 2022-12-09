<?php

namespace App\Pattern;

use App\DataTransferObject\ClassMethodDto;
use PhpParser\{Node};

interface PatternInterface
{
    /**
     * @param array<Node> $ast
     * @return array
     */
    public function getMatches(array $ast): array;

    public function generateTestMethod(Node\Stmt\ClassMethod $classMethod): Node;

    public function getComplexityScore(): int;

    public function getName(): string;
}
