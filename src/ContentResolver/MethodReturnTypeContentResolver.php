<?php

namespace App\ContentResolver;

use App\DataTransferObject\TestDto;
use PhpParser\Builder\Namespace_;
use PhpParser\BuilderFactory;
use PhpParser\NodeFinder;
use PhpParser\Node;

class MethodReturnTypeContentResolver
{

    public function resolve(TestDto $testDto, Namespace_ $testFileNode): void
    {
        $this->resolveReturnTypes($testDto, $testFileNode);
    }

    private function resolveReturnTypes(TestDto $testDto, Namespace_ $testFileNode): void
    {
        $nodeFinder = new NodeFinder();
        $stmts = $testDto->getAst();

        $classMethodReturnTypes = $nodeFinder->find($stmts, function (Node $node)
        {
            return $node instanceof Node\Stmt\ClassMethod &&
                $node->getReturnType() instanceof Node\Expr\Cast\Bool_;
        });

        if ($classMethodReturnTypes) {
            $this->addAssetBool($classMethodReturnTypes, $testFileNode);
        }

    }

    private function addAssetBool(array $classMethodReturnTypes, Namespace_ $testFileNode): void
    {
        /** @var Node\Stmt\ClassMethod $classMethodReturnType */
        foreach ($classMethodReturnTypes as $classMethodReturnType){
            $methodName = $classMethodReturnType->name->name;
            if(!$methodName){
                continue;
            }

            $nodeFinder = new NodeFinder();


            $factory = new BuilderFactory();
            $testFileNode->addStmt($factory->method($methodName.'_test')->makePublic());
        }
    }

}
