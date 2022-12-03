<?php

namespace App\Director\TestDirector;


use App\Builder\TestBuilder\Contract\TestBuilderInterface;
use App\Builder\TestBuilder\TestBuilder;
use App\Printer\Printer;
use PhpParser\Error;
use PhpParser\ParserFactory;
use Symplify\SmartFileSystem\SmartFileInfo;

class TestDirector
{

    public function __construct(TestBuilderInterface $testBuilder)
    {
        $testBuilder->reset();
    }


    public function analyzeTest(SmartFileInfo $file) : void
    {
    }

    public function makeTestCase(TestBuilder $testBuilder, SmartFileInfo $file) : void
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
            $testBuilder->setContent($ast);

        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}";
        }

        // generate test from AST


        // Print Test
        $printer = new Printer();
        $printer->print($testBuilder->getObject());
    }

}
