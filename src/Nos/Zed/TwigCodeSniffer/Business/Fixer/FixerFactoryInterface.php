<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Fixer;

use TwigCsFixer\Runner\Fixer;
use TwigCsFixer\Token\TokenizerInterface;

interface FixerFactoryInterface
{
    /**
     * @param \TwigCsFixer\Token\TokenizerInterface $tokenizer
     *
     * @return \TwigCsFixer\Runner\Fixer
     */
    public function create(TokenizerInterface $tokenizer): Fixer;
}
