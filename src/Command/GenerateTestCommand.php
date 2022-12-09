<?php

namespace App\Command;

use App\DataTransferObject\TestFileDto;
use App\Pattern\PatternInterface;
use App\Printer\Printer;
use PhpParser\Error;
use PhpParser\ParserFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\Finder\Finder;
use Symplify\SmartFileSystem\Exception\FileNotFoundException;
use Symplify\SmartFileSystem\SmartFileInfo;

#[AsCommand(name: 'generate', description: 'generate phpunit tests')]
class GenerateTestCommand extends Command
{

    public function __construct(
        private readonly RewindableGenerator $patterns,
        private readonly Printer             $printer
    )
    {
        parent::__construct();
    }

    /**
     * @throws FileNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $finder = new Finder();
        $directory = __DIR__ . '/../CodeExample/';
        $files = $finder->files()->in($directory);

        /** @var PatternInterface $pattern */
        foreach ($this->patterns as $pattern) {
            $info = [];

            foreach ($files as $splFileInfo) {
                $file = new SmartFileInfo($splFileInfo);
                $testFileDto = new TestFileDto();
                $testFileDto->setFilename($file->getFilenameWithoutExtension(). 'Test.php');
                $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
                $info["fileName"] = $file->getFilenameWithoutExtension();

                try {
                    $testFileDto->setFile($file);
                    $ast = $parser->parse($file->getContents());
                    $matches = $pattern->getMatches($ast);

                    foreach ($matches as $match) {
                        $method = $pattern->generateTestMethod($match);
                        $testFileDto->addMethod($method);
                    }

                    $this->printer->print($testFileDto);

                } catch (Error $error) {
                    echo "Parse error: {$error->getMessage()}\n";
                }

            }
        }

        return Command::SUCCESS;
    }

}
