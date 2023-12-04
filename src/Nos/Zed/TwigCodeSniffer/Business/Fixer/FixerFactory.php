<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Fixer;

use TwigCsFixer\Runner\Fixer;
use TwigCsFixer\Token\TokenizerInterface;

class FixerFactory implements FixerFactoryInterface
{
    /**
     * @param \TwigCsFixer\Token\TokenizerInterface $tokenizer
     *
     * @return \TwigCsFixer\Runner\Fixer
     */
    public function create(TokenizerInterface $tokenizer): Fixer
    {
        return new Fixer($tokenizer);
    }
}
