<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Runner;

use Nos\Shared\TwigCodeSniffer\Config\ConfigBuilderInterface;
use Nos\Shared\TwigCodeSniffer\Environment\EnvironmentFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Fixer\FixerFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Linter\LinterFactoryInterface;
use Nos\Shared\TwigCodeSniffer\Tokenizer\TokenizerFactoryInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TwigCsFixer\Report\Report;
use TwigCsFixer\Report\ReporterFactory;

class Runner implements RunnerInterface
{
    /**
     * @var string
     */
    protected const ARGUMENT_PATHS = 'paths';

    /**
     * @var string
     */
    protected const OPTION_NO_CACHE = 'no-cache';

    /**
     * @var string
     */
    protected const OPTION_FIX = 'fix';

    /**
     * @var string
     */
    protected const OPTION_REPORT = 'report';

    /**
     * @var string
     */
    protected const OPTION_LEVEL = 'level';

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Config\ConfigBuilderInterface
     */
    protected ConfigBuilderInterface $configBuilder;

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Environment\EnvironmentFactoryInterface
     */
    protected EnvironmentFactoryInterface $environmentFactory;

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Tokenizer\TokenizerFactoryInterface
     */
    protected TokenizerFactoryInterface $tokenizerFactory;

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Fixer\FixerFactoryInterface
     */
    protected FixerFactoryInterface $fixerFactory;

    /**
     * @var \Nos\Shared\TwigCodeSniffer\Linter\LinterFactoryInterface
     */
    protected LinterFactoryInterface $linterFactory;

    /**
     * @var \TwigCsFixer\Report\ReporterFactory
     */
    protected ReporterFactory $reporterFactory;

    /**
     * @param \Nos\Shared\TwigCodeSniffer\Config\ConfigBuilderInterface $configBuilder
     * @param \Nos\Shared\TwigCodeSniffer\Environment\EnvironmentFactoryInterface $environmentFactory
     * @param \Nos\Shared\TwigCodeSniffer\Tokenizer\TokenizerFactoryInterface $tokenizerFactory
     * @param \Nos\Shared\TwigCodeSniffer\Fixer\FixerFactoryInterface $fixerFactory
     * @param \Nos\Shared\TwigCodeSniffer\Linter\LinterFactoryInterface $linterFactory
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
