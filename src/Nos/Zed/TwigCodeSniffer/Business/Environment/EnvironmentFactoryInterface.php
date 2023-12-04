<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Environment;

use Twig\Environment;

interface EnvironmentFactoryInterface
{
    /**
     * @param array<\Twig\Extension\ExtensionInterface> $extensions
     * @param array<\Twig\TokenParser\TokenParserInterface> $tokenParsers
     *
     * @return \Twig\Environment
     */
    public function create(array $extensions, array $tokenParsers): Environment;
}
