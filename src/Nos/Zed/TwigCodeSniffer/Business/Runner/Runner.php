<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Runner;

use Nos\Zed\TwigCodeSniffer\Business\Config\ConfigBuilderInterface;
use Nos\Zed\TwigCodeSniffer\Business\Environment\EnvironmentFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Fixer\FixerFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Linter\LinterFactoryInterface;
use Nos\Zed\TwigCodeSniffer\Business\Tokenizer\TokenizerFactoryInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TwigCsFixer\Report\Report;
use TwigCsFixer\Report\ReporterFactory;

class Runner implements RunnerInterface
{
    /**
     * @uses \Nos\Zed\TwigCodeSniffer\Communication\Console\TwigCodeSnifferConsole::ARGUMENT_PATHS
     *
     * @var string
     */
    protected const ARGUMENT_PATHS = 'paths';

    /**
     * @uses \Nos\Zed\TwigCodeSniffer\Communication\Console\TwigCodeSnifferConsole::OPTION_NO_CACHE
     *
     * @var string
     */
    protected const OPTION_NO_CACHE = 'no-cache';

    /**
     * @uses \Nos\Zed\TwigCodeSniffer\Communication\Console\TwigCodeSnifferConsole::OPTION_FIX
     *
     * @var string
     */
    protected const OPTION_FIX = 'fix';

    /**
     * @uses \Nos\Zed\TwigCodeSniffer\Communication\Console\TwigCodeSnifferConsole::OPTION_REPORT
     *
     * @var string
     */
    protected const OPTION_REPORT = 'report';

    /**
     * @uses \Nos\Zed\TwigCodeSniffer\Communication\Console\TwigCodeSnifferConsole::OPTION_LEVEL
     *
     * @var string
     */
    protected const OPTION_LEVEL = 'level';

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Config\ConfigBuilderInterface
     */
    protected ConfigBuilderInterface $configBuilder;

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Environment\EnvironmentFactoryInterface
     */
    protected EnvironmentFactoryInterface $environmentFactory;

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Tokenizer\TokenizerFactoryInterface
     */
    protected TokenizerFactoryInterface $tokenizerFactory;

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Fixer\FixerFactoryInterface
     */
    protected FixerFactoryInterface $fixerFactory;

    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Linter\LinterFactoryInterface
     */
    protected LinterFactoryInterface $linterFactory;

    /**
     * @var \TwigCsFixer\Report\ReporterFactory
     */
    protected ReporterFactory $reporterFactory;

    /**
     * @param \Nos\Zed\TwigCodeSniffer\Business\Config\ConfigBuilderInterface $configBuilder
     * @param \Nos\Zed\TwigCodeSniffer\Business\Environment\EnvironmentFactoryInterface $environmentFactory
     * @param \Nos\Zed\TwigCodeSniffer\Business\Tokenizer\TokenizerFactoryInterface $tokenizerFactory
     * @param \Nos\Zed\TwigCodeSniffer\Business\Fixer\FixerFactoryInterface $fixerFactory
     * @param \Nos\Zed\TwigCodeSniffer\Business\Linter\LinterFactoryInterface $linterFactory
     * @param \TwigCsFixer\Report\ReporterFactory $reporterFactory
     */
    public function __construct(
        ConfigBuilderInterface $configBuilder,
        EnvironmentFactoryInterface $environmentFactory,
        TokenizerFactoryInterface $tokenizerFactory,
        FixerFactoryInterface $fixerFactory,
        LinterFactoryInterface $linterFactory,
        ReporterFactory $reporterFactory
    ) {
        $this->configBuilder = $configBuilder;
        $this->environmentFactory = $environmentFactory;
        $this->tokenizerFactory = $tokenizerFactory;
        $this->fixerFactory = $fixerFactory;
        $this->linterFactory = $linterFactory;
        $this->reporterFactory = $reporterFactory;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return \TwigCsFixer\Report\Report
     */
    public function run(InputInterface $input, OutputInterface $output): Report
    {
        $config = $this->configBuilder->build(
            $input->getArgument(static::ARGUMENT_PATHS),
            $input->getOption(static::OPTION_NO_CACHE),
        );

        $environment = $this->environmentFactory->create(
            $config->getTwigExtensions(),
            $config->getTokenParsers(),
        );

        $tokenizer = $this->tokenizerFactory->create($environment);

        $linter = $this->linterFactory->create(
            $environment,
            $tokenizer,
            $config->getCacheManager(),
        );

        $report = $linter->run(
            $config->getFinder(),
            $config->getRuleset(),
            $input->getOption(static::OPTION_FIX) ? $this->fixerFactory->create($tokenizer) : null,
        );

        $reporter = $this->reporterFactory->getReporter($input->getOption(static::OPTION_REPORT));
        $reporter->display($output, $report, $input->getOption(static::OPTION_LEVEL));

        return $report;
    }
}
