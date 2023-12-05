<?php

/**
 * Copyright (c) Andreas Penz
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Ruleset;

use TwigCsFixer\Ruleset\Ruleset;

class RulesetFactory implements RulesetFactoryInterface
{
    /**
     * @return \TwigCsFixer\Ruleset\Ruleset
     */
    public function create(): Ruleset
    {
        return new Ruleset();
    }
}
