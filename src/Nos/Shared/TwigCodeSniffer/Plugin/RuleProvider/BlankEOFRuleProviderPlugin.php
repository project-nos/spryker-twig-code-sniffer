<?php

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider;

use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface;
use TwigCsFixer\Rules\RuleInterface;
use TwigCsFixer\Rules\Whitespace\BlankEOFRule;

class BlankEOFRuleProviderPlugin implements RuleProviderPluginInterface
{
    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function provide(): RuleInterface
    {
        return new BlankEOFRule();
    }
}
