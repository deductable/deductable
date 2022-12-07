<?php

namespace App\Command;

use App\Builder\TestBuilder\TestDtoDtoBuilder;
use App\ContentResolver\ConstructorInjectionResolver;
use App\ContentResolver\MethodReturnTypeContentResolver;
use App\Director\TestDirector\TestDirector;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symplify\SmartFileSystem\Exception\FileNotFoundException;
use Symplify\SmartFileSystem\SmartFileInfo;

#[AsCommand(name: 'generate', description: 'generate phpunit tests')]
class GenerateTestCommand extends Command
{
    public function __construct(
        private readonly ConstructorInjectionResolver $contentResolver,
    )
    {
        parent::__construct();
    }

    /**
     * @throws FileNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $directory = __DIR__ . '/../CodeExample/';
        $finder = new Finder();
        $files = $finder->files()->in($directory);

        $testBuilder = new TestDtoDtoBuilder();
        $director = new TestDirector($this->contentResolver, $testBuilder);
        foreach ($files as $splFileInfo)
        {
            $file = new SmartFileInfo($splFileInfo);
            $director->makeTestCase($testBuilder, $file);
        }

        return Command::SUCCESS;
    }

}
