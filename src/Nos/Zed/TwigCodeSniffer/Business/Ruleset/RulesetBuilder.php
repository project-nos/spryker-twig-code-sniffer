<?php

declare(strict_types=1);

namespace Nos\Zed\TwigCodeSniffer\Business\Ruleset;

use TwigCsFixer\Ruleset\Ruleset;

class RulesetBuilder implements RulesetBuilderInterface
{
    /**
     * @var \Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetFactoryInterface
     */
    protected RulesetFactoryInterface $rulesetFactory;

    /**
     * @var array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface>
     */
    protected array $ruleProviderPlugins;

    /**
     * @param \Nos\Zed\TwigCodeSniffer\Business\Ruleset\RulesetFactoryInterface $rulesetFactory
     * @param array<\Nos\Shared\TwigCodeSniffer\Dependency\Plugin\RuleProviderPluginInterface> $ruleProviderPlugins
     */
    public function __construct(
        RulesetFactoryInterface $rulesetFactory,
        array $ruleProviderPlugins = []
    ) {
        $this->rulesetFactory = $rulesetFactory;
        $this->ruleProviderPlugins = $ruleProviderPlugins;
    }

    /**
     * @return \TwigCsFixer\Ruleset\Ruleset
     */
    public function build(): Ruleset
    {
        $ruleset = $this->rulesetFactory->create();

        foreach ($this->ruleProviderPlugins as $ruleProviderPlugin) {
            $ruleset->addRule($ruleProviderPlugin->provide());
        }

        return $ruleset;
    }
}
