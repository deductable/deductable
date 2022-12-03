<?php

namespace App\Director\TestDirector;


use App\Builder\TestBuilder\Contract\TestBuilderInterface;
use PhpParser\Error;
use PhpParser\NodeDumper;
use PhpParser\ParserFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Symplify\SmartFileSystem\SmartFileInfo;
use Symplify\SmartFileSystem\SmartFileSystem;

class TestDirector
{

    public function __construct(TestBuilderInterface $testBuilder)
    {
        $testBuilder->reset();
        $testBuilder->setSetup('Test Builder setup');
        $testBuilder->setMethods(['']);
    }

    public function makeTest(SmartFileInfo $file) : void
    {
        $content = $file->getContents();
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        try {
            $ast = $parser->parse($content);
            $dumper = new NodeDumper;
            echo $dumper->dump($ast);

        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";
        }
    }

}