<?php

namespace App\Printer;
use App\DataTransferObject\TestDto;
use PhpParser\Node;
use App\Printer\Contract\PrinterInterface;
use PhpParser\PrettyPrinter\Standard;
use Symplify\SmartFileSystem\SmartFileSystem;

class Printer implements PrinterInterface
{
    private const TEST_DIR = __DIR__.'/../../tests/';

    public function print(TestDto $testDto, Node $node): void
    {
       $filesystem = new SmartFileSystem();

       if($filesystem->exists(self::TEST_DIR.$testDto->getFilename())){
           return;
       }

        $prettyPrinter = new Standard();
        $stmts = array($node);
        $content = $prettyPrinter->prettyPrintFile($stmts);
        $filesystem->dumpFile(self::TEST_DIR.$testDto->getFilename(), $content);
    }
}
