<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Tokenizer;

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
