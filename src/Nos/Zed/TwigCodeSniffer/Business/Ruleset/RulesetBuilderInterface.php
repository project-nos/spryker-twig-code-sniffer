<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Ruleset;

use TwigCsFixer\Ruleset\Ruleset;

interface RulesetBuilderInterface
{
    /**
     * @return \TwigCsFixer\Ruleset\Ruleset
     */
    public function build(): Ruleset;
}
