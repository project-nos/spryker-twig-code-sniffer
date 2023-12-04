<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Ruleset;

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
