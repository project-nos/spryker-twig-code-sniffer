<?php

/**
 * Copyright (c) Andreas Penz
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Environment;

use TwigCsFixer\Environment\StubbedEnvironment;

class EnvironmentFactory implements EnvironmentFactoryInterface
{
    /**
     * @param array<\Twig\Extension\ExtensionInterface> $twigExtensions
     * @param array<\Twig\TokenParser\TokenParserInterface> $tokenParsers
     *
     * @return \TwigCsFixer\Environment\StubbedEnvironment
     */
    public function create(array $twigExtensions, array $tokenParsers): StubbedEnvironment
    {
        return new StubbedEnvironment(
            $twigExtensions,
            $tokenParsers,
        );
    }
}
