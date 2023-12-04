<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Communication\Plugin;

use Nos\Zed\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use TwigCsFixer\Rules\RuleInterface;

/**
 * @method \Nos\Zed\TwigCodeSniffer\Communication\TwigCodeSnifferCommunicationFactory getFactory()
 */
class BlankEOFRuleProviderPlugin extends AbstractPlugin implements RuleProviderPluginInterface
{
    /**
     * @return \TwigCsFixer\Rules\RuleInterface
     */
    public function provide(): RuleInterface
    {
        return $this->getFactory()->createBlankEOFRule();
    }
}
