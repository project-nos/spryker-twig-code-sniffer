<?php

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider;

use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface;
use TwigCsFixer\Rules\Punctuation\TrailingCommaSingleLineRule;
use TwigCsFixer\Rules\RuleInterface;

class TrailingCommaSingleLineRuleProviderPlugin implements RuleProviderPluginInterface
{
    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function provide(): RuleInterface
    {
        return new TrailingCommaSingleLineRule();
    }
}
