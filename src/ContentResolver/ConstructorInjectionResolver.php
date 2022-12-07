<?php

namespace App\ContentResolver;

use App\DataTransferObject\TestDto;
use PhpParser\Builder\Namespace_;
use PhpParser\BuilderFactory;
use PhpParser\NodeFinder;
use PhpParser\Node;

class ConstructorInjectionResolver
{

    public function resolve(TestDto $testDto, Namespace_ $testFileNode): void
    {
        $this->resolveConstructInjection($testDto, $testFileNode);
    }

    private function resolveConstructInjection(TestDto $testDto, Namespace_ $testFileNode): void
    {
        $nodeFinder = new NodeFinder();
        $stmts = $testDto->getAst();

        $constructs = $nodeFinder->find($stmts, function (Node $node)
        {
             return $node instanceof Node\Stmt\ClassMethod &&
                 $node->isPublic() &&
                $node->name->name === '__construct';
        });


        if ($constructs) {
            $this->addDependancyInjection($constructs, $testFileNode);
        }

    }

    private function addDependancyInjection(array $classMethodReturnTypes, Namespace_ $testFileNode): void
    {
        /** @var Node\Stmt\ClassMethod $classMethodReturnType */
        foreach ($classMethodReturnTypes as $classMethodReturnType){
            $methodName = $classMethodReturnType->name->name;
            if(!$methodName){
                continue;
            }

            $factory = new BuilderFactory();
            $testFileNode->addStmt($factory->method($methodName.'_test')->makePublic());
        }
    }

}
