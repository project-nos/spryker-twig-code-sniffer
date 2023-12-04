<?php

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
