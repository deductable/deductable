<?php

namespace App\Printer;

use App\DataTransferObject\ClassMethodDto;
use App\DataTransferObject\TestFileDto;
use PhpParser\Builder\Class_;
use PhpParser\Builder\Namespace_;
use PhpParser\BuilderFactory;
use PhpParser\Node;
use App\Printer\Contract\PrinterInterface;
use PhpParser\NodeFinder;
use PhpParser\PrettyPrinter\Standard;
use PHPUnit\Framework\TestCase;
use Symplify\SmartFileSystem\SmartFileSystem;

class Printer implements PrinterInterface
{
    private const TEST_DIR = __DIR__ . '/../../tests/';

    public function print(TestFileDto $testDto): void
    {
        $filesystem = new SmartFileSystem();

        if ($filesystem->exists(self::TEST_DIR . $testDto->getFilename())) {
            return;
        }


        $prettyPrinter = new Standard();
        $stmts = $this->compileTestAst($testDto);
        $content = $prettyPrinter->prettyPrintFile($stmts);
        $filesystem->dumpFile(self::TEST_DIR . $testDto->getFilename(), $content);
    }

    private function compileTestAst(TestFileDto $testDto): array
    {
        $factory = new BuilderFactory();
        $className = $testDto->getFile()->getFilenameWithoutExtension() . 'Test';
        $class = $factory->class($className)->extend(TestCase::class);
        $node = $factory->namespace('App\Test')
            ->addStmt($class->addStmts($testDto->getMethods()->toArray()));

        return [$node->getNode()];
    }
}
