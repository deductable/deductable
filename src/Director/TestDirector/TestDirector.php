<?php

namespace App\Director\TestDirector;


use App\Builder\TestBuilder\Contract\TestBuilderInterface;
use PhpParser\Error;
use PhpParser\NodeDumper;
use PhpParser\ParserFactory;
use Symplify\SmartFileSystem\SmartFileInfo;

class TestDirector
{

    public function __construct(TestBuilderInterface $testBuilder)
    {
        $testBuilder->reset();
        $testBuilder->setSetup('Test Builder setup');
        $testBuilder->setMethods(['']);
    }


    public function analyzeTest(SmartFileInfo $file) : void
    {
    }

    public function makeTest(SmartFileInfo $file) : void
    {
        // get file content
        $content = $file->getContents();

        // analyze file
        // TODO: can it be tested? generate measurements of the file (complexity, type interactions, class/method length)

        // parse file into AST
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        try {
            $ast = $parser->parse($content);
            $dumper = new NodeDumper;
            echo $dumper->dump($ast);

        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";
        }

        // generate test from AST
    }

}