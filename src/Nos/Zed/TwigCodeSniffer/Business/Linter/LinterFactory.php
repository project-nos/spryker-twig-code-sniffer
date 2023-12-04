<?php

/**
 * Copyright (c) Andreas Penz
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Linter;

use Twig\Environment;
use TwigCsFixer\Cache\Manager\CacheManagerInterface;
use TwigCsFixer\Runner\Linter;
use TwigCsFixer\Token\TokenizerInterface;

class LinterFactory implements LinterFactoryInterface
{
    /**
     * @param \Twig\Environment $environment
     * @param \TwigCsFixer\Token\TokenizerInterface $tokenizer
     * @param \TwigCsFixer\Cache\Manager\CacheManagerInterface|null $cacheManager
     *
     * @return \TwigCsFixer\Runner\Linter
     */
    public function create(Environment $environment, TokenizerInterface $tokenizer, ?CacheManagerInterface $cacheManager = null): Linter
    {
        return new Linter($environment, $tokenizer, $cacheManager);
    }
}
