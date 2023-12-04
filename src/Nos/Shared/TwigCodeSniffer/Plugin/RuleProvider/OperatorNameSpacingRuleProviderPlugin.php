<?php

declare(strict_types=1);

namespace Nos\Shared\TwigCodeSniffer\Plugin\RuleProvider;

use Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface;
use TwigCsFixer\Rules\Operator\OperatorNameSpacingRule;
use TwigCsFixer\Rules\RuleInterface;

class OperatorNameSpacingRuleProviderPlugin implements RuleProviderPluginInterface
{
    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function provide(): RuleInterface
    {
        return new OperatorNameSpacingRule();
    }
}
