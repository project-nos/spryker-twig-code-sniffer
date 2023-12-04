<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Tokenizer;

use Twig\Environment;
use TwigCsFixer\Token\Tokenizer;
use TwigCsFixer\Token\TokenizerInterface;

class TokenizerFactory implements TokenizerFactoryInterface
{
    /**
     * @param \Twig\Environment $environment
     *
     * @return \TwigCsFixer\Token\TokenizerInterface
     */
    public function create(Environment $environment): TokenizerInterface
    {
        return new Tokenizer($environment);
    }
}
