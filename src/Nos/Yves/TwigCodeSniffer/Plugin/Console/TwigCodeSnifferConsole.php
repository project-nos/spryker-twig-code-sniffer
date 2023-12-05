<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Yves\TwigCodeSniffer\Plugin\Console;

use Spryker\Yves\Kernel\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TwigCsFixer\Report\Report;
use TwigCsFixer\Report\Reporter\TextReporter;

/**
 * @method \Nos\Yves\TwigCodeSniffer\TwigCodeSnifferFactory getFactory()
 */
class TwigCodeSnifferConsole extends Console
{
    /**
     * @var string
     */
    protected const COMMAND_NAME = 'code:sniff:twig';

    /**
     * @var string
     */
    protected const COMMAND_DESCRIPTION = 'Sniff and fix twig code style';

    /**
     * @var string
     */
    protected const ARGUMENT_PATHS = 'paths';

    /**
     * @var string
     */
    protected const OPTION_LEVEL = 'level';

    /**
     * @var string
     */
    protected const OPTION_REPORT = 'report';

    /**
     * @var string
     */
    protected const OPTION_FIX = 'fix';

    /**
     * @var string
     */
    protected const OPTION_NO_CACHE = 'no-cache';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::COMMAND_DESCRIPTION);

        $this->addArgument(
            static::ARGUMENT_PATHS,
            InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
            'Paths of files and folders to parse',
        );

        $this->addOption(
            static::OPTION_LEVEL,
            null,
            InputOption::VALUE_REQUIRED,
            'Allowed values are notice, warning or error',
            Report::MESSAGE_TYPE_NOTICE,
        );

        $this->addOption(
            static::OPTION_REPORT,
            null,
            InputOption::VALUE_REQUIRED,
            'Report format',
            TextReporter::NAME,
        );

        $this->addOption(
            static::OPTION_FIX,
            null,
            InputOption::VALUE_NONE,
            'Automatically fix all the fixable violations',
        );

        $this->addOption(
            static::OPTION_NO_CACHE,
            null,
            InputOption::VALUE_NONE,
            'Disable cache while running the fixer',
        );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return $this->getFactory()->createRunner()->run($input, $output)->getTotalErrors() === 0 ? static::CODE_SUCCESS : static::CODE_ERROR;
    }
}
