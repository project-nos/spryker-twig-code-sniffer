<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TwigCsFixer\Report\Report;

interface TwigCodeSnifferFacadeInterface
{
    /**
     * Specification:
     * - Checks twig files for violations
     * - Fixes them automatically if requested
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return \TwigCsFixer\Report\Report
     */
    public function run(InputInterface $input, OutputInterface $output): Report;
}
