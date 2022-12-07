<?php

namespace App\Director\TestDirector;


use App\Builder\TestBuilder\Contract\TestDtoBuilderInterface;
use App\Builder\TestBuilder\TestDtoDtoBuilder;
use App\ContentResolver\ConstructorInjectionResolver;
use App\ContentResolver\MethodReturnTypeContentResolver;
use App\DataTransferObject\TestDto;
use App\Printer\Printer;
use PhpParser\BuilderFactory;
use PhpParser\Error;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use PHPUnit\Framework\TestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

class TestDirector
{

    public function __construct(
        private readonly ConstructorInjectionResolver $contentResolver,
        TestDtoBuilderInterface                          $testBuilder
    )
    {
        $testBuilder->reset();
    }


    public function analyzeTest(SmartFileInfo $file): void
    {
    }

    public function makeTestCase(TestDtoDtoBuilder $testBuilder, SmartFileInfo $file): void
    {
        // get file content
        $content = $file->getContents();

        // analyze file
        // TODO: can it be tested? generate measurements of the file (complexity, type interactions, class/method length)

        // parse file into AST
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        try {
            $className = $file->getFilenameWithoutExtension() . 'Test';
            $filename = $file->getFilenameWithoutExtension() . 'Test.php';
            $testBuilder->setClassName($className);
            $testBuilder->setFilename($filename);
            $testBuilder->setFile($file);
            $ast = $parser->parse($content);
            $testBuilder->setAst($ast);

        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}";
        }

        // generate test in AST
        $factory = new BuilderFactory();

        $node = $factory->namespace('App\Test')
            ->addStmt($factory->class($className)->extend(TestCase::class));

        $this->contentResolver->resolve($testBuilder->getObject(), $node);

        // Print Test
        $printer = new Printer();
        $printer->print($testBuilder->getObject(), $node->getNode());
    }

}
