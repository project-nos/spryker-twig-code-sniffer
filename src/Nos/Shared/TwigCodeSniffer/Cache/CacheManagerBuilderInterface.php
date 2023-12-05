<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Cache;

use TwigCsFixer\Cache\Manager\CacheManagerInterface;
use TwigCsFixer\Ruleset\Ruleset;

interface CacheManagerBuilderInterface
{
    /**
     * @param \TwigCsFixer\Ruleset\Ruleset $ruleset
     *
     * @return \TwigCsFixer\Cache\Manager\CacheManagerInterface
     */
    public function build(Ruleset $ruleset): CacheManagerInterface;
}
