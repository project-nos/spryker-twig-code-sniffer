<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Tokenizer;

use Twig\Environment;
use TwigCsFixer\Token\TokenizerInterface;

interface TokenizerFactoryInterface
{
    /**
     * @param \Twig\Environment $environment
     *
     * @return \TwigCsFixer\Token\TokenizerInterface
     */
    public function create(Environment $environment): TokenizerInterface;
}
