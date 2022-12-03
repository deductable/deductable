<?php

namespace App\Director\TestDirector;


use App\Builder\TestBuilder\Contract\TestBuilderInterface;
use App\Builder\TestBuilder\TestBuilder;
use PhpParser\Error;
use PhpParser\NodeDumper;
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
            $filename = $file->getFilenameWithoutExtension() . 'Test';
            $testBuilder->setName($filename);
            $testBuilder->setFile($file);
            $ast = $parser->parse($content);
            $testBuilder->setAst($ast);

            dd($testBuilder->getObject());

        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";
        }

        // generate test from AST
    }

}
