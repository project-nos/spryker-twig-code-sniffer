<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace NosTest\Shared\TwigCodeSniffer\Runner;

use Codeception\Test\Unit;
use Nos\Shared\TwigCodeSniffer\Config\ConfigBuilderInterface;
use Nos\Shared\TwigCodeSniffer\Environment\EnvironmentFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Fixer\FixerFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Linter\LinterFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Runner\Runner;
use Nos\Shared\TwigCodeSniffer\Tokenizer\TokenizerFactoryInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Twig\Environment;
use Twig\Extension\ExtensionInterface;
use Twig\TokenParser\TokenParserInterface;
use TwigCsFixer\Cache\Manager\CacheManagerInterface;
use TwigCsFixer\Config\Config;
use TwigCsFixer\Report\Report;
use TwigCsFixer\Report\Reporter\TextReporter;
use TwigCsFixer\Report\ReporterFactory;
use TwigCsFixer\Ruleset\Ruleset;
use TwigCsFixer\Runner\Fixer;
use TwigCsFixer\Runner\Linter;
use TwigCsFixer\Token\Tokenizer;

/**
 * Auto-generated group annotations
 *
 * @group NosTest
 * @group Shared
 * @group TwigCodeSniffer
 * @group Runner
 * @group RunnerTest
 * Add your own group annotations below this line
 */
class RunnerTest extends Unit
{
    /**
     * @return void
     */
    public function testRun(): void
    {
        // Arrange
        $configBuilderMock = $this->createMock(ConfigBuilderInterface::class);
        $environmentFactoryMock = $this->createMock(EnvironmentFactoryInterface::class);
        $tokenizerFactoryMock = $this->createMock(TokenizerFactoryInterface::class);
        $fixerFactoryMock = $this->createMock(FixerFactoryInterface::class);
        $linterFactoryMock = $this->createMock(LinterFactoryInterface::class);
        $reporterFactory = new ReporterFactory();

        $runner = new Runner(
            $configBuilderMock,
            $environmentFactoryMock,
            $tokenizerFactoryMock,
            $fixerFactoryMock,
            $linterFactoryMock,
            $reporterFactory,
        );

        $extensionMock = $this->createMock(ExtensionInterface::class);
        $tokenParserMock = $this->createMock(TokenParserInterface::class);
        $cacheManagerMock = $this->createMock(CacheManagerInterface::class);
        $finderMock = $this->createMock(Finder::class);

        $config = new Config();
        $config->addTwigExtension($extensionMock);
        $config->addTokenParser($tokenParserMock);
        $config->setCacheManager($cacheManagerMock);
        $config->setFinder($finderMock);

        $ruleset = new Ruleset();
        $config->setRuleset($ruleset);

        $configBuilderMock->expects($this->once())
            ->method('build')
            ->with([], false)
            ->willReturn($config);

        $environmentMock = $this->createMock(Environment::class);

        $environmentFactoryMock->expects($this->once())
            ->method('create')
            ->with([$extensionMock], [$tokenParserMock])
            ->willReturn($environmentMock);

        $tokenizer = new Tokenizer($environmentMock);

        $tokenizerFactoryMock->expects($this->once())
            ->method('create')
            ->with($environmentMock)
            ->willReturn($tokenizer);

        $linter = new Linter(
            $environmentMock,
            $tokenizer,
            $cacheManagerMock,
        );

        $linterFactoryMock->expects($this->once())
            ->method('create')
            ->with($environmentMock, $tokenizer, $cacheManagerMock)
            ->willReturn($linter);

        $fixer = new Fixer($tokenizer);
        $fixerFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($fixer);

        $inputMock = $this->createMock(InputInterface::class);
        $outputMock = $this->createMock(OutputInterface::class);

        $inputMock->expects($this->once())
            ->method('getArgument')
            ->willReturn([]);

        $inputMock->expects($this->exactly(4))
            ->method('getOption')
            ->willReturnOnConsecutiveCalls(
                false,
                true,
                TextReporter::NAME,
                Report::MESSAGE_TYPE_NOTICE,
            );

        // Act
        $result = $runner->run($inputMock, $outputMock);

        // Assert
        $this->assertEquals(0, $result->getTotalFiles());
    }
}
