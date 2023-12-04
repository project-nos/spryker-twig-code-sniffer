<?php

/**
 * Copyright (c) Andreas Penz
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Ruleset;

use TwigCsFixer\Ruleset\Ruleset;

interface RulesetFactoryInterface
{
    /**
     * @return \TwigCsFixer\Ruleset\Ruleset
     */
    public function create(): Ruleset;
}
