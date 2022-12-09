<?php

namespace App\Pattern;

use App\DataTransferObject\ClassMethodDto;
use Doctrine\Common\Annotations\PhpParser;
use PhpParser\{BuilderFactory, Node, NodeFinder};
use PHPStan\Node\ClassMethod;
use Tracy\Debugger;

class ClassMethodBooleanReturnTypePattern implements PatternInterface
{
    public const PATTERN_NAME = 'ClassMethodBooleanReturnTypePattern';

    public function getMatches(array $ast): array
    {
        $nodeFinder = new NodeFinder();
        return $nodeFinder->find($ast, function (Node $node) {

            return $node instanceof Node\Stmt\ClassMethod &&
                $node->getReturnType()?->name === 'bool';
        });
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
        return 1;
    }

    public function getName(): string
    {
        return self::PATTERN_NAME;
    }

}
