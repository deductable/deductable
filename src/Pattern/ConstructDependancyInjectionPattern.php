<?php

namespace App\Pattern;

use App\DataTransferObject\ClassMethodDto;
use PhpParser\{BuilderFactory, Node, NodeFinder};

class ConstructDependancyInjectionPattern implements PatternInterface
{
    public const PATTERN_NAME = 'ConstructDependancyInjectionPattern';

    public function getMatches(array $ast) : array
    {
        $nodeFinder = new NodeFinder();
        $data = $nodeFinder->find($ast, function(Node $node) {
            return $node instanceof Node\Stmt\Class_&&
                $node->getMethod('construct');
        });
        return $data;
    }

    public function generateTestMethod(Node\Stmt\ClassMethod $classMethod): Node
    {
        $factory = new BuilderFactory();
        $methodName =  strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $classMethod->name)).'_test';
        $node = $factory->method($methodName)->getNode();
        return $node;
    }

    public function getComplexityScore(): int
    {
        return  1;
    }

    public function getName(): string {
        return self::PATTERN_NAME;
    }

}
